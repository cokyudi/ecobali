<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use App\Models\Collection;
use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Models\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Log;

class ParticipantListController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $areas = Area::orderBy('area_name','asc')->get();
        $regencies = Regency::orderBy('regency_name','asc')->get();
        $districts = District::orderBy('district_name','asc')->get();
        $categories = Category::orderBy('category_name','asc')->get();
        $participantList = DB::table('participants')->orderBy('participant_name', 'asc')->get();

        $participants = DB::table('participants')
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('areas', function ($join) {
                $join->on('participants.id_area', '=', 'areas.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('participants.id_district', '=', 'districts.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('participants.id_regency', '=', 'regencies.id');
            })
            ->leftJoin('collections', function ($join) {
                $join->on('participants.id', '=', 'collections.id_participant');
            })
            ->select(
                'participants.id',
                'participants.participant_name',
                DB::raw('DATE_FORMAT(participants.joined_date, "%d/%m/%Y") joined_date'),
                'categories.category_name',
                'regencies.regency_name',
                DB::raw('ROUND(SUM(collections.quantity),1) qty'),
                DB::raw('ROUND(AVG(collections.quantity),1) avg'),
                DB::raw('DATE_FORMAT(MAX(collect_date), "%d/%m/%Y") lastSubmit'),
                DB::raw('CASE WHEN MAX(collect_date) >= CURDATE() - INTERVAL 3 MONTH THEN "ACTIVE" ELSE "INACTIVE" END status'),
            )
            ->groupBy('id','participant_name','joined_date','category_name','regency_name')
            ->orderBy('participant_name','ASC');

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $participants = $participants->whereIn('categories.id', $request->idCategory);
        }

        if (isset($request->idArea) && count($request->idArea) != 0) {
            $participants = $participants->whereIn('areas.id', $request->idArea);
        }

        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $participants = $participants->whereIn('districts.id', $request->idDistrict);
        }

        if (isset($request->idRegency) && count($request->idRegency) != 0) {
            $participants = $participants->whereIn('regencies.id', $request->idRegency);
        }

        if (isset($request->idStatus) && $request->idStatus > 0) {
            if($request->idStatus == 1) {
                $participants = $participants->having('status', '=',"ACTIVE");
            } else {
                $participants = $participants->having('status', '=','INACTIVE');
            }
        }

        if($request->startDates == '2021-01-01' && $request->endDates == date("Y-m-d")) {

        } else {
            $participants = $participants->whereBetween('collections.collect_date', [$request->startDates,$request->endDates]);
        }

//        if (isset($request->startDates) && isset($request->endDates) != 0) {
//            $participants = $participants->whereBetween('collections.collect_date', [$request->startDates,$request->endDates]);
//        }

        //------------------------------------------------------

        $potentialMap = [];
        $date1 =$request->startDates;
        $date2 = $request->endDates;

        $monthlyCollections = DB::table('collections')
            ->whereBetween('collections.collect_date', [$request->startDates, $request->endDates])
            ->select(
                "collections.id_participant",
                DB::raw('COUNT(DISTINCT (MONTH(collect_date))) month_count'),
            )
            ->groupBy('id_participant')
            ->orderByRaw("CONVERT(id_participant, SIGNED) asc")
//            ->orderBy('id_participant','ASC')
            ->get();

        $continuityData = DB::table('collections')
            ->leftJoin('participants', function ($join) {
                $join->on('participants.id', '=', 'collections.id_participant');
            })
            ->select(
                'participants.id as cont_par_id',
                DB::raw("((COUNT(DISTINCT (MONTH(collections.collect_date)))) / (TIMESTAMPDIFF(MONTH, '$request->startDates', '$request->endDates') +1))*100 as persen"),
            )
//            ->whereBetween('collections.collect_date', [$request->startDates, $request->endDates])
            ->groupBy('cont_par_id');

        $continuity = DB::table('participants')
            ->leftJoinSub($continuityData, 'continuityData', function ($join) {
                $join->on('participants.id', '=', 'continuityData.cont_par_id');
            })
            ->select(
                DB::raw("participants.id as continuity_par_id"),
//                "participants.id as continuity_par_id",
                DB::raw("CASE WHEN continuityData.persen <= 0 THEN 'NONE' WHEN continuityData.persen > 0 AND continuityData.persen <= 50 THEN 'LESS_STABLE' WHEN continuityData.persen > 50 AND continuityData.persen < 100 THEN 'MEDIUM' WHEN continuityData.persen = 100 THEN 'STABLE' ELSE 'NO_DATA' END as continuity_ind"),
            )->get();



        //------------------------------------------------------


        $participants = $participants->get();

        if ($request->ajax()) {
            return Datatables::of($participants)
                ->addIndexColumn()
                ->addColumn('participant_name_link', function($row){
                    $participant_name_link = '<a href="/participants/'.$row->id.'/edit">'.$row->participant_name.'</a>';
                    return $participant_name_link;
                })
                ->addColumn('status', function($row){
                    if($row->status == "INACTIVE") {
                        $btn = '<i class="la la-times icon-bg-circle bg-danger"></i>';
                    } else {
                        $btn = '<i class="la la-check icon-bg-circle bg-success"></i>';
                    }
                    return $btn;
                })
                ->rawColumns(['participant_name_link','status'])
                ->make(true);
        }
        return view('participantList/index',compact('participants', 'user','areas','regencies','districts','categories','participantList'));
    }


}
