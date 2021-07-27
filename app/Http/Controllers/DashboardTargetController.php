<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
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

        return view('dashboardTarget/index',compact('user'));
    }

    public static function getTarget($categoryID,$startDate,$endDate) {

        $dateRange = DB::table('collections')
            ->select(
                DB::raw('MONTH(collect_date) month'),
                DB::raw('YEAR(collect_date) year'),
            )
            ->where('collect_date', '>=',$startDate)
            ->where('collect_date', '<=',$endDate)
            ->groupBy('month','year')->get();

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

    /* Start Actual vs Target by Categories */
    public function getActualTargetBar(Request $request) {

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
            ->where('collect_date', '>=',$request->startDates)
            ->where('collect_date', '<=',$request->endDates)
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
            $data['target'][] = $this->getTarget($collection->category_id,$request->startDates,$request->endDates);
        }

        return response()->json(['data'=>$data]);
    }

    /* Start Actual vs Target by Categories */

    public function getActualTargetBarByMonth(Request $request) {

        /* Start Dinamics of Actual vs Target by Month */
        $totalQty = 0;
        $totalTarget = 0;

        $categories = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id');
            })
            ->select(
                'categories.id',
                'categories.category_name',
                'category_details.year',
                'category_details.semester_1_target',
                'category_details.semester_2_target',
            )
            ->get();


        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category->year.'-'.$category->id] = array(
                "semester_1_target"=>round($category->semester_1_target/6,1),
                "semester_2_target"=>round($category->semester_2_target/6,1),
            );

        }

        if($request->type == 'month') {
            $actualTargetBarByMonth = [
                ["Month", "Target", "Total"],
            ];

            $collections = DB::table('collections')
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('MONTHNAME(collect_date) monthName'),
                    DB::raw('MONTH(collect_date) month'),
                    DB::raw('YEAR(collect_date) year')
                )
                ->groupBy('monthName','month','year')
                ->orderBy('collect_date', 'asc')
                ->get();

            foreach ($collections as $collection) {
                $monltyTarget = $this->getMonthlyTargetForAllCategory($collection->month,$collection->year,$categories, $categoryMap);
                array_push($actualTargetBarByMonth, [$collection->monthName."\n".$collection->year, $monltyTarget,$collection->qty]);
                $totalQty += $collection->qty;
                $totalTarget += $monltyTarget;
            }
        } else {
            $actualTargetBarByMonth = [
                ["Quarter", "Target", "Total"],
            ];

            $collections = DB::table('collections')
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('YEAR(collect_date) year'),
                    DB::raw('QUARTER(collect_date) quarter')
                )
                ->groupBy('year','quarter')
                ->orderBy('collect_date', 'asc')
                ->get();

            foreach ($collections as $collection) {
                $quarterlyTarget = $this->getQuarterlyTargetForAllCategory($collection->quarter,$collection->year,$categories, $categoryMap);
                array_push($actualTargetBarByMonth, ['Q'.$collection->quarter."\n".$collection->year, $quarterlyTarget,$collection->qty]);
                $totalQty += $collection->qty;
                $totalTarget += $quarterlyTarget;
            }
        }

        /* End Dinamics of Actual vs Target by Month */


        /* Start Monthly Target Achievement */

        $dataPieChart = [
            ["Belum Terkumpul", "Terkumpul"]
        ];

        array_push($dataPieChart, ["Belum Terkumpul", $totalTarget-$totalQty]);
        array_push($dataPieChart, ["Terkumpul", $totalQty]);

        /* End Monthly Target Achievement */


        /* Start Annual Target Achievement (ecoBali) */

        $dataPieExplode = [
            ["Belum Terkumpul", "Terkumpul"]
        ];


        $currentYear = (new DateTime)->format("Y");
        $totalQtyYearly = $this->getYearlySumForAllCollection($currentYear);
        $totalTargetYearly = $this->getYearlyTargetForAllCategory($currentYear);
        array_push($dataPieExplode, ["Belum Terkumpul", $totalTargetYearly-$totalQtyYearly]);
        array_push($dataPieExplode, ["Terkumpul", $totalQtyYearly]);

        /* End Annual Target Achievement (ecoBali) */


        return response()->json([
            'dataByMonth' => $actualTargetBarByMonth,
            'dataPie' => $dataPieChart,
            'dataPieExplode' => $dataPieExplode,
        ]);
    }

    public static function getMonthlyTargetForAllCategory($month, $year, $categories, $categoryMap ) {
        $totalTarget = 0;

        foreach ($categories as $category) {
            if ($year == $category->year) {
                if ($month < 7) {
                    $totalTarget += $categoryMap[$year."-".$category->id]['semester_1_target'];
                } else {
                    $totalTarget += $categoryMap[$year."-".$category->id]['semester_2_target'];
                }
            }

        }

        return round($totalTarget,1);
    }

    public static function getQuarterlyTargetForAllCategory($quarter, $year, $categories, $categoryMap ) {
        $totalTarget = 0;

        foreach ($categories as $category) {
            if ($year == $category->year) {
                if ($quarter <= 2) {
                    $totalTarget += ($categoryMap[$year."-".$category->id]['semester_1_target'])*3;
                } else {
                    $totalTarget += ($categoryMap[$year."-".$category->id]['semester_2_target'])*3;
                }
            }

        }

        return round($totalTarget,1);
    }

    public static function getYearlySumForAllCollection($year) {
        $collections = DB::table('collections')
            ->select(
                DB::raw('ROUND(SUM(quantity),1) qty'),
            )
            ->where( DB::raw('YEAR(collect_date)'), '=', $year)
            ->first();

        $totalYearlyQty = $collections->qty;

        return round($totalYearlyQty,1);
    }

    public static function getYearlyTargetForAllCategory($year) {
        $categories = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id');
            })
            ->select(
                DB::raw('ROUND(SUM(category_details.semester_1_target),1) sumSmt1'),
                DB::raw('ROUND(SUM(category_details.semester_2_target),1) sumSmt2'),
            )
            ->where('category_details.year', '=',$year)
            ->first();

        $totalYearlyTarget = $categories->sumSmt1 + $categories->sumSmt2;

        return floor($totalYearlyTarget);
    }



}
