<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dashboard1;
use App\Models\District;
use App\Models\Collection;
use App\Models\Participant;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DateTime;
use DateInterval;
use DatePeriod;

class Dashboard1Controller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $categories = Category::latest()->get();
        $regencies = Regency::latest()->get();
        $districts = District::latest()->get();
        $collections = Collection::latest()->get();
        $participants = Participant::latest()->get();

        return view('dashboard1/index', array(
            'user' => $user, 
            'districts'=>$districts, 
            'collections'=> $collections, 
            'participants'=> $participants,
            'categories' => $categories,
            'regencies' => $regencies
        ));
    }

    public function getCollection (Request $request) {
        $collections = Collection::latest();
        $regencies = Regency::latest()->get();
        $collectionByRegency = [];

        $districtsCoverage = Collection::distinct('id_district')
                                        ->join('participants','collections.id_participant','=','participants.id');
        
        $totalParticipants = Collection::distinct('id_participant')
                                        ->join('participants','collections.id_participant','=','participants.id');

        $collections = $collections->whereBetween('collect_date', [$request->startDates,$request->endDates])->get();
        $districtsCoverage = $districtsCoverage->whereBetween('collect_date', [$request->startDates,$request->endDates])->count();
        $totalParticipants = $totalParticipants->whereBetween('collect_date', [$request->startDates,$request->endDates])->count();

        for ($i = 0; $i < count($regencies); $i++) {
            $regencyName = $regencies[$i]->regency_name;
            $countCollectionByRegency = Collection::join('participants','collections.id_participant','=','participants.id')
                                                    ->where('id_regency','=',$regencies[$i]->id)
                                                    ->whereBetween('collect_date', [$request->startDates,$request->endDates])
                                                    ->get();
            $totalCollectionByRegency = 0;
            for ($j = 0; $j < count($countCollectionByRegency); $j++) {
                $totalCollectionByRegency = $totalCollectionByRegency + $countCollectionByRegency[$j]->quantity;
            }

            if ($totalCollectionByRegency <= 10) {
                $opacity = 0.1;
            }

            if ($totalCollectionByRegency > 10 && $totalCollectionByRegency <= 50) {
                $opacity = 0.2;
            }

            if ($totalCollectionByRegency > 50 && $totalCollectionByRegency <= 100) {
                $opacity = 0.3;
            }

            if ($totalCollectionByRegency > 100 && $totalCollectionByRegency <= 500) {
                $opacity = 0.4;
            }

            if ($totalCollectionByRegency > 500 && $totalCollectionByRegency < 1000) {
                $opacity = 0.5;
            }

            if ($totalCollectionByRegency >= 1000) {
                $opacity = 0.6;
            }

            $collectionByRegency[$regencyName] = [$totalCollectionByRegency, $opacity];
        }

        $totalCollection = 0;
        for ($i = 0; $i < count($collections); $i++) {
            $totalCollection = $totalCollection + $collections[$i]->quantity;
        }

        $data = [
            'districtsCoverage' => $districtsCoverage,
            'totalParticipants'=> $totalParticipants,
            'totalCollection' => $totalCollection,
            'collectionByRegency' => $collectionByRegency
        ];

        return response()->json(['data'=>$data]);
    }

    public function getNumberOfParticipants(Request $request) {
        
        $participantCategory = Category::latest()->get();
        $numberOfParticipants = [
            ["Category", "Number of Participant"]
        ];

        for ($i = 0; $i < count($participantCategory); $i++) {
            $categoryName = $participantCategory[$i]->category_name;
            $countParticipant = Collection::distinct('id_participant')
                                            ->join('participants','collections.id_participant','=','participants.id')
                                            ->where('id_category', $participantCategory[$i]->id)
                                            ->whereBetween('collect_date', [$request->startDates,$request->endDates]);

            if (isset($request->idCategory) && count($request->idCategory) != 0) {
                $countParticipant = $countParticipant->whereIn('id_category', $request->idCategory);
            }
        
            if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                $countParticipant = $countParticipant->whereIn('id_district', $request->idDistrict);
            }
        
            if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
                $countParticipant = $countParticipant->whereIn('id_participant', $request->idParticipant);
            }

            $countParticipant = $countParticipant->count();
            
            if ($countParticipant !== 0) {
                array_push($numberOfParticipants, [$categoryName, $countParticipant]);
            }
        }

        return response()->json(['data'=>$numberOfParticipants]);
    }

    public function getContribution(Request $request) {
        $participantCategory = Category::latest()->get();
        $contribution = [
            ["Category", "Contribution"]
        ];

        for ($i = 0; $i < count($participantCategory); $i++) {
            $categoryName = $participantCategory[$i]->category_name;
            $participantsCollections = Collection::join('participants','collections.id_participant','=','participants.id')
                                                 ->join('categories','participants.id_category','=','categories.id')
                                                 ->where('categories.id', $participantCategory[$i]->id)
                                                 ->whereBetween('collect_date', [$request->startDates,$request->endDates]);

            if (isset($request->idCategory) && count($request->idCategory) != 0) {
                $participantsCollections = $participantsCollections->whereIn('id_category', $request->idCategory);
            }
        
            if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                $participantsCollections = $participantsCollections->whereIn('id_district', $request->idDistrict);
            }
        
            if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
                $participantsCollections = $participantsCollections->whereIn('id_participant', $request->idParticipant);
            }

            $participantsCollections = $participantsCollections->get();
            $categoryContribution = 0;
            for ($j = 0; $j < count($participantsCollections); $j++) {
                $categoryContribution = $categoryContribution + $participantsCollections[$j]->quantity;
            }

            if ($categoryContribution != 0) {
                array_push($contribution, [$categoryName, $categoryContribution]);
            }
            
        }

        return response()->json(['data'=>$contribution]);
    }

    public function getBarContribution(Request $request) {
        $participantCategory = Category::latest()->get();
        $contribution = [
            ["Category", "Contribution", ["role"=>"style"]]
        ];

        for ($i = 0; $i < count($participantCategory); $i++) {
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
            $categoryName = $participantCategory[$i]->category_name;
            $participantsCollections = Collection::join('participants','collections.id_participant','=','participants.id')
                                                 ->join('categories','participants.id_category','=','categories.id')
                                                 ->where('categories.id', $participantCategory[$i]->id)
                                                 ->whereBetween('collect_date', [$request->startDates,$request->endDates]);

            if (isset($request->idCategory) && count($request->idCategory) != 0) {
                $participantsCollections = $participantsCollections->whereIn('id_category', $request->idCategory);
            }
        
            if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                $participantsCollections = $participantsCollections->whereIn('id_district', $request->idDistrict);
            }
        
            if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
                $participantsCollections = $participantsCollections->whereIn('id_participant', $request->idParticipant);
            }

            $participantsCollections = $participantsCollections->get();
            $categoryContribution = 0;
            for ($j = 0; $j < count($participantsCollections); $j++) {
                $categoryContribution = $categoryContribution + $participantsCollections[$j]->quantity;
            }

            if ($categoryContribution != 0) {
                array_push($contribution, [$categoryName, $categoryContribution, $color]);
            }
            
        }

        return response()->json(['data'=>$contribution]);
    }

    public function getCollectionByFilters (Request $request) {
        $regencies = Regency::latest()->get();
        $collectionByRegency = [];

        $queryCollections = Collection::join('participants','collections.id_participant','=','participants.id');

        $districtsCoverage = Collection::distinct('id_district')
                                        ->join('participants','collections.id_participant','=','participants.id');
        
        $totalParticipants = Collection::distinct('id_participant')
                                        ->join('participants','collections.id_participant','=','participants.id');
        
        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $queryCollections = $queryCollections->whereIn('id_category', $request->idCategory);
            $districtsCoverage = $districtsCoverage->whereIn('id_category', $request->idCategory);
            $totalParticipants = $totalParticipants->whereIn('id_category', $request->idCategory);
        }
    
        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $queryCollections = $queryCollections->whereIn('id_district', $request->idDistrict);
            $districtsCoverage = $districtsCoverage->whereIn('id_district', $request->idDistrict);
            $totalParticipants = $totalParticipants->whereIn('id_district', $request->idDistrict);
        }
    
        if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
            $queryCollections = $queryCollections->whereIn('id_participant', $request->idParticipant);
            $districtsCoverage = $districtsCoverage->whereIn('id_participant', $request->idParticipant);
            $totalParticipants = $totalParticipants->whereIn('id_participant', $request->idParticipant);
        }

        $queryCollections = $queryCollections->whereBetween('collect_date', [$request->startDates,$request->endDates]);
        $districtsCoverage = $districtsCoverage->whereBetween('collect_date', [$request->startDates,$request->endDates]);
        $totalParticipants = $totalParticipants->whereBetween('collect_date', [$request->startDates,$request->endDates]);

        $collections = $queryCollections->get();
        $districtsCoverage = $districtsCoverage->count();
        $totalParticipants = $totalParticipants->count();

        $totalCollection = 0;
        for ($i = 0; $i < count($collections); $i++) {
            $totalCollection = $totalCollection + $collections[$i]->quantity;
        }

        for ($i = 0; $i < count($regencies); $i++) {
            $regencyName = $regencies[$i]->regency_name;
            $countCollectionByRegency = Collection::join('participants','collections.id_participant','=','participants.id')
                                                    ->where('id_regency','=',$regencies[$i]->id)
                                                    ->whereBetween('collect_date', [$request->startDates,$request->endDates])
                                                    ->get();
            $totalCollectionByRegency = 0;
            for ($j = 0; $j < count($countCollectionByRegency); $j++) {
                $totalCollectionByRegency = $totalCollectionByRegency + $countCollectionByRegency[$j]->quantity;
            }

            $collectionByRegency[$regencyName] = $totalCollectionByRegency;
        }

        $data = [
            'districtsCoverage' => $districtsCoverage,
            'totalParticipants'=> $totalParticipants,
            'totalCollection' => $totalCollection,
            'collectionByRegency' => $collectionByRegency
        ];

        return response()->json(['data'=>$data]);
    }

    public function getLineChartData (Request $request) {
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
                $weekCollections = [];
                foreach ($weeks as $week) {
                    array_push($weekRanges, date('d/m/Y', strtotime($week[0])).' - '.date('d/m/Y', strtotime($week[count($week)-1])));
        
                    $collections = Collection::join('participants','collections.id_participant','=','participants.id')
                                                ->where('collect_date', '>=', $week[0])
                                                ->where('collect_date', '<=', $week[count($week)-1]);
                                                
                    if (isset($request->idCategory) && count($request->idCategory) != 0) {
                        $collections = $collections->whereIn('id_category', $request->idCategory);
                    }
                
                    if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                        $collections = $collections->whereIn('id_district', $request->idDistrict);
                    }
                
                    if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
                        $collections = $collections->whereIn('id_participant', $request->idParticipant);
                    }
                    $collections = $collections->sum('quantity');
                    array_push($weekCollections, $collections);
                }
                return response()->json(['weekRanges'=>$weekRanges, 'weekCollections'=>$weekCollections]);
            } else {
                foreach ($dateRange as $date) {
                    $weeks[$weekNumber] = $date->format('Y-m-d');
                    $weekNumber++;
                }
                
                $weekRanges = [];
                $weekCollections = [];
                foreach ($weeks as $week) {
                    array_push($weekRanges, date('d/m/Y', strtotime($week)));
        
                    $collections = Collection::join('participants','collections.id_participant','=','participants.id')
                                                ->where('collect_date', '=', $week);
    
                    if (isset($request->idCategory) && count($request->idCategory) != 0) {
                        $collections = $collections->whereIn('id_category', $request->idCategory);
                    }
                
                    if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                        $collections = $collections->whereIn('id_district', $request->idDistrict);
                    }
                
                    if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
                        $collections = $collections->whereIn('id_participant','=',$request->idParticipant);
                    }
                    $collections = $collections->sum('quantity');
    
                    array_push($weekCollections, $collections);
                }
                return response()->json(['weekRanges'=>$weekRanges, 'weekCollections'=>$weekCollections, 'diff'=>$diff->days]);
            }   
        } else {
            $weekRanges = [];
            $weekCollections = [];
            $collections = Collection::selectRaw('SUM(quantity) AS sum_quantity, MONTH(collect_date) AS month')
                                        ->join('participants','collections.id_participant','=','participants.id')
                                        ->where('collect_date', '>=', $start)
                                        ->where('collect_date', '<=', $end);
                                        
            if (isset($request->idCategory) && count($request->idCategory) != 0) {
                $collections = $collections->whereIn('id_category', $request->idCategory);
            }
        
            if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
                $collections = $collections->whereIn('id_district', $request->idDistrict);
            }
        
            if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
                $collections = $collections->whereIn('id_participant', $request->idParticipant);
            }
            $collections = $collections->groupBy('month')->get();
            foreach ($collections as $collection) {
                $monthNum = $collection->month;
                $dateObj  = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F');
                array_push($weekRanges, $monthName);
                array_push($weekCollections, $collection->sum_quantity);
            }
            
            return response()->json(['weekRanges'=>$weekRanges, 'weekCollections'=>$weekCollections]);
        }
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard1  $dashboard1
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard1 $dashboard1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard1  $dashboard1
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard1 $dashboard1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard1  $dashboard1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard1 $dashboard1)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard1  $dashboard1
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard1 $dashboard1)
    {
        //
    }
}
