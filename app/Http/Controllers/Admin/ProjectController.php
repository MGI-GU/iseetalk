<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Resources\ProjectCollection;
use App\Http\Requests\Admin\ProjectRequest;

class ProjectController extends Controller
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
        // $filter = ['status' => 'approve'];
        // return get_own_project($filter);
        abort_unless(\Gate::allows("VIEW PROJECT"), 403);
		if($request->ajax()) {
            $filter = [];
            if($request->has('filter') && $request->get('filter')!='all'){
                $filter = ['status' => strip_tags($request->filter)];
            }elseif($request->get('filter')=='all'){
            }else{
                if(is_admin(Auth::user())!=='false'){
                    $filter = ['status' => 'review'];
                }
            }
            $data = get_own_project($filter);
            return new ProjectCollection($data);
            //return $data->toJson();
        }
        return view('admin.project.project');
    }

    public function create()
    {
        abort_unless(\Gate::allows("CREATE PROJECT"), 403);
        return view('admin.project.project-add');
    }

    public function store(ProjectRequest $request)
    {
        abort_unless(\Gate::allows("CREATE PROJECT"), 403);
        $data = Project::create([
            'name' => strip_tags($request->get('name')),
            'description' => filterInput($request->get('description'), 'high'),
            'team_id' => strip_tags($request->get('team_id'))
        ]);

        Alert::success('Data saved successfully project');

        return redirect('admin/project/'.$data->format_id.'/detail');
    }

    public function show(Request $request, $project)
    {
        abort_unless(\Gate::allows("VIEW PROJECT"), 403);
        $id = Hashids::connection('project')->decode($project)[0];
        $project = Project::find($id);
        if(auth()->user()->type!='admin'){
            // return auth()->user()->id.' '.get_team_user($project->team);
            abort_unless(in_array(auth()->user()->id, get_team_user($project->team_id)->toArray()), 403);
        }
        return view('admin.project.project-detail', compact('project'));
    }

    public function edit(Request $request, Project $project)
    {
        abort_unless(\Gate::allows("UPDATE PROJECT"), 403);
        if(auth()->user()->type!='admin'){
            abort_unless(in_array(auth()->user()->id, get_team_user($project->team_id)->toArray()), 403);
        }
        return view('admin.project.project-edit', compact('project'));
    }

    public function analytic(Request $request, Project $project)
    {
        abort_unless(\Gate::allows("VIEW PROJECT"), 403);
        if(is_admin(auth()->user())!='admin'){
            abort_unless(in_array(auth()->user()->id, get_team_user($project->team)->toArray()), 403);
        }
        return view('admin.project.project-analitic', compact('project'));
    }

    public function audit(Request $request, Project $project)
    {
        abort_unless(\Gate::allows("AUDIT PROJECT"), 403);
        return view('admin.project.project-audit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project)
    {
        abort_unless(\Gate::allows("UPDATE PROJECT"), 403);
        $project->update([
            "name" => strip_tags($request->name),
            "description" => filterInput($request->description, 'high'),
            "team_id" => strip_tags($request->team_id)
        ]);

        Alert::success('successfully updated project');

        return redirect('admin/project/'.$project->id.'/edit');
    }

    public function status(Project $project, $status){
        abort_unless(\Gate::allows("AUDIT PROJECT"), 403);
        if($status=='submit'){
            $project->setReview();
        }elseif($status=='approve'){
            $project->setApprove();
        }elseif($status=='reject'){
            $project->setReject();
        }
        noty('successfully updated project', 'success');
        return redirect('admin/project/'.$project->format_id.'/detail');
    }

    public function change(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE PROJECT"), 403);
        $selects = Project::whereIn('id', $request->id)->get();
        foreach($selects as $project){
            $project->update(['status' => strip_tags($request->status)]);
        }
        return response()->json(['result' => 'Berhasil update data project']);
    }

    public function restore(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE PROJECT"), 403);
        Project::withTrashed()->whereIn('id', $request->id)->restore();
        return response()->json(['result' => 'Berhasil restore data']);
    }
    public function delete(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE PROJECT"), 403);
        $selects = Project::whereIn('id', $request->id)->get();
        $result = delete_data($selects);
        return $result;
    }
    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE PROJECT"), 403);
        $selects = Project::whereIn('id', $request->id)->get();
        return delete_data($selects, 'force');
    }
}
