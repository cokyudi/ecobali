<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Papermill;
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
        $papermills = Papermill::latest()->get();

        return view('dashboardShipment/index',compact('user','papermills'));
    }

    public static function getSales(Request $request) {
        $sales = DB::table('sales')
            ->where('sale_date', '>=',$request->startDates)
            ->where('sale_date', '<=',$request->endDates)
            ->select(
                DB::raw('NVL(ROUND(SUM(delivered_to_papermill),1),0) delivered_to_papermill'),
                DB::raw('NVL(ROUND(SUM(weighing_scale_gap_eco),1),0) weighing_scale_gap_eco'),
                DB::raw('NVL(ROUND(SUM(received_at_papermill),1),0) received_at_papermill'),
                DB::raw('NVL(ROUND(SUM(weighing_scale_gap_papermill),1),0) weighing_scale_gap_papermill'),
                DB::raw('NVL(ROUND(SUM(weighing_scale_gap_papermill_percent),1),0) weighing_scale_gap_papermill_percent'),
                DB::raw('NVL(ROUND(SUM(total_weight_accepted),1),0) total_weight_accepted'),
                DB::raw('NVL(ROUND(SUM(moisture_content_and_contaminant),1),0) moisture_content_and_contaminant'),
            );

        if (isset($request->id_papermills) && count($request->id_papermills) != 0) {
            $sales = $sales->whereIn('id_papermill', $request->id_papermills);
        }

        $sales = $sales->first();

        $weightReduction = [
            ["Tidak Susut","Susut"]
        ];
        array_push($weightReduction, ["Susut", $sales->weighing_scale_gap_eco]);
        array_push($weightReduction, ["Tidak Susut", $sales->delivered_to_papermill]);


        $mcc = [
            ["UBC", "MCC"]
        ];
        array_push($mcc, ["MCC", $sales->moisture_content_and_contaminant]);
        array_push($mcc, ["UBC", $sales->total_weight_accepted]);

        if($request->type == "month") {
            $salesColumnChart = DB::table('sales')
                ->where('sale_date', '>=',$request->startDates)
                ->where('sale_date', '<=',$request->endDates)
                ->select(
                    DB::raw('NVL(ROUND(SUM(delivered_to_papermill),1),0) delivered_to_papermill'),
                    DB::raw('NVL(ROUND(SUM(received_at_papermill),1),0) received_at_papermill'),
                    DB::raw('NVL(ROUND(SUM(total_weight_accepted),1),0) total_weight_accepted'),
                    DB::raw('NVL(ROUND(SUM(moisture_content_and_contaminant),1),0) moisture_content_and_contaminant'),
                    DB::raw('MONTHNAME(sale_date) monthName'),
                    DB::raw('MONTH(sale_date) month'),
                    DB::raw('YEAR(sale_date) year')
                )
                ->groupBy('monthName','month','year')
                ->orderBy('sale_date', 'asc');
        } else if ($request->type == "quarter") {
            $salesColumnChart = DB::table('sales')
                ->where('sale_date', '>=',$request->startDates)
                ->where('sale_date', '<=',$request->endDates)
                ->select(
                    DB::raw('NVL(ROUND(SUM(delivered_to_papermill),1),0) delivered_to_papermill'),
                    DB::raw('NVL(ROUND(SUM(received_at_papermill),1),0) received_at_papermill'),
                    DB::raw('NVL(ROUND(SUM(total_weight_accepted),1),0) total_weight_accepted'),
                    DB::raw('NVL(ROUND(SUM(moisture_content_and_contaminant),1),0) moisture_content_and_contaminant'),
                    DB::raw('YEAR(sale_date) year'),
                    DB::raw('QUARTER(sale_date) quarter')
                )
                ->groupBy('year','quarter')
                ->orderBy('sale_date', 'asc');
        } else if ($request->type == "year") {
            $salesColumnChart = DB::table('sales')
                ->where('sale_date', '>=',$request->startDates)
                ->where('sale_date', '<=',$request->endDates)
                ->select(
                    DB::raw('NVL(ROUND(SUM(delivered_to_papermill),1),0) delivered_to_papermill'),
                    DB::raw('NVL(ROUND(SUM(received_at_papermill),1),0) received_at_papermill'),
                    DB::raw('NVL(ROUND(SUM(total_weight_accepted),1),0) total_weight_accepted'),
                    DB::raw('NVL(ROUND(SUM(moisture_content_and_contaminant),1),0) moisture_content_and_contaminant'),
                    DB::raw('YEAR(sale_date) year'),
                )
                ->groupBy('year')
                ->orderBy('sale_date', 'asc');
        }

        if (isset($request->id_papermills) && count($request->id_papermills) != 0) {
            $salesColumnChart = $salesColumnChart->whereIn('id_papermill', $request->id_papermills);
        }

        $salesColumnChart = $salesColumnChart->get();

        /* END OF QUERY */
        $salesSentVsRecieved = [];
        $dynamicsOfMCC = [];

        $dynamicsKMKSentLabel = [];
        $dynamicsKMKSentData = [];

        $dynamicsKMKRecievedLabel = [];
        $dynamicsKMKRecievedData = [];

        $dynamicsKMKAcceptedLabel = [];
        $dynamicsKMKAcceptedData = [];

        if ($request->type == "month") {

            array_push($salesSentVsRecieved,['Month', 'Delivered to Papermill', 'Received at Papermill']);
            array_push($dynamicsOfMCC,['Month', 'MCC']);

//            $salesSentVsRecieved = [
//                ['Month', 'Delivered to Papermill', 'Received at Papermill'],
//            ];
//
//            $dynamicsOfMCC = [
//                ['Month', 'MCC'],
//            ];

            foreach ($salesColumnChart as $salesColumn) {
                array_push($salesSentVsRecieved, [$salesColumn->monthName."\n".$salesColumn->year, $salesColumn->delivered_to_papermill,$salesColumn->received_at_papermill]);

                array_push($dynamicsKMKSentLabel, [$salesColumn->monthName,$salesColumn->year]);
                array_push($dynamicsKMKSentData, [$salesColumn->delivered_to_papermill]);

                array_push($dynamicsKMKRecievedLabel, [$salesColumn->monthName,$salesColumn->year]);
                array_push($dynamicsKMKRecievedData, [$salesColumn->received_at_papermill]);

                array_push($dynamicsKMKAcceptedLabel, [$salesColumn->monthName,$salesColumn->year]);
                array_push($dynamicsKMKAcceptedData, [$salesColumn->total_weight_accepted]);

                array_push($dynamicsOfMCC,[$salesColumn->monthName."\n".$salesColumn->year,$salesColumn->moisture_content_and_contaminant]);
            }

        } else if ($request->type == "quarter"){
            array_push($salesSentVsRecieved,['Quarter', 'Delivered to Papermill', 'Received at Papermill']);
            array_push($dynamicsOfMCC,['Quarter', 'MCC']);


            foreach ($salesColumnChart as $salesColumn) {
                array_push($salesSentVsRecieved, ['Q'.$salesColumn->quarter."\n".$salesColumn->year, $salesColumn->delivered_to_papermill,$salesColumn->received_at_papermill]);

                array_push($dynamicsKMKSentLabel, ['Q'.$salesColumn->quarter,$salesColumn->year]);
                array_push($dynamicsKMKSentData, [$salesColumn->delivered_to_papermill]);

                array_push($dynamicsKMKRecievedLabel, ['Q'.$salesColumn->quarter,$salesColumn->year]);
                array_push($dynamicsKMKRecievedData, [$salesColumn->received_at_papermill]);

                array_push($dynamicsKMKAcceptedLabel, ['Q'.$salesColumn->quarter,$salesColumn->year]);
                array_push($dynamicsKMKAcceptedData, [$salesColumn->total_weight_accepted]);

                array_push($dynamicsOfMCC,['Q'.$salesColumn->quarter."\n".$salesColumn->year,$salesColumn->moisture_content_and_contaminant]);
            }

        } else if ($request->type == "year"){
            array_push($salesSentVsRecieved,['Year', 'Delivered to Papermill', 'Received at Papermill']);
            array_push($dynamicsOfMCC,['Year', 'MCC']);

            foreach ($salesColumnChart as $salesColumn) {
                array_push($salesSentVsRecieved, [''.$salesColumn->year, $salesColumn->delivered_to_papermill,$salesColumn->received_at_papermill]);

                array_push($dynamicsKMKSentLabel, [''.$salesColumn->year]);
                array_push($dynamicsKMKSentData, [$salesColumn->delivered_to_papermill]);

                array_push($dynamicsKMKRecievedLabel, [''.$salesColumn->year]);
                array_push($dynamicsKMKRecievedData, [$salesColumn->received_at_papermill]);

                array_push($dynamicsKMKAcceptedLabel, [''.$salesColumn->year]);
                array_push($dynamicsKMKAcceptedData, [$salesColumn->total_weight_accepted]);

                array_push($dynamicsOfMCC,[''.$salesColumn->year,$salesColumn->moisture_content_and_contaminant]);
            }
        }

        if (sizeof($salesColumnChart) === 0) {
            array_push($salesSentVsRecieved, ['', 0, 0]);
            array_push($dynamicsKMKSentLabel, ['']);
            array_push($dynamicsKMKSentData, [0]);

            array_push($dynamicsKMKRecievedLabel, ['']);
            array_push($dynamicsKMKRecievedData, [0]);

            array_push($dynamicsKMKAcceptedLabel, ['']);
            array_push($dynamicsKMKAcceptedData, [0]);

            array_push($dynamicsOfMCC,['',0]);
        }


        $data = [
            'delivered_to_papermill' => $sales->delivered_to_papermill,
            'received_at_papermill' =>$sales->received_at_papermill,
            'weighing_scale_gap_papermill'=> $sales->weighing_scale_gap_papermill,
            'weighing_scale_gap_papermill_percent' => $sales->weighing_scale_gap_papermill_percent,
            'total_weight_accepted' => $sales->total_weight_accepted,
            'weightReduction' => $weightReduction,
            'mcc' => $mcc,
            'salesSentVsRecieved' => $salesSentVsRecieved,
            'dynamicsKMKSentLabel' => $dynamicsKMKSentLabel,
            'dynamicsKMKSentData' => $dynamicsKMKSentData,
            'dynamicsKMKRecievedLabel' => $dynamicsKMKRecievedLabel,
            'dynamicsKMKRecievedData' => $dynamicsKMKRecievedData,
            'dynamicsKMKAcceptedLabel' => $dynamicsKMKAcceptedLabel,
            'dynamicsKMKAcceptedData' => $dynamicsKMKAcceptedData,
            'dynamicsMcc' => $dynamicsOfMCC,
        ];

        return response()->json(['data'=>$data]);
    }
}
