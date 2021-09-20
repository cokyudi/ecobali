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
use Illuminate\Support\Facades\Log;

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
        $categories = DB::table('categories')->orderBy('category_name', 'asc')->get();
        $regencies = DB::table('regencies')->orderBy('regency_name', 'asc')->get();
        $districts = DB::table('districts')->orderBy('district_name', 'asc')->get();
        $participants = DB::table('participants')->orderBy('participant_name', 'asc')->get();

        return view('dashboard1/index', array(
            'user' => $user,
            'districts'=>$districts,
            'participants'=> $participants,
            'categories' => $categories,
            'regencies' => $regencies
        ));
    }

    public function getCollection (Request $request) {
        $collections = Collection::latest();

        $districtsCoverage = Collection::distinct('id_district')
                                        ->join('participants','collections.id_participant','=','participants.id');
        $regenciesCoverage = Collection::distinct('id_regency')
            ->join('participants','collections.id_participant','=','participants.id');

        $totalParticipants = Collection::distinct('id_participant')
                                        ->join('participants','collections.id_participant','=','participants.id');

        $collections = $collections->whereBetween('collect_date', [$request->startDates,$request->endDates])->get();
        $districtsCoverage = $districtsCoverage->whereBetween('collect_date', [$request->startDates,$request->endDates])->count();
        $regenciesCoverage = $regenciesCoverage->whereBetween('collect_date', [$request->startDates,$request->endDates])->count();
        $totalParticipants = $totalParticipants->whereBetween('collect_date', [$request->startDates,$request->endDates])->count();

        $totalCollection = 0;
        for ($i = 0; $i < count($collections); $i++) {
            $totalCollection = $totalCollection + $collections[$i]->quantity;
        }

        $data = [
            'districtsCoverage' => $districtsCoverage,
            'regenciesCoverage' =>$regenciesCoverage,
            'totalParticipants'=> $totalParticipants,
            'totalCollection' => $totalCollection,
        ];

        return response()->json(['data'=>$data]);
    }

    public function getNumberOfParticipants(Request $request) {
        $mapColor = [];
        $mapColor[1] = "#FCF377";
        $mapColor[2] = "#8BCFC7";
        $mapColor[3] = "#F59AF5";
        $mapColor[4] = "#185e40";
        $mapColor[5] = "#888781";
        $mapColor[6] = "#0F0E0F";
        $mapColor[7] = "#B622FF";
        $mapColor[8] = "#3560BC";
        $mapColor[9] = "#FCA21E";
        $mapColor[10] = "#FE4E54";
        $mapColor[11] = "#11E98A";
        $mapColor[12] = "#7dcdf3";
        $mapColor[13] = "#99B898";
        $mapColor[14] = "#FECEA8";
        $mapColor[15] = "#FF847C";
        $mapColor[16] = "#E84A5F";
        $mapColor[17] = "#474747";
        $dataColor = [];

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

            if (isset($request->idRegency) && count($request->idRegency) != 0) {
                $countParticipant = $countParticipant->whereIn('id_regency', $request->idRegency);
            }

            $countParticipant = $countParticipant->count();

            if ($countParticipant !== 0) {
                array_push($numberOfParticipants, [$categoryName, $countParticipant]);
                array_push($dataColor, $mapColor[$participantCategory[$i]->id]);
            }

        }


        return response()->json(['data'=>$numberOfParticipants,'dataColor'=>$dataColor]);
    }

    public function getContribution(Request $request) {
        $participantCategory = Category::latest()->get();

        $mapColor = [];
        $mapColor[1] = "#FCF377";
        $mapColor[2] = "#8BCFC7";
        $mapColor[3] = "#F59AF5";
        $mapColor[4] = "#185e40";
        $mapColor[5] = "#888781";
        $mapColor[6] = "#0F0E0F";
        $mapColor[7] = "#B622FF";
        $mapColor[8] = "#3560BC";
        $mapColor[9] = "#FCA21E";
        $mapColor[10] = "#FE4E54";
        $mapColor[11] = "#11E98A";
        $mapColor[12] = "#7dcdf3";
        $mapColor[13] = "#99B898";
        $mapColor[14] = "#FECEA8";
        $mapColor[15] = "#FF847C";
        $mapColor[16] = "#E84A5F";
        $mapColor[17] = "#474747";
        $dataColor = [];

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

            if (isset($request->idRegency) && count($request->idRegency) != 0) {
                $participantsCollections = $participantsCollections->whereIn('id_regency', $request->idRegency);
            }

            $participantsCollections = $participantsCollections->get();
            $categoryContribution = 0;
            for ($j = 0; $j < count($participantsCollections); $j++) {
                $categoryContribution = $categoryContribution + $participantsCollections[$j]->quantity;
            }

            if ($categoryContribution != 0) {
                array_push($contribution, [$categoryName, $categoryContribution]);
                array_push($dataColor, $mapColor[$participantCategory[$i]->id]);
            }


        }

        return response()->json(['data'=>$contribution,'dataColor'=>$dataColor]);
    }

    public function getBarContribution(Request $request) {
        $contribution = [
            ["Category", "Contribution", ["role"=>"style"]]
        ];

        $mapColor = [];
        $mapColor[1] = "#FCF377";
        $mapColor[2] = "#8BCFC7";
        $mapColor[3] = "#F59AF5";
        $mapColor[4] = "#185e40";
        $mapColor[5] = "#888781";
        $mapColor[6] = "#0F0E0F";
        $mapColor[7] = "#B622FF";
        $mapColor[8] = "#3560BC";
        $mapColor[9] = "#FCA21E";
        $mapColor[10] = "#FE4E54";
        $mapColor[11] = "#11E98A";
        $mapColor[12] = "#7dcdf3";
        $mapColor[13] = "#99B898";
        $mapColor[14] = "#FECEA8";
        $mapColor[15] = "#FF847C";
        $mapColor[16] = "#E84A5F";
        $mapColor[17] = "#474747";

        $subParticipants = DB::table('participants')
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->select(
                'participants.id as participant_id',
                'participants.id_district as participant_district',
                'participants.id_regency as participant_regency',
                'categories.id as category_id',
                'categories.category_name as category_name',
            );

        $participantCollectionsByCategory =  DB::table('collections')
            ->where('collect_date', '>=',$request->startDates)
            ->where('collect_date', '<=',$request->endDates)
            ->joinSub($subParticipants, 'participants', function ($join) {
                $join->on('collections.id_participant', '=', 'participants.participant_id');
            })
            ->select('participants.category_name',
                'participants.category_id',
                DB::raw('ROUND(SUM(quantity),1) qty')
            )
            ->groupBy('category_name','category_id');

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $participantCollectionsByCategory = $participantCollectionsByCategory->whereIn('participants.category_id', $request->idCategory);
        }

        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $participantCollectionsByCategory = $participantCollectionsByCategory->whereIn('participants.participant_district', $request->idDistrict);
        }

        if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
            $participantCollectionsByCategory = $participantCollectionsByCategory->whereIn('participants.participant_id', $request->idParticipant);
        }

        if (isset($request->idRegency) && count($request->idRegency) != 0) {
            $participantCollectionsByCategory = $participantCollectionsByCategory->whereIn('participants.participant_regency', $request->idRegency);
        }

        $participantCollectionsByCategory = $participantCollectionsByCategory->get();

       foreach ($participantCollectionsByCategory as $collectionsByCategory) {
           array_push($contribution, [$collectionsByCategory->category_name, $collectionsByCategory->qty, $mapColor[$collectionsByCategory->category_id]]);
       }

       if (sizeof($participantCollectionsByCategory) === 0) {
           array_push($contribution, ['', 0, null]);
       }


       return response()->json(['data'=>$contribution]);
    }

    public function getCollectionByFilters (Request $request) {
        $regencies = Regency::latest()->get();
        $collectionByRegency = [];

        $queryCollections = Collection::join('participants','collections.id_participant','=','participants.id');

        $districtsCoverage = Collection::distinct('id_district')
                                        ->join('participants','collections.id_participant','=','participants.id');

        $regenciesCoverage = Collection::distinct('id_regency')
            ->join('participants','collections.id_participant','=','participants.id');

        $totalParticipants = Collection::distinct('id_participant')
                                        ->join('participants','collections.id_participant','=','participants.id');

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $queryCollections = $queryCollections->whereIn('id_category', $request->idCategory);
            $districtsCoverage = $districtsCoverage->whereIn('id_category', $request->idCategory);
            $regenciesCoverage = $regenciesCoverage->whereIn('id_category', $request->idCategory);
            $totalParticipants = $totalParticipants->whereIn('id_category', $request->idCategory);
        }

        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $queryCollections = $queryCollections->whereIn('id_district', $request->idDistrict);
            $districtsCoverage = $districtsCoverage->whereIn('id_district', $request->idDistrict);
            $regenciesCoverage = $regenciesCoverage->whereIn('id_district', $request->idDistrict);
            $totalParticipants = $totalParticipants->whereIn('id_district', $request->idDistrict);
        }

        if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
            $queryCollections = $queryCollections->whereIn('id_participant', $request->idParticipant);
            $districtsCoverage = $districtsCoverage->whereIn('id_participant', $request->idParticipant);
            $regenciesCoverage = $regenciesCoverage->whereIn('id_participant', $request->idParticipant);
            $totalParticipants = $totalParticipants->whereIn('id_participant', $request->idParticipant);
        }

        if (isset($request->idRegency) && count($request->idRegency) != 0) {
            $queryCollections = $queryCollections->whereIn('id_regency', $request->idRegency);
            $districtsCoverage = $districtsCoverage->whereIn('id_regency', $request->idRegency);
            $regenciesCoverage = $regenciesCoverage->whereIn('id_regency', $request->idRegency);
            $totalParticipants = $totalParticipants->whereIn('id_regency', $request->idRegency);
        }

        $queryCollections = $queryCollections->whereBetween('collect_date', [$request->startDates,$request->endDates]);
        $districtsCoverage = $districtsCoverage->whereBetween('collect_date', [$request->startDates,$request->endDates]);
        $regenciesCoverage = $regenciesCoverage->whereBetween('collect_date', [$request->startDates,$request->endDates]);
        $totalParticipants = $totalParticipants->whereBetween('collect_date', [$request->startDates,$request->endDates]);

        $collections = $queryCollections->get();
        $districtsCoverage = $districtsCoverage->count();
        $regenciesCoverage = $regenciesCoverage->count();
        $totalParticipants = $totalParticipants->count();

        $totalCollection = 0;
        for ($i = 0; $i < count($collections); $i++) {
            $totalCollection = $totalCollection + $collections[$i]->quantity;
        }

        $data = [
            'districtsCoverage' => $districtsCoverage,
            'regenciesCoverage' =>$regenciesCoverage,
            'totalParticipants'=> $totalParticipants,
            'totalCollection' => $totalCollection,
        ];

        return response()->json(['data'=>$data]);
    }

    public function getMapByFilters (Request $request) {

        $subParticipants = DB::table('participants')
            ->leftJoin('regencies', function ($join) {
                $join->on('participants.id_regency', '=', 'regencies.id');
            })
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('participants.id_district', '=', 'districts.id');
            })
            ->select(
                DB::raw( 'participants.id participant_id'),
                DB::raw( 'regencies.id regency_id'),
                DB::raw( 'regencies.regency_name regency_name'),
                DB::raw( 'categories.id category_id'),
                DB::raw( 'districts.id district_id'),
            );

        $collectionByRegency = DB::table('collections')
            ->joinSub($subParticipants, 'participants', function ($join) {
                $join->on('participants.participant_id', '=', 'collections.id_participant');
            })
            ->where('collect_date', '>=',$request->startDates)
            ->where('collect_date', '<=',$request->endDates)
            ->select(
                DB::raw('ROUND(SUM(quantity),1) qty'),
                DB::raw( 'participants.regency_name regency_name'),
            )
            ->groupBy('regency_name');

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $collectionByRegency = $collectionByRegency->whereIn('participants.category_id', $request->idCategory);
        }

        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $collectionByRegency = $collectionByRegency->whereIn('participants.district_id', $request->idDistrict);
        }

        if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
            $collectionByRegency = $collectionByRegency->whereIn('participants.participant_id', $request->idParticipant);
        }

        if (isset($request->idRegency) && count($request->idRegency) != 0) {
            $collectionByRegency = $collectionByRegency->whereIn('participants.regency_id', $request->idRegency);
        }

        $collectionByRegency = $collectionByRegency->get();

        $totalAllQty = 0;
        foreach ($collectionByRegency as $collection) {
            $totalAllQty += $collection->qty;
        }

        $collectionByAllRegency = [];

        $regencies = DB::table('regencies')
            ->select(
                DB::raw( 'regencies.regency_name regency_name'),
            )->get();

        foreach ($regencies as $regency) {
            $found = false;
            foreach ($collectionByRegency as $collection) {
                if ($collection->regency_name == $regency->regency_name) {
                    $opacity = round(($collection->qty)/$totalAllQty,3);
                    if ($opacity < 0.05) {
                        $opacity = 0.05;
                    }
                    $collectionByAllRegency[$collection->regency_name] = [$collection->qty, $opacity];
                    $found = true;
                    break;
                }
            }
            if ($found == false) {
                $collectionByAllRegency[$regency->regency_name] = [0, 0];
            }

        }

        return response()->json(['data'=>$collectionByAllRegency]);
    }

    public function getLineChartData (Request $request) {

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
                    DB::raw('YEAR(collect_date) year')
                )
                ->groupBy('year','month','week_of_month','monthName');

        } else if ($request->type == 'month') {
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
                    DB::raw('YEAR(collect_date) year')
                )
                ->groupBy('month','monthName','year');

        } else if ($request->type == 'quarter') {
            $collections = DB::table('collections')
                ->leftJoin('participants', function ($join) {
                    $join->on('collections.id_participant', '=', 'participants.id');
                })
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('YEAR(collect_date) year'),
                    DB::raw('QUARTER(collect_date) quarter')
                )
                ->groupBy('year','quarter');

        } else if ($request->type == 'year') {
            $collections = DB::table('collections')
                ->leftJoin('participants', function ($join) {
                    $join->on('collections.id_participant', '=', 'participants.id');
                })
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('YEAR(collect_date) year')
                )
                ->groupBy('year');
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

        if ($request->type == 'week') {
            $data = [];
            foreach ($collections as $collection) {
                $data['label'][] = ['W'.$collection->week_of_month,$collection->monthName,$collection->year];
                $data['qty'][] = $collection->qty;
            }
        } else if ($request->type == 'month') {
            $data = [];
            foreach ($collections as $collection) {
                $data['label'][] = [$collection->monthName,$collection->year];
                $data['qty'][] = $collection->qty;
            }
        } else if ($request->type == 'quarter') {
            $data = [];
            foreach ($collections as $collection) {
                $data['label'][] = ['Q'.$collection->quarter,$collection->year];
                $data['qty'][] = $collection->qty;
            }
        } else if ($request->type == 'year') {
            $data = [];
            foreach ($collections as $collection) {
                $data['label'][] = [$collection->year];
                $data['qty'][] = $collection->qty;
            }
        }

        return response()->json(['data'=>$data]);
    }

    /* End Dinamics */

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
