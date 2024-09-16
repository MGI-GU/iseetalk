<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\User;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Events\UserWasCreated;
use App\Events\UserWasUpdated;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class MemberController extends Controller
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

    /**
     * index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
	{
        abort_unless(\Gate::allows("VIEW ADMIN"), 403);
		if($request->ajax()) {
            $data = Admin::with(['role','role.user','role.role'])->orderBy('id', 'desc')->where('id', '!=', 1);
            if($request->has('filter') && $request->filter != 'all'){
                $data->whereHas('role', function($query) use ($request, $data) {
                    if($request->filter=='super_admin'){
                        $query->where('role_id', 1);
                    }else if($request->filter=='master_admin'){
                        $query->where('role_id', 2);
                    }else{
                        $data->whereHas('role.role', function($q) use ($request) {
                            $q->where('role_for', 'admin');
                        });
                    }
                });
            }
            if(is_admin(auth()->user())=='master_admin'){
                $data = $data->whereHas('role', function($query) use ($request, $data) {
                    $data->whereHas('role.role', function($q) use ($request) {
                        $q->where('role_for', 'admin');
                    });
                })->get();
            }else{
                $data = $data->get();
            }
            return $data->toJson();
        }
        return view('admin.member.member');
    }
    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        abort_unless(\Gate::allows("CREATE ADMIN"), 403);
        return view('admin.member.member-add');
    }
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        abort_unless(\Gate::allows("CREATE ADMIN"), 403);
        // $type = 'team_member';
        // if($request->has('admin')){
        //     $type = 'admin';
        // }
        // $user = User::create([
        //     'name' => strip_tags($request->get('name')),
        //     'email' => strip_tags($request->get('email')),
        //     'phone' => strip_tags($request->get('phone')),
        //     'role_id' => strip_tags($request->get('role_id')),
        //     'type' => $type,
        //     'password' => Hash::make($request->get('password')),
        // ]);
        // event(new UserWasCreated($user));

        // return $request->all();

        $user = User::find(strip_tags($request->user));
        $user->type = 'admin';
        $user->role_id = strip_tags($request->role_id);

        //SELECT CATEGORY
        $category = null;
        if($request->role_id>2){
            $hastag = explode(",",strip_tags($request->category));
            $category = DB::table('category')->select('id','name')->whereIn('name', $hastag)->get();
        }
        //SET USER_ROLE
        $user_role = $user->roleusers()->create([
            'team_id' => 0,
            'role_id' => strip_tags($request->role_id),
            'user_id' => strip_tags($request->user)
        ]);

        //SET DATA ADMIN
        $admin = $user->admin()->create([
            'user_role_id' => $user_role->id,
            'category' => $category,
        ]);

        $user->admin_id = $admin->id;
        $user->save();

        noty('Data saved successfully', 'success');

        return redirect('admin/member/'.$admin->format_id);
    }
    /**
     * edit
     *
     * @param  mixed $member
     * @return void
     */
    public function edit($member)
    {
        abort_unless(\Gate::allows("UPDATE ADMIN"), 403);
        $id = Hashids::connection('admin')->decode($member)[0];
        $member = Admin::with(['role','role.user','role.role'])->find($id);
        return view('admin.member.member-detail', compact('member'));
    }
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $member
     * @return void
     */
    public function update(Request $request, Admin $member)
    {
        abort_unless(\Gate::allows("UPDATE ADMIN"), 403);

        //return $request->all();
        //SELECT CATEGORY
        $category = null;
        if($request->role_id>2){
            $hastag = explode(",",strip_tags($request->category));
            $category = DB::table('category')->select('id','name')->whereIn('name', $hastag)->get();
        }

        $member->update([
            'category' => $category
        ]);

        $member->role->update([
            'status' => strip_tags($request->status),
            'role_id' => strip_tags($request->role_id),
        ]);

        //event(new UserWasUpdated($member));

        noty('Data saved successfully', 'success');
        return redirect('admin/member/'.$member->format_id);
    }
    /**
     * destroy
     *
     * @param  mixed $member
     * @return void
     */
    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE ADMIN"), 403);

        if(in_array(1, $request->id)){
            return response()->json(['result' => 'Invalid delete data']);
        }
        $admins = Admin::whereIn('id', $request->id)->get();
        foreach($admins as $admin){
            $selected = Admin::find($admin->id);
            //DELETE relation ADMIN
            //DELETE relation ROLE USER
            $selected->delete();
            return response()->json(['result' => 'Berhasil delete data']);
        }
    }
    public function delete(Request $request, Admin $member)
    {
        abort_unless(\Gate::allows("DELETE ADMIN"), 403);
        $member->delete();
        return redirect('admin/member/');
    }
}
