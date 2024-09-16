<?php

namespace App\Http\Controllers\Admin;

use Alert;
use Carbon\Carbon;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Events\UserWasUpdated;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Resources\UserCollection;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
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
        abort_unless(\Gate::allows("VIEW USER"), 403);

        if($request->ajax()) {
            $data = User::orderBy('id', 'desc');
            if($request->has('filter')){
                if($request->filter=='disable'){
                    $data = $data->where('status', strip_tags($request->filter));
                }elseif($request->filter=='deleted'){
                    $data = $data->onlyTrashed();
                }elseif($request->filter!='all'){
                    $data = $data->where('type', strip_tags($request->filter));
                }
            }
            $data = $data->get();
            if(is_admin(auth()->user())=='admin'){
                $data = $data->filter(function($event){
                    return $event->type != 'admin';
                });
            }else{
                $data = $data->filter(function($event){
                    return $event->role_id != 1;
                });
            }
            try {
                return new UserCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('admin.user.user');
    }

    /**
     * show
     *
     * @param  mixed $user
     * @return void
     */
    public function show($user)
    {
        // abort_unless(\Gate::allows("VIEW USER"), 403);
        $id = Hashids::connection('user')->decode($user)[0];
        $user = User::find($id);
        return view('admin.user.user-detail', compact('user'));
    }

    /**
     * edit
     *
     * @param  mixed $user
     * @return void
     */
    public function edit($user)
    {
        abort_unless(\Gate::allows("UPDATE USER"), 403);
        $id = Hashids::connection('user')->decode($user)[0];
        $user = User::find($id);
        return view('admin.user.user-edit', compact('user'));
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function update(UserRequest $request, User $user)
    {
        // return $request->all();
        abort_unless(\Gate::allows("UPDATE USER"), 403);
        if($request->has('password')){
            $user->password = Hash::make($request->password);
            $user->save();
        }else{
            $data_user = [
                "name"      =>  strip_tags($request->name),
                "email"     =>  strip_tags($request->email),
                "phone"     =>  strip_tags($request->phone),
                "sex"       =>  strip_tags($request->sex),
                "type"      =>  $request->type ? strip_tags($request->type) : $user->type
            ];

            if($user->status!=$request->status){
                if($user->status!='active' || $user->status!='inactive'){
                    if($request->status=='active' || $request->status=='inactive'){
                        // $d   ata_user['email_verified_at'] = Carbon::today();
                    }
                    if($request->status=='invalid'){
                        $data_user['email_verified_at'] = null;
                    }
                }
                $data_user['status'] = strip_tags($request->status);
            }
            $user->update($data_user);
        }
        if($request->ajax()) {
            return $user->toJson();
        }
        event(new UserWasUpdated($user));

        noty('Data saved successfully', 'success');

        return redirect('admin/user/'.$user->format_id);
    }

    /**
     * restore
     *
     * @param  mixed $request
     * @return void
     */
    public function restore(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE USER"), 403);
        if(!$users){
            noty('Unauthorize', 'danger');
            return redirect()->back();
        }
        User::withTrashed()
                ->whereIn('id', strip_tags($request->id))
                ->restore();
        return response()->json(['result' => 'Berhasil soft delete user']);
    }

    /**
     * delete
     *
     * @param  mixed $request
     * @return void
     */
    public function delete(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE USER"), 403);
        $users = User::whereIn('id', $request->id)->where('id', '!=', get_user()->id)->get();
        if(!$users){
            noty('Unauthorize', 'danger');
            return redirect()->back();
        }
        foreach($users as $user){
            $user->delete();
        }
        return response()->json(['result' => 'Berhasil soft delete user']);
    }

    /**
     * destroy
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE USER"), 403);
        $users = User::whereIn('id', $request->id)->where('id', '!=', get_user()->id)->get();
        if(!$users){
            noty('Unauthorize', 'danger');
            return redirect()->back();
        }
        foreach($users as $user){
            $user->forceDelete();
        }
        return response()->json(['result' => 'Berhasil soft delete user']);
    }
}
