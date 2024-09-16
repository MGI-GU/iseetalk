<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\User;
use App\Models\Team;
use App\Models\Category;
use App\Models\TeamUserRole;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\TeamWasUpdated;
use App\Events\UserWasUpdated;
use App\Events\UserWasInvited;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\CategoryTeam;
use App\Http\Resources\TeamCollection;
use App\Http\Requests\Admin\TeamRequest;

class TeamController extends Controller
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
        abort_unless(Gate::allows("VIEW TEAM"), 403);
		if($request->ajax()) {
            $data = get_own_team();
            try {
                return new TeamCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('admin.team.team');
    }

    public function create()
    {
        abort_unless(Gate::allows("CREATE TEAM"), 403);

        return view('admin.team.team-add');
    }

    public function store(TeamRequest $request)
    {
        abort_unless(Gate::allows("CREATE TEAM"), 403);

        $data = Team::create([
            'name' => strip_tags($request->get('name')),
            'description' => strip_tags($request->get('description'))
        ]);
        $team_id = $data->id;
        $data->roleuser()->create([
            'role_id' => 3,
            'user_id' => strip_tags($request->leader)
        ]);
        if($request->category){
            $category_team = CategoryTeam::create([
                'team_id' => $team_id,
                'category_id' => strip_tags($request->category)
            ]);
        }
        $user = User::find($request->leader);
        if($user->type=='creator' || $user->type=='streamer'){
            $user->type = 'member';
            $user->admin_id = null;
            $user->role_id = null;
            $user->save();
        }

        noty('Data saved successfully', 'success');

        return redirect()->route('admin.team.show', [$data->format_id]);
    }

    public function show(Request $request, $team)
    {
        abort_unless(Gate::allows("VIEW TEAM"), 403);
        $id = Hashids::connection('team')->decode($team)[0];
        $team = Team::find($id);
        if(auth()->user()->type!='admin'){
            // return auth()->user()->id.' '.get_team_user($team->id);
            abort_unless(in_array(auth()->user()->id, get_team_user($team->id)->toArray()), 403);
        }
        if($request->ajax()) {
            $data = $team->roleuser;
            return $data->toJson();
        }
        return view('admin.team.team-detail', compact('team'));
    }

    public function edit(Request $request, Team $team)
    {
        abort_unless(Gate::allows("UPDATE TEAM"), 403);
        if(auth()->user()->type!='admin'){
            abort_unless(in_array(auth()->user()->id, get_team_user($team->id)->toArray()), 403);
        }
        if($request->ajax()) {
            $data = $team->roleuser;
            return $data->toJson();
        }
        return view('admin.team.team-edit', compact('team'));
    }

    public function update(TeamRequest $request, Team $team)
    {
        abort_unless(Gate::allows("UPDATE TEAM"), 403);
        $team_id = $team->id;
        $team->update([
            'name'          => strip_tags($request->name),
            'description'   => strip_tags($request->description)
        ]);

        if($request->has('category')){
            // $category = Category::find($request->category);
            // $category->setTeam($team->id);
            // return $team_id;
            // $category_team = $category->teams()->create([
            //     'team_id' => $team_id,
            //     'category_id' => $request->category
            // ]);
            $category_team = CategoryTeam::create([
                'team_id' => $team_id,
                'category_id' => strip_tags($request->category)
            ]);

            // return $category_team;
        }
        event(new TeamWasUpdated($team));
        noty('Data saved successfully', 'success');

        return redirect()->route('admin.team.edit', [$team->id]);
    }

    public function add(Request $request, Team $team)
    {
        abort_unless(Gate::allows("UPDATE TEAM"), 403);
        if($request->get('role')==3 && $team->leader){
            noty('Team already have project leader', 'warning');
            return redirect('admin/team/'.$team->format_id);
        }

        $team->roleuser()->create([
            'role_id' => $request->get('role'),
            'user_id' => $request->get('user')
        ]);

        $user = User::find($request->get('user'));
        if($user->type!='member'){
            $user->type = 'member';
            $user->admin_id = null;
            $user->role_id = null;
            $user->save();
        }

        event(new UserWasInvited($user, $team));

        noty('Add Member to team successfully', 'success');

        return redirect('admin/team/'.$team->id);
    }

    public function removeCategory(Team $team)
    {
        abort_unless(\Gate::allows("UPDATE TEAM"), 403);
        $team->categoryTeam->delete();
        return redirect()->back();
    }

    public function remove(Request $request, Team $team)
    {
        abort_unless(Gate::allows("UPDATE TEAM"), 403);
        $id = $request->get('id');
        $team->roleuser->where('id', $id)->first()->delete();
        noty('Data saved successfully', 'success');
        return redirect('admin/team/'.$team->id);
    }

    public function updateMember(Request $request, TeamUserRole $role)
    {
        abort_unless(Gate::allows("UPDATE TEAM"), 403);
        if($request->ajax()) {
            return $role;
        }else{
            // return $request->all();
            $data = [];
            if($role->user_id != $request->get('user_id')){
                $data['user_id'] = $request->get('user_id');
                //REMOVE TYPE USER
                User::find($role->user_id)->update([
                    'type' => 'creator',
                    'admin_id' => null
                ]);
            }
            if( $request->has('role_id') ){
                $data['role_id'] =  $request->get('role_id');
            }
            if(count($data)>0){
                $update_role = $role->update($data);
                if($update_role){
                    User::find($request->get('user_id'))->update([
                        'type' => 'member',
                        'admin_id' => null,
                        'role_id' => null
                    ]);
                }
                noty('Data saved successfully', 'success');
            }else{
                noty('No data are changes', 'info');
            }
            return redirect('admin/team/'.$role->team_id);
        }
    }

    public function restore(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE TEAM"), 403);
        Team::withTrashed()->whereIn('id', $request->id)->restore();
        return response()->json(['result' => 'Berhasil restore data']);
    }

    public function delete(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE TEAM"), 403);
        $selects = Team::whereIn('id', $request->id)->get();
        $undelete = '';
        $list = '';
        foreach($selects as $team){
            $delete_team = Team::find($team->id);
            if(!$team->category){
                $list = $list . $delete_team->name.',';
                $delete_team->delete();
                $delete_team->roleuser()->delete();
                // return delete_data($selects, 'force');
            }else{
                $undelete = $undelete . $delete_team->name.',';
            }
        }
        // return delete_data($selects);
        if($list==''){
            return response()->json(['result' => 'Tidak ada data Team yang di hapus atau team yang dipilih masih dalam kategori aktif!']);
        }
        if($undelete != ''){
            return response()->json(['result' => 'Team :'.$list.'berhasil dihapus sedangakan Team :'.$undelete.' tidak dapat di hapus karena masih dalam kategori aktif!']);
        }
        return response()->json(['result' => 'Berhasil delete team :'.$list]);

    }

    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE TEAM"), 403);
        $selects = Team::whereIn('id', $request->id)->get();
        $list = '';
        foreach($selects as $team){
            if(!$team->category){
                $delete_team = Team::find($team->id);
                $list = $list . $delete_team->name.',';
                $delete_team->forceDelete();
                // return delete_data($selects, 'force');
            }
        }
        if($list==''){
            return response()->json(['result' => 'Tidak ada data Team yang di hapus']);
        }
        return response()->json(['result' => 'Berhasil delete team '.$list]);
    }
}
