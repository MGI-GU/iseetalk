<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\PageWasCreated;
use App\Events\NotificationWasUpdated;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Requests\Admin\PageRequest;

class PageController extends Controller
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
        abort_unless(\Gate::allows("VIEW PAGE"), 403);
		if($request->ajax()) {
            $data = Page::with('author', 'notification')->orderBy('id', 'desc');
            if($request->has('filter') && $request->filter == 'page'){
                $data = $data->doesnthave('notification');
            }elseif($request->has('filter') && $request->filter == 'notification'){
                $data = $data->whereHas('notification');
            }elseif($request->has('filter') && $request->filter != 'all'){
                $data = $data->where('status', $request->filter);
            }elseif( $request->filter == 'all'){
            }else{
                $data = $data->where('status','draft');
            }
            $data = $data->get();
            return $data->toJson();
        }
        return view('admin.page.page');
    }

    public function create()
    {
        abort_unless(\Gate::allows("CREATE PAGE"), 403);
        return view('admin.page.page-add');
    }

    public function store(PageRequest $request)
    {
        abort_unless(\Gate::allows("CREATE PAGE"), 403);
        // return $request->all();
        $check = Page::where('slug', slugify(strip_tags($request->get('title'))))->get();
        if($check->count()>0){
            noty('Title sudah digunakan', 'error');
            return redirect()->back()->withInput();;
        }
        $data = Page::create([
            'title'         => strip_tags($request->get('title')),
            'content'       => filterInput($request->get('content'), 'high'),
            'type'          => strip_tags($request->get('type')),
            'slug'          => slugify(strip_tags($request->get('title'))),
            'author_id'     => auth()->user()->id
        ]);
        if($request->get('notification')!='none'){
            $type = $request->get('notification');
            if($request->has('user') && $request->has('creator')){
                $type = $request->get('notification').'_user_creator';
            }else if($request->has('user')){
                $type = $request->get('notification').'_user';
            }else if($request->has('creator')){
                $type = $request->get('notification').'_creator';
            }
            $data->notification()->create([
                'type' => $type,
                'notifiable_type' => 'page',
                'notifiable_id' => $data->id,
                'data' => $data->title,
            ]);
        }

        // event(new PageWasCreated($data));

        noty('Data saved successfully page', 'success');

        return redirect('admin/page/'.$data->format_id);
    }

    public function edit(Request $request, $page)
    {
        abort_unless(\Gate::allows("UPDATE PAGE"), 403);
        $id = Hashids::connection('page')->decode($page)[0];
        $page = Page::find($id);
        return view('admin.page.page-detail', compact('page'));
    }

    public function update(PageRequest $request, Page $page)
    {
        abort_unless(\Gate::allows("UPDATE PAGE"), 403);
        $page->update([
            'title'         => strip_tags($request->get('title')),
            'content'       => filterInput($request->get('content'), 'high'),
            'sub_content'   => strip_tags($request->get('sub_content')),
            'status'        => strip_tags($request->get('status')),
        ]);

        if($request->get('notification')!='none'){
            $type = $request->get('notification');
            if($request->has('user') && $request->has('creator')){
                $type = $request->get('notification').'_user_creator';
            }else if($request->has('user')){
                $type = $request->get('notification').'_user';
            }else if($request->has('creator')){
                $type = $request->get('notification').'_creator';
            }
            $page->notification()->update([
                'type' => $type,
                'data' => $page->title,
            ]);
        }

        if($page->status=='publish' && $page->notification){
            event(new NotificationWasUpdated($page->notification));
        }
        noty('successfully updated page', 'success');

        return redirect('admin/page/'.$page->format_id);
    }

    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE TEAM"), 403);
        $selects = Page::whereIn('id', $request->id)->get();
        return delete_data($selects, 'force');
    }
}
