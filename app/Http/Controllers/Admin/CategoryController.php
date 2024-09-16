<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
        abort_unless(\Gate::allows("VIEW CATEGORY"), 403);
        if($request->ajax()) {
            $data =  Category::with('team')->orderBy('parent', 'asc')->orderBy('order', 'asc');
            if($request->has('filter')){
                if($request->filter=='active'){
                    $data = $data->where('status', 'active');
                }elseif($request->filter=='pending'){
                    $data = $data->where('status', '0');
                }elseif($request->filter=='review'){
                    $data = $data->where('status', 'review');
                }elseif($request->filter=='deleted'){
                    $data = $data->onlyTrashed();
                }
            }
            $data = $data->get();
            try {
                return new CategoryCollection($data);
            }catch (\Exception $e) {
                return response()->json([$e->getMessage()]);
            }
            return $data->toJson();
        }
        return view('admin.category.category');
    }

    public function create()
    {
        abort_unless(\Gate::allows("CREATE CATEGORY"), 403);
        return view('admin.category.category-add');
    }

    public function store(CategoryRequest $request)
    {
        abort_unless(\Gate::allows("CREATE CATEGORY"), 403);
        $data = Category::create([
            'name' => strip_tags($request->get('name')),
            'description' => filterInput($request->get('description'), 'high')
        ]);

        Alert::success('Data saved successfully category');

        return redirect('admin/category/'.$data->id);
    }

    public function edit(Request $request, category $category)
    {
        // return $category->teams;
        abort_unless(\Gate::allows("UPDATE CATEGORY"), 403);
        if($request->ajax()) {
            return $this->generateCategory($category);
        }
        return view('admin.category.category-detail', compact('category'));
    }

    public function update(CategoryRequest $request, category $category)
    {
        abort_unless(\Gate::allows("UPDATE CATEGORY"), 403);
        $category->update($request->all());
        Alert::success('successfully updated category');

        return redirect('admin/category/'.$category->id);
    }

    public function remove(Category $category)
    {
        abort_unless(\Gate::allows("DELETE CATEGORY"), 403);
        $category->setNullTeam();
        return redirect()->back();
    }

    private function generateCategory($category){
        $sub_category = Category::where('parent', $category->id)->orderBy('order','asc')->get();
        $structure = array();
        /*
        NOTE: $item->order must start form 0
        */
        foreach ($sub_category as $key => $item) {
            $structure[$item->order]['text'] = $item->name;
            $structure[$item->order]['children'] = $this->subCategory($item, $sub_category);
        }
        return ($structure);
    }

    private function subCategory($category){
        $sub_category = Category::where('parent', $category->id)->get();
        $child = array();
        $loop = 0;
        foreach ($sub_category as $k => $sub) {
            $child[$sub->order]['text'] = $sub->name;
            $child[$sub->order]['children'] = $this->subCategory($sub);

            $loop++;
        }
        return $child;
    }

    public function restore(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE CATEGORY"), 403);
        Category::withTrashed()->whereIn('id', $request->id)->restore();
        return response()->json(['result' => 'Berhasil restore data']);
    }
    public function delete(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE CATEGORY"), 403);

        //CHECK IF CATEGORY USED IN CONTENT AND ANY TEAM ACTIVE
        if($request->filter == 'deleted'){
            //FORCE DELETE
            $selects = Category::onlyTrashed()->whereIn('id', $request->id)->get();

            return delete_data($selects, 'force', 'category');
        }
        //SOFT DELETE
        $selects = Category::whereIn('id', $request->id)->get(); //->doesnthave('teams')
        return delete_data($selects, 'soft', 'category');
    }
    public function destroy(Request $request)
    {
        abort_unless(\Gate::allows("DELETE CATEGORY"), 403);
        $selects = Category::whereIn('id', $request->id)->get();
        return delete_data($selects, 'force');
    }
}
