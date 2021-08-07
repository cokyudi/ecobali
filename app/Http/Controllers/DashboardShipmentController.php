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


class DashboardShipmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        return view('dashboardShipment/index',compact('user'));
    }

    public static function getSales(Request $request) {
        $sales = DB::table('sales')
            ->where('sale_date', '>=',$request->startDates)
            ->where('sale_date', '<=',$request->endDates)
            ->select(
                DB::raw('ROUND(SUM(delivered_to_papermill),1) delivered_to_papermill'),
                DB::raw('ROUND(SUM(received_at_papermill),1) received_at_papermill'),
                DB::raw('ROUND(SUM(weighing_scale_gap_papermill),1) weighing_scale_gap_papermill'),
                DB::raw('ROUND(SUM(weighing_scale_gap_papermill_percent),1) weighing_scale_gap_papermill_percent'),
                DB::raw('ROUND(SUM(total_weight_accepted),1) total_weight_accepted'),
            )
            ->get();

        Log::info($sales);

//        $data = [
//            'districtsCoverage' => $sales,
//            'regenciesCoverage' =>$regenciesCoverage,
//            'totalParticipants'=> $totalParticipants,
//            'totalCollection' => $totalCollection,
//            'collectionByRegency' => $collectionByRegency
//        ];
    }
}
