<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;

class RoleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
	{
        abort_unless(\Gate::allows("VIEW ROLE"), 403);
		if($request->ajax()) {
            $data = Role::orderBy('id', 'ASC');
            if($request->has('filter')){
                if($request->filter=='team_member'){
                    $data = $data->where('role_for', strip_tags($request->filter));
                }elseif( $request->filter=='default' || $request->filter=='admin' ){
                    $data = $data->where('type', strip_tags($request->filter));
                }
            }else{
                $data = $data->where('type', 'admin');
            }
            return $data->get()->toJson();
        }
        return view('admin.role.role');
    }

    public function create()
    {
        abort_unless(\Gate::allows("CREATE ROLE"), 403);
        return view('admin.role.role-add');
    }

    public function store(RoleRequest $request)
    {
        abort_unless(\Gate::allows("CREATE ROLE"), 403);
        $type = null;
        if($request->has('role_for')){
            $type = strip_tags($request->get('role_for'));
        }else{
            if($request->get('type')=='admin'){
                $type = 'admin';
            }else{
                $type = 'team_member';
            }
        }
        $data = Role::create([
            'name' => strip_tags($request->get('name')),
            'role_for' => $type,
            'type' => strip_tags($request->get('type')),
            'description' => filterInput($request->description, 'high'),
        ]);

        if($request->get('type')=='default'){
            foreach (get_permission($request->get('type'), $type) as $key => $value) {
                $data->permission()->attach($value->id);
            }
        }
        Alert::success('Data saved successfully role');

        return redirect('admin/role/'.$data->id);
    }

    public function edit(Role $role)
    {
        abort_unless(\Gate::allows("UPDATE ROLE"), 403);
        return view('admin.role.role-detail', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        // return $request->all();
        abort_unless(\Gate::allows("UPDATE ROLE"), 403);
        // $type = null;
        // if($request->get('role_for')=='leader' || $request->get('role_for')=='master_admin' || $request->get('role_for')=='super_admin'){
        //     $type = 'default';
        // }else if($request->get('role_for')=='admin'){
        //     $type = 'admin';
        // }else{
        //     $type = 'team';
        // }

        if($request->get('status')=='disable' && $role->roleuser->count()!=0){
            noty('Failed to update status to Disable, role still under using by some user', 'warning');
            return redirect('admin/role/'.$role->id);
        }

        $role->update([
            'name' => strip_tags($request->get('name')),
            'description' => strip_tags($request->get('description')),
            'status' => strip_tags($request->get('status'))
        ]);
        $role->permission()->detach();
        if($role->type=='default'){
            foreach (get_permission($role->type, $role->role_for) as $key => $value) {
                $role->permission()->attach($value->id);
            }
        }else{
            if($request->has('permission')){
                foreach ($request->get('permission') as $key => $value) {
                    $role->permission()->attach($value);
                }
            }
        }
        Alert::success('successfully updated role');

        return redirect('admin/role/'.$role->id);
    }

    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE ROLE"), 403);
        // CHECK FIRST IF ANY USER USING ROLE CANT DELETE
        $selects = Role::whereIn('id', $request->id)->get();
        $list = '';
        foreach($selects as $role){
            if($role->roleuser->count()==0){
                //keep from select
                $delete_role = Role::find($role->id);
                $list = $list . $delete_role->name.',';
                $delete_role->delete();
            }
        }
        return response()->json(['result' => 'Berhasil delete role '.$list]);

    }
}
