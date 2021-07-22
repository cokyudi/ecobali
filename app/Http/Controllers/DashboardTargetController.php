<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Models\DashboardComparison;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use DateTime;


class DashboardTargetController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();


        $categories = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id');
            })
            ->select(
                'categories.*',
                'category_details.year',
            );

        $subParticipants = DB::table('participants')
            ->joinSub($categories, 'categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->select(
                'participants.id as participant_id',
                'participants.participant_name as participant_name',
                'categories.id as category_id',
                'categories.category_name as category_name',
            );

        $collections = DB::table('collections')
            ->joinSub($subParticipants, 'participants', function ($join) {
                $join->on('collections.id_participant', '=', 'participants.participant_id');
            })
            ->select('participants.category_name',
                'participants.category_id',
                DB::raw('ROUND(SUM(quantity),1) qty')
            )
            ->groupBy('category_name','category_id')
            ->get();

        $data = [];
        foreach ($collections as $collection) {
            $data['label'][] = $collection->category_name;
            $data['actual'][] = $collection->qty;
            $data['target'][] = $this->getTarget($collection->category_id);
        }
        $data['chart_data'] = json_encode($data);

        return view('dashboardTarget/index',$data,compact('user'));
    }

    public static function getTarget($categoryID) {


        $dateRange = DB::table('collections')
            ->select(
                DB::raw('MONTH(collect_date) month'),
                DB::raw('YEAR(collect_date) year'),
            )->groupBy('month','year')->get();

        $categories = DB::table('category_details')
            ->select('year', 'semester_1_target','semester_2_target')
            ->where('category_id', $categoryID)
            ->get();

        $category = [];
        foreach ($categories as $cat) {
            $category[$cat->year] = array(
                "semester_1_target"=>$cat->semester_1_target/6,
                "semester_2_target"=>$cat->semester_2_target/6,
            );
        }

        $target = 0;
        foreach ($dateRange as $range) {
            if ($range->month < 7) {
                $target += $category["$range->year"]['semester_1_target'];
            } else {
                $target += $category["$range->year"]['semester_2_target'];
            }
        }

        return round($target,1);



    }

}
