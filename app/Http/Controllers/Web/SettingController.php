<?php

namespace App\Http\Controllers\Web;

use Auth;
use Alert;
use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\ProfileRequest;
use App\Http\Requests\Web\SettingRequest;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
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
        $page = false;
        return view('web.setting', compact('page'));
    }

    public function store(ProfileRequest $request)
    {
        $user = Auth::user();
        if( $request->password == null && $request->password_confirmation == null){
            if($request->has('name') && $request->has('email') && $request->has('phone')){
                $user->update([
                    'name'  => strip_tags($request->name),
                    'email' => strip_tags($request->email),
                    'phone' => strip_tags($request->phone),
                ]);
            }
            if($request->has('personal_status') || $request->has('sex') || $request->has('birthday') || $request->has('location')){
                $user->update([
                    'personal_status'   => strip_tags($request->personal_status),
                    'sex'               => strip_tags($request->sex),
                    'birthday'          => strip_tags($request->birthday),
                    'location'          => strip_tags($request->location)
                ]);
            }
            Alert::success('Berhasil menyimpan data');
            noty('Berhasil menyimpan data', 'success');
        }else{
            if($request->password == $request->password_confirmation){
                $user->password = Hash::make($request->password);
                $user->save();
                Alert::success('Berhasil menyimpan data');
                noty('Berhasil menyimpan data', 'success');
            }else{
                Alert::warning('Gagal menyimpan data');
                noty('Gagal menyimpan data', 'error');
            }
        }
        return redirect()->back();
    }

    public function show(Request $request, $page){
        if($page=='notification'){
            return view('web.account_notification', compact('page'));

        }elseif($page=='sharing'){
            return view('web.account_sharing', compact('page'));
            
        }elseif($page=='billing'){
            return view('web.account_billing', compact('page'));

        }else{
            redirect('setting');
        }
    }

    public function update(Request $request, UserSetting $setting)
    {
        $setting->web_subscription      = $request->has('web_subscription')?1:0;
        $setting->web_recommendation    = $request->has('web_recommendation')?1:0;
        $setting->web_channel           = $request->has('web_channel')?1:0;
        $setting->web_all_comment       = $request->has('web_all_comment')?1:0;
        $setting->web_my_comment_reply  = $request->has('web_my_comment_reply')?1:0;
        $setting->email_permission      = $request->has('email_permission')?1:0;
        $setting->email_subscription    = $request->has('email_subscription')?1:0;
        $setting->email_product         = $request->has('email_product')?1:0;
        $setting->email_channel         = $request->has('email_channel')?1:0;
        if($request->has('language'))
            $setting->language = strip_tags($request->get('language'));

        $setting->save();
        Alert::success('Berhasil menyimpan data');
        noty('Berhasil menyimpan data', 'success');
        return redirect()->back();
    }
}
