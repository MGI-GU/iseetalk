<?php

namespace App\Http\Controllers\Admin;

use Alert;
use App\Models\Audit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Analytics;
use Spatie\Analytics\Period;

class DashboardController extends Controller
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
        abort_unless(\Gate::allows("VIEW DASHBOARD"), 403);
        return view('admin.index');
    }

    function analytic($page){
        $dimensi = 'ga:yearMonth';
        $analyticsData = Analytics::performQuery(
            Period::years(1),
            'ga:sessions',
            [
                'metrics' => 'ga:pageviews, ga:sessions, ga:users',
                'dimensions' => $dimensi
            ]
        );

        $data = $analyticsData->rows;
        foreach($data as $key => $row){
            $ga['periode'][$key] = substr($row[0], 0, 4).'-'.substr($row[0], -2);
            $ga['pageview'][$key] = $row[1];
            $ga['sessions'][$key] = $row[2];
            $ga['user'][$key] = $row[3];
        }
        $total = $analyticsData->totalsForAllResults;
        $i = 0;
        foreach($total as $t){
            $sum[$i] = $t;
            $i +=1;
        }
        return ['data' => $ga, 'total' => $sum, 'chart' => $data];
    }
    
}