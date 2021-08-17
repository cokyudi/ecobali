<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Collection;
use App\Models\Participant;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Models\DashboardComparison;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\Log;


class DashboardComparisonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $participants = Participant::latest()->get();
        $categories = Category::latest()->get();
        $regencies = Regency::latest()->get();
        $districts = District::latest()->get();

        return view('dashboardComparison/index',compact('user','participants','categories','regencies','districts'));
    }

    public function getComparisonLineChartData (Request $request) {
        $listColor = array("#99B898", "#FECEA8", "#FF847C", "#E84A5F", "#474747","#2494be","F6B75A","#c6ebc9","#70af85","#f0e2d0","#aa8976","#125d98");
        if ($request->type == 'week') {
            $collections = DB::table('collections')
                ->leftJoin('participants', function ($join) {
                    $join->on('collections.id_participant', '=', 'participants.id');
                })
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('FLOOR((DAYOFMONTH(collect_date) - 1) / 7) + 1 week_of_month'),
                    DB::raw('MONTH(collect_date) month'),
                    DB::raw('DATE_FORMAT(collect_date, "%b") monthName'),
                    DB::raw('YEAR(collect_date) year'),
                    'participants.participant_name',
                    'participants.id',
                )
                ->groupBy('year','month','week_of_month','monthName','participant_name','id');

        } else if ($request->type == 'month'){
            $collections = DB::table('collections')
                ->leftJoin('participants', function ($join) {
                    $join->on('collections.id_participant', '=', 'participants.id');
                })
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('MONTH(collect_date) month'),
                    DB::raw('MONTHNAME(collect_date) monthName'),
                    DB::raw('YEAR(collect_date) year'),
                    'participants.participant_name',
                    'participants.id',
                )
                ->groupBy('month','monthName','year','participant_name','id');
        } else if ($request->type == 'quarter'){
            $collections = DB::table('collections')
                ->leftJoin('participants', function ($join) {
                    $join->on('collections.id_participant', '=', 'participants.id');
                })
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('YEAR(collect_date) year'),
                    DB::raw('QUARTER(collect_date) quarter'),
                    'participants.participant_name',
                    'participants.id',
                )
                ->groupBy('quarter','year','participant_name','id');
        } else if ($request->type == 'year'){
            $collections = DB::table('collections')
                ->leftJoin('participants', function ($join) {
                    $join->on('collections.id_participant', '=', 'participants.id');
                })
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('YEAR(collect_date) year'),
                    'participants.participant_name',
                    'participants.id',
                )
                ->groupBy('year','participant_name','id');
        }

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $collections = $collections->whereIn('participants.id_category', $request->idCategory);
        }

        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $collections = $collections->whereIn('participants.id_district', $request->idDistrict);
        }

        if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
            $collections = $collections->whereIn('participants.id', $request->idParticipant);
        }

        if (isset($request->idRegency) && count($request->idRegency) != 0) {
            $collections = $collections->whereIn('participants.id_regency', $request->idRegency);
        }

        $collections = $collections->get();

        $group = [];
        $intervalName = array();
        $intervalMap = [];
        $participantsCollections = [];

        if ($request->type == 'week') {
            foreach($collections as $collection) {
                $group[$collection->id][] = $collection;
                $intervalName[] = (['W'.$collection->week_of_month,$collection->monthName,$collection->year]);
                $intervalMap[] = array(
                    "week_of_month"=>$collection->week_of_month,
                    "month"=>$collection->month,
                    "year"=>$collection->year,
                );
            }

            $intervalUnique = array_unique($intervalMap,SORT_REGULAR);
            $intervalNameUnique = array_unique($intervalName,SORT_REGULAR);


            foreach ($group as $grp) {
                $dataQty = $this->getQtyByWeek($intervalUnique, $grp);
                $participantCollection = [
                    'label' => $grp[0]->participant_name,
                    'data'  => $dataQty,
                    'lineTension'=> 0,
                    'fill'=> !1,
                    'borderColor'=> $listColor[array_rand($listColor)],
                    'pointBorderColor'=> $listColor[array_rand($listColor)],
                    'pointBackgroundColor'=> "#FFF",
                    'pointBorderWidth'=> 2,
                    'pointHoverBorderWidth'=> 2,
                    'pointRadius'=> 4,
                ];
                array_push($participantsCollections, $participantCollection);
            }
        } else if ($request->type == 'month') {
            foreach($collections as $collection) {
                $group[$collection->id][] = $collection;
                $intervalName[] = ([$collection->monthName,$collection->year]);
                $intervalMap[] = array(
                    "month"=>$collection->month,
                    "year"=>$collection->year,
                );
            }

            $intervalUnique = array_unique($intervalMap,SORT_REGULAR);
            $intervalNameUnique = array_unique($intervalName,SORT_REGULAR);

            foreach ($group as $grp) {
                $dataQty = $this->getQtyByMonth($intervalUnique, $grp);
                $participantCollection = [
                    'label' => $grp[0]->participant_name,
                    'data'  => $dataQty,
                    'lineTension'=> 0,
                    'fill'=> !1,
                    'borderColor'=> $listColor[array_rand($listColor)],
                    'pointBorderColor'=> $listColor[array_rand($listColor)],
                    'pointBackgroundColor'=> "#FFF",
                    'pointBorderWidth'=> 2,
                    'pointHoverBorderWidth'=> 2,
                    'pointRadius'=> 4,
                ];
                array_push($participantsCollections, $participantCollection);
            }

        } else if ($request->type == 'quarter') {
            foreach($collections as $collection) {
                $group[$collection->id][] = $collection;
                $intervalName[] = (['Q'.$collection->quarter,$collection->year]);
                $intervalMap[] = array(
                    "quarter"=>$collection->quarter,
                    "year"=>$collection->year,
                );
            }

            $intervalUnique = array_unique($intervalMap,SORT_REGULAR);
            $intervalNameUnique = array_unique($intervalName,SORT_REGULAR);

            foreach ($group as $grp) {
                $dataQty = $this->getQtyByQuarter($intervalUnique, $grp);
                $participantCollection = [
                    'label' => $grp[0]->participant_name,
                    'data'  => $dataQty,
                    'lineTension'=> 0,
                    'fill'=> !1,
                    'borderColor'=> $listColor[array_rand($listColor)],
                    'pointBorderColor'=> $listColor[array_rand($listColor)],
                    'pointBackgroundColor'=> "#FFF",
                    'pointBorderWidth'=> 2,
                    'pointHoverBorderWidth'=> 2,
                    'pointRadius'=> 4,
                ];
                array_push($participantsCollections, $participantCollection);
            }

        } else if ($request->type == 'year') {
            foreach($collections as $collection) {
                $group[$collection->id][] = $collection;
                $intervalName[] = ([''.$collection->year]);
                $intervalMap[] = array(
                    "year"=>$collection->year,
                );
            }

            $intervalUnique = array_unique($intervalMap,SORT_REGULAR);
            $intervalNameUnique = array_unique($intervalName,SORT_REGULAR);

            foreach ($group as $grp) {
                $dataQty = $this->getQtyByYear($intervalUnique, $grp);
                $participantCollection = [
                    'label' => $grp[0]->participant_name,
                    'data'  => $dataQty,
                    'lineTension'=> 0,
                    'fill'=> !1,
                    'borderColor'=> $listColor[array_rand($listColor)],
                    'pointBorderColor'=> $listColor[array_rand($listColor)],
                    'pointBackgroundColor'=> "#FFF",
                    'pointBorderWidth'=> 2,
                    'pointHoverBorderWidth'=> 2,
                    'pointRadius'=> 4,
                ];
                array_push($participantsCollections, $participantCollection);
            }

        }

        $intervalSend = [];
        foreach ($intervalNameUnique as $unique) {
            array_push($intervalSend, $unique);
        }

        return response()->json(['intervalss'=>$intervalSend, 'participantsCollections'=>$participantsCollections]);
    }


    public static function getQtyByWeek($intervalMap, $collection) {
        $dataQty = [];
        foreach ($intervalMap as $interval) {
            $qty = 0;
            foreach ($collection as $col) {
                if ($interval['week_of_month'] == $col->week_of_month && $interval['month'] == $col->month && $col->year == $interval['year']) {
                    $qty = $col->qty;
                    array_push($dataQty,$col->qty );
                    break;
                }
            }
            if ($qty == 0) {
                array_push($dataQty,0 );
            }
        }

        return $dataQty;
    }

    public static function getQtyByMonth($intervalMap, $collection) {
        $dataQty = [];
        foreach ($intervalMap as $interval) {
            $qty = 0;
            foreach ($collection as $col) {
                if ($interval['month'] == $col->month && $col->year == $interval['year']) {
                    $qty = $col->qty;
                    array_push($dataQty,$col->qty );
                    break;
                }
            }
            if ($qty == 0) {
                array_push($dataQty,0 );
            }
        }

        return $dataQty;
    }

    public static function getQtyByQuarter($intervalMap, $collection) {
        $dataQty = [];
        foreach ($intervalMap as $interval) {
            $qty = 0;
            foreach ($collection as $col) {
                if ($interval['quarter'] == $col->quarter && $col->year == $interval['year']) {
                    $qty = $col->qty;
                    array_push($dataQty,$col->qty );
                    break;
                }
            }
            if ($qty == 0) {
                array_push($dataQty,0 );
            }
        }

        return $dataQty;
    }

    public static function getQtyByYear($intervalMap, $collection) {
        $dataQty = [];
        foreach ($intervalMap as $interval) {
            $qty = 0;
            foreach ($collection as $col) {
                if ($col->year == $interval['year']) {
                    $qty = $col->qty;
                    array_push($dataQty,$col->qty );
                    break;
                }
            }
            if ($qty == 0) {
                array_push($dataQty,0 );
            }
        }

        return $dataQty;
    }
}
