<?php

namespace App\Http\Controllers\Studio;

use Auth;
use App\User;
use Analytics;
use App\Models\Audio;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Vinkla\Hashids\Facades\Hashids;
use Spatie\Analytics\Period;

class AnalyticController extends Controller
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
        $user = Auth::user();
        $channel = get_user_channels();
        $channel = reset($channel);
        $id = key($channel);
        if($request->channel){
            $id = $request->channel;
        }
        $channel = Channel::find($id);

        if($request->ajax()){
            $dimensi = 'ga:yearMonth';
            $analyticsData = Analytics::performQuery(
                Period::years(1),
                'ga:sessions',
                [
                    'metrics' => 'ga:pageviews, ga:sessions, ga:users',
                    'dimensions' => $dimensi,
                    'filters' => 'ga:pagePath=~channel/'.$channel->slug
                ]
            );

            $data = $analyticsData->rows;
            foreach($data as $key => $row){
                $ga['label'][$key] = ga_date_readable($row[0]);
                $ga['reach'][$key] = $row[1];
                $ga['enagement'][$key] = $row[2];
                $ga['audiance'][$key] = $row[3];
            }
            $total = $analyticsData->totalsForAllResults;
            $i = 0;
            foreach($total as $t){
                $sum[$i] = $t;
                $i +=1;
            }
            return ['data' => $ga, 'total' => $sum, 'chart' => $data];
        }
        return view('studio.analytics', compact('user', 'channel'));
    }
    public function show(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];
        $audio = Audio::find($id);
        $own_this = owner_this($audio);
        if($request->ajax()){
            $dimensi = 'ga:yearMonth';
            $analyticsData = Analytics::performQuery(
                Period::years(1),
                'ga:sessions',
                [
                    'metrics' => 'ga:pageviews, ga:sessions, ga:users',
                    'dimensions' => $dimensi,
                    'filters' => 'ga:pagePath=~listen/'.$audio->slug
                ]
            );

            $data = $analyticsData->rows;
            foreach($data as $key => $row){
                $ga['label'][$key] = ga_date_readable($row[0]);
                $ga['reach'][$key] = $row[1];
                $ga['enagement'][$key] = $row[2];
                $ga['audiance'][$key] = $row[3];
            }
            $total = $analyticsData->totalsForAllResults;
            $i = 0;
            foreach($total as $t){
                $sum[$i] = $t;
                $i +=1;
            }
            return ['data' => $ga, 'total' => $sum, 'chart' => $data];
        }
        return view('studio.audio_analytic', compact('audio', 'own_this'));
    }
    public function audio(Request $request)
    {
        $user = Auth::user();
        $audio = get_user_audios();
        $audio = reset($audio);
        $id = key($audio);
        if($request->audio){
            $id = $request->audio;
        }
        $audio = Audio::find($id);

        if($request->ajax()){
            $dimensi = 'ga:yearMonth';
            $analyticsData = Analytics::performQuery(
                Period::years(1),
                'ga:sessions',
                [
                    'metrics' => 'ga:pageviews, ga:sessions, ga:users',
                    'dimensions' => $dimensi,
                    'filters' => 'ga:pagePath=~listen/'.$audio->slug
                ]
            );

            $data = $analyticsData->rows;
            foreach($data as $key => $row){
                $ga['label'][$key] = ga_date_readable($row[0]);
                $ga['reach'][$key] = $row[1];
                $ga['enagement'][$key] = $row[2];
                $ga['audiance'][$key] = $row[3];
            }
            $total = $analyticsData->totalsForAllResults;
            $i = 0;
            foreach($total as $t){
                $sum[$i] = $t;
                $i +=1;
            }
            return ['data' => $ga, 'total' => $sum, 'chart' => $data];
        }
        return view('studio.analytics_audio', compact('user', 'audio'));
    }
}
