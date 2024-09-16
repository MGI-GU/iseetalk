<?php

namespace App\Http\Controllers\Web;

use Auth;
use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\UserNotification;

class PageController extends Controller
{
    public function show(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->first();
        if(!$page){
            $page = 'default';
        }

        if(Auth::check()){
            if(get_notification_type($page)=='app'){
                $notif = UserNotification::where('notification_id', $page->notification->id)->where('user_id', Auth::user()->id)->first();
                $notif->setReaded();
            }
        }

        return view('web.pages', compact('page'));
    }

}
