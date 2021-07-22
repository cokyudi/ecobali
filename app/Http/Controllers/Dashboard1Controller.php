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

            $collectionByRegency[$regencyName] = $totalCollectionByRegency;
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

            if ($request->idCategory != null && $request->idCategory != '' && $request->idCategory != 'all') {
                $countParticipant = $countParticipant->where('id_category','=',$request->idCategory);
            }
        
            if ($request->idDistrict != null && $request->idDistrict != '' && $request->idDistrict != 'all') {
                $countParticipant = $countParticipant->where('id_district','=',$request->idDistrict);
            }
        
            if ($request->idRegency != null && $request->idRegency != '' && $request->idRegency != 'all') {
                $countParticipant = $countParticipant->where('id_regency','=',$request->idRegency);
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

            if ($request->idCategory != null && $request->idCategory != '' && $request->idCategory != 'all') {
                $participantsCollections = $participantsCollections->where('id_category','=',$request->idCategory);
            }
        
            if ($request->idDistrict != null && $request->idDistrict != '' && $request->idDistrict != 'all') {
                $participantsCollections = $participantsCollections->where('id_district','=',$request->idDistrict);
            }
        
            if ($request->idRegency != null && $request->idRegency != '' && $request->idRegency != 'all') {
                $participantsCollections = $participantsCollections->where('id_regency','=',$request->idRegency);
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

    public function getCollectionByFilters (Request $request) {
        $regencies = Regency::latest()->get();
        $collectionByRegency = [];

        $queryCollections = Collection::join('participants','collections.id_participant','=','participants.id');

        $districtsCoverage = Collection::distinct('id_district')
                                        ->join('participants','collections.id_participant','=','participants.id');
        
        $totalParticipants = Collection::distinct('id_participant')
                                        ->join('participants','collections.id_participant','=','participants.id');
        
        if ($request->idCategory != null && $request->idCategory != '' && $request->idCategory != 'all') {
            $queryCollections = $queryCollections->where('id_category','=',$request->idCategory);
            $districtsCoverage = $districtsCoverage->where('id_category','=',$request->idCategory);
            $totalParticipants = $totalParticipants->where('id_category','=',$request->idCategory);
        }
    
        if ($request->idDistrict != null && $request->idDistrict != '' && $request->idDistrict != 'all') {
            $queryCollections = $queryCollections->where('id_district','=',$request->idDistrict);
            $districtsCoverage = $districtsCoverage->where('id_district','=',$request->idDistrict);
            $totalParticipants = $totalParticipants->where('id_district','=',$request->idDistrict);
        }
    
        if ($request->idRegency != null && $request->idRegency != '' && $request->idRegency != 'all') {
            $queryCollections = $queryCollections->where('id_regency','=',$request->idRegency);
            $districtsCoverage = $districtsCoverage->where('id_regency','=',$request->idRegency);
            $totalParticipants = $totalParticipants->where('id_regency','=',$request->idRegency);
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
                                            
                if ($request->idCategory != null && $request->idCategory != '' && $request->idCategory != 'all') {
                    $collections = $collections->where('id_category','=',$request->idCategory);
                }
            
                if ($request->idDistrict != null && $request->idDistrict != '' && $request->idDistrict != 'all') {
                    $collections = $collections->where('id_district','=',$request->idDistrict);
                }
            
                if ($request->idRegency != null && $request->idRegency != '' && $request->idRegency != 'all') {
                    $collections = $collections->where('id_regency','=',$request->idRegency);
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

                if ($request->idCategory != null && $request->idCategory != '' && $request->idCategory != 'all') {
                    $collections = $collections->where('id_category','=',$request->idCategory);
                }
            
                if ($request->idDistrict != null && $request->idDistrict != '' && $request->idDistrict != 'all') {
                    $collections = $collections->where('id_district','=',$request->idDistrict);
                }
            
                if ($request->idRegency != null && $request->idRegency != '' && $request->idRegency != 'all') {
                    $collections = $collections->where('id_regency','=',$request->idRegency);
                }
                $collections = $collections->sum('quantity');

                array_push($weekCollections, $collections);
            }
            return response()->json(['weekRanges'=>$weekRanges, 'weekCollections'=>$weekCollections, 'diff'=>$diff->days]);
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
