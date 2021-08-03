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

    /*
    public function getComparisonLineChartData (Request $request) {
        if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
            $participants = $request->idParticipant;
        } else {
            $participants = Participant::pluck('id')->toArray();
        }

        $start = new DateTime($request->startDates);
        $end = new DateTime($request->endDates.' 23:59');

        if ($request->type == 'week') {
            $diff = date_diff($start, $end);
            $interval = new DateInterval('P1D');
            $dateRange = new DatePeriod($start, $interval, $end);

            $weekNumber = 1;
            $weeks = array();

            if ($diff->days >= 29) {
                foreach ($dateRange as $date) {
                    $weeks[$weekNumber][] = $date->format('Y-m-d');
                    if ($date->format('w') == 6) {
                        $weekNumber++;
                    }
                }

                $weekRanges = [];
                $participantsCollections = [];
                $countPushWeekRanges = 0;
                $listColor = array("#99B898", "#FECEA8", "#FF847C", "#E84A5F", "#474747","#2494be","F6B75A","#c6ebc9","#70af85","#f0e2d0","#aa8976","#125d98");

                foreach ($participants as $participant) {
                    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                    $weekCollections[$participant] = [];

                    foreach ($weeks as $week) {
                        if ($countPushWeekRanges == 0) {
                            array_push($weekRanges, date('d/m/Y', strtotime($week[0])).' - '.date('d/m/Y', strtotime($week[count($week)-1])));
                        }

                        $collections = Collection::join('participants','collections.id_participant','=','participants.id')
                                                    ->where('collect_date', '>=', $week[0])
                                                    ->where('collect_date', '<=', $week[count($week)-1])
                                                    ->where('id_participant', '=', $participant);

                        if (isset($request->idCategory) && count($request->idCategory) != 0) {
                            $collections = $collections->whereIn('id_category', $request->idCategory);
                        }

                        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                            $collections = $collections->whereIn('id_district', $request->idDistrict);
                        }

                        if (isset($request->idRegency) && count($request->idRegency) != 0) {
                            $collections = $collections->whereIn('id_regency', $request->idRegency);
                        }

                        $collections = $collections->sum('quantity');
                        array_push($weekCollections[$participant], $collections);

                    }
                    $countPushWeekRanges++;
                    if (array_sum($weekCollections[$participant]) > 0) {
                        $participantName = Participant::where('id','=',$participant)->pluck('participant_name');
                        $participantCollection = [
                            'label' => $participantName[0],
                            'data'  => $weekCollections[$participant],
                            'lineTension'=> 0,
                            'fill'=> !1,
                            'borderColor'=> $color,
                            'pointBorderColor'=> $color,
                            'pointBackgroundColor'=> "#FFF",
                            'pointBorderWidth'=> 2,
                            'pointHoverBorderWidth'=> 2,
                            'pointRadius'=> 4,
                        ];
                        array_push($participantsCollections, $participantCollection);
                    }

                }
                Log::info($weekRanges);
                Log::info($participantsCollections);
                return response()->json(['weekRanges'=>$weekRanges, 'participantsCollections'=>$participantsCollections]);
            } else {
                foreach ($dateRange as $date) {
                    $weeks[$weekNumber] = $date->format('Y-m-d');
                    $weekNumber++;
                }

                $weekRanges = [];
                $participantsCollections = [];
                $countPushWeekRanges = 0;
                foreach ($participants as $participant) {
                    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                    $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                    $weekCollections[$participant] = [];
                    foreach ($weeks as $week) {
                        if ($countPushWeekRanges == 0) {
                            array_push($weekRanges, date('d/m/Y', strtotime($week)));
                        }

                        $collections = Collection::join('participants','collections.id_participant','=','participants.id')
                                                    ->where('collect_date', '=', $week)
                                                    ->where('id_participant', '=', $participant);

                        if (isset($request->idCategory) && count($request->idCategory) != 0) {
                            $collections = $collections->whereIn('id_category', $request->idCategory);
                        }

                        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                            $collections = $collections->whereIn('id_district', $request->idDistrict);
                        }

                        if (isset($request->idRegency) && count($request->idRegency) != 0) {
                            $collections = $collections->whereIn('id_regency', $request->idRegency);
                        }

                        $collections = $collections->sum('quantity');

                        array_push($weekCollections[$participant], $collections);
                    }
                    $countPushWeekRanges++;
                    if (array_sum($weekCollections[$participant]) > 0) {
                        $participantName = Participant::where('id','=',$participant)->pluck('participant_name');
                        $participantCollection = [
                            'label' => $participantName[0],
                            'data'  => $weekCollections[$participant],
                            'lineTension'=> 0,
                            'fill'=> !1,
                            'borderColor'=> $color,
                            'pointBorderColor'=> $color,
                            'pointBackgroundColor'=> "#FFF",
                            'pointBorderWidth'=> 2,
                            'pointHoverBorderWidth'=> 2,
                            'pointRadius'=> 4,
                        ];
                        array_push($participantsCollections, $participantCollection);
                    }
                }
                return response()->json(['weekRanges'=>$weekRanges, 'participantsCollections'=>$participantsCollections, 'diff'=>$diff->days]);
            }
        } else {
            $weekRanges = [];
            $months = [];
            $monthStart = new DateTime($request->startDates);
            $monthEnd = new DateTime($request->endDates.' 23:59');
            $monthStart->modify('first day of this month');
            $monthEnd->modify('last day of this month');
            $interval = DateInterval::createFromDateString('1 month');
            $period   = new DatePeriod($monthStart, $interval, $monthEnd);

            foreach ($period as $dt) {
                array_push($months, $dt->format("m"));
            }
            $participantsCollections = [];
            $countPushWeekRanges = 0;
            foreach ($participants as $participant) {
                $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
                $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
                $weekCollections[$participant] = [];
                foreach ($months as $month) {
                    $collections = Collection::selectRaw('SUM(quantity) AS sum_quantity')
                                            ->join('participants','collections.id_participant','=','participants.id')
                                            ->whereMonth('collect_date','=',$month)
                                            ->where('collect_date', '>=', $start)
                                            ->where('collect_date', '<=', $end)
                                            ->where('id_participant','=',$participant);

                    if (isset($request->idCategory) && count($request->idCategory) != 0) {
                        $collections = $collections->whereIn('id_category', $request->idCategory);
                    }

                    if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                        $collections = $collections->whereIn('id_district', $request->idDistrict);
                    }

                    if (isset($request->idRegency) && count($request->idRegency) != 0) {
                        $collections = $collections->whereIn('id_regency', $request->idRegency);
                    }

                    $collections = $collections->first();
                    if ($countPushWeekRanges == 0) {
                        $monthNum = $month;
                        $dateObj  = DateTime::createFromFormat('!m', $monthNum);
                        $monthName = $dateObj->format('F');
                        array_push($weekRanges, $monthName);
                    }

                    if ($collections->sum_quantity != null) {
                        $result = $collections->sum_quantity;
                    } else {
                        $result = 0;
                    }

                    array_push($weekCollections[$participant], $result);
                }

                $countPushWeekRanges++;
                if (array_sum($weekCollections[$participant]) > 0) {
                    $participantName = Participant::where('id','=',$participant)->pluck('participant_name');
                    $participantCollection = [
                        'label' => $participantName[0],
                        'data'  => $weekCollections[$participant],
                        'lineTension'=> 0,
                        'fill'=> !1,
                        'borderColor'=> $color,
                        'pointBorderColor'=> $color,
                        'pointBackgroundColor'=> "#FFF",
                        'pointBorderWidth'=> 2,
                        'pointHoverBorderWidth'=> 2,
                        'pointRadius'=> 4,
                    ];
                    array_push($participantsCollections, $participantCollection);
                }
            }

            return response()->json(['weekRanges'=>$weekRanges, 'participantsCollections'=>$participantsCollections, 'a'=>$start]);
        }

    }
    */


    public function getComparisonLineChartData (Request $request) {
        $listColor = array("#99B898", "#FECEA8", "#FF847C", "#E84A5F", "#474747","#2494be","F6B75A","#c6ebc9","#70af85","#f0e2d0","#aa8976","#125d98");
        if ($request->type == 'week') {
            $collections = DB::table('collections')
                ->leftJoin('participants', function ($join) {
                    $join->on('collections.id_participant', '=', 'participants.id');
                })
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
//                ->whereIn('participants.id', [33,50])
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

        } else {
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
        } else {
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
}
