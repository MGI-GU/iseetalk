<?php

namespace App\Http\Controllers\Admin;

use App\Models\Master;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use UxWeb\SweetAlert\SweetAlert;
use App\Models\MasterLanguages;

class MasterController extends Controller
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

    public function index()
	{
        abort_unless(\Gate::allows("UPDATE SETTING"), 403);
        return view('admin.setting.setting');
    }

    public function show($page)
	{
        abort_unless(\Gate::allows("UPDATE SETTING"), 403);
        if($page=='language'){
            $lang = MasterLanguages::withTrashed()->get();
            return view('admin.setting.language', compact('lang'));
        }
        return view('admin.setting.setting-tech');
    }

    public function store(Request $request)
    {
        abort_unless(\Gate::allows("UPDATE SETTING"), 403);
        $master = Master::find(1);
        if($request->has('name') && $request->has('email')){
            $master->name = strip_tags($request->name);
            $master->slogan = strip_tags($request->slogan);
            $master->description = strip_tags($request->description);
            $master->email = strip_tags($request->email);
            $master->phone = strip_tags($request->phone);
        }else{
            $master->api = $request->except(['_token']);
        }
        $master->save();
        SweetAlert::success('Data saved successfully role');

        return redirect()->back();
    }

    public function storeLanguage(Request $request){
        $data = MasterLanguages::create([
            'name' => strip_tags($request->get('name'))
        ]);
        return redirect()->back();
    }

    /**
     * Delete
     *
     * @param  mixed $request
     * @return void
     */
    public function deleteLanguage(MasterLanguages $language)
    {
        // return $language;
        $language->delete();
        return redirect()->back();
    }
}
