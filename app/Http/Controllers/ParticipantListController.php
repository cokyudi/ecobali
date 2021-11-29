<?php

namespace App\Http\Controllers;

use App\Export\ParticipantListExport;
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
use Maatwebsite\Excel\Facades\Excel;

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

        $potentialTable = DB::table('participants')
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('potentials', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->select(
                DB::raw("participants.id potential_par_id"),
                DB::raw("potentials.potential_low potential_low"),
                DB::raw("potentials.potential_medium potential_medium"),
                DB::raw("potentials.potential_high potential_high"),
            );


        $dataPengangkutan = DB::table('participants')
            ->leftJoin('collections', function ($join) {
                $join->on('participants.id', '=', 'collections.id_participant');
            })
            ->leftJoinSub($potentialTable, 'potential', function ($join) {
                $join->on('participants.id', '=', 'potential.potential_par_id');
            })
            ->select(
                'participants.id as pengangkutan_par_id',
                DB::raw("COUNT(DISTINCT(MONTH(collections.collect_date))) jumlah_pengangkutan"),
                DB::raw("NVL(sum(collections.quantity) / (TIMESTAMPDIFF(MONTH, '$request->startDates', '$request->endDates') +1),0) as rata_rata"),
                DB::raw("potential.potential_low potential_low"),
                DB::raw("potential.potential_medium potential_medium"),
                DB::raw("potential.potential_high potential_high"),
            )
            ->groupBy('pengangkutan_par_id');

        $collection_continuity = DB::table('collections')
            ->whereBetween('collections.collect_date', [$request->startDates, $request->endDates])
            ->select(
                "collections.id_participant",
                DB::raw('COUNT(DISTINCT (MONTH(collect_date))) month_count'),
            )
            ->groupBy('id_participant')
            ->orderByRaw("CONVERT(id_participant, SIGNED) asc");


        $continuity = DB::table('participants')
            ->leftJoinSub($collection_continuity, 'con', function ($join) {
                $join->on('participants.id', '=', 'con.id_participant');
            })
            ->select(
                "participants.id as participant_id_continuity",
                DB::raw("NVL((con.month_count / (TIMESTAMPDIFF(MONTH, '$request->startDates', '$request->endDates') +1))*100,0) as persen")
            )
            ->orderBy("participant_id_continuity","ASC");

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
            ->leftJoinSub($continuity, 'continuity', function ($join) {
                $join->on('participants.id', '=', 'continuity.participant_id_continuity');
            })
            ->leftJoinSub($dataPengangkutan, 'pengangkutan', function ($join) {
                $join->on('participants.id', '=', 'pengangkutan.pengangkutan_par_id');
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
                DB::raw("CASE WHEN continuity.persen <= 0 THEN 'NONE' WHEN continuity.persen > 0 AND continuity.persen <= 50 THEN 'LESS_STABLE' WHEN continuity.persen > 50 AND continuity.persen < 100 THEN 'MEDIUM' WHEN continuity.persen = 100 THEN 'STABLE' ELSE 'NO_DATA' END as continuity_ind"),
                DB::raw("CASE WHEN rata_rata <= potential_low THEN 'LOW' WHEN rata_rata > potential_low AND rata_rata <= potential_high THEN 'MEDIUM' WHEN rata_rata > potential_high THEN 'HIGH' ELSE 'NOT_SET' END as potential_ind"),
            )
            ->groupBy('id','participant_name','joined_date','category_name','regency_name','rata_rata','potential_low','potential_high')
            ->orderBy('participant_name','ASC');

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $participants = $participants->whereIn('categories.id', $request->idCategory);
        }

        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $participants = $participants->whereIn('districts.id', $request->idDistrict);
        }

        if (isset($request->idParticipant) && count($request->idParticipant) != 0) {
            $participants = $participants->whereIn('participants.id', $request->idParticipant);
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

        if (isset($request->idContinuity) && $request->idContinuity > 0) {
            if($request->idContinuity == 1) {
                $participants = $participants->having('continuity_ind', '=',"NONE");
            } else if ($request->idContinuity == 2){
                $participants = $participants->having('continuity_ind', '=','LESS_STABLE');
            } else if ($request->idContinuity == 3){
                $participants = $participants->having('continuity_ind', '=','MEDIUM');
            } else if ($request->idContinuity == 4){
                $participants = $participants->having('continuity_ind', '=','STABLE');
            }
        }

        if (isset($request->idPotential) && $request->idPotential > 0) {
            if($request->idPotential == 1) {
                $participants = $participants->having('potential_ind', '=',"LOW");
            } else if ($request->idPotential == 2){
                $participants = $participants->having('potential_ind', '=','MEDIUM');
            } else if ($request->idPotential == 3) {
                $participants = $participants->having('potential_ind', '=', 'HIGH');
            }
        }

        if($request->startDates == '2021-01-01' && $request->endDates == date("Y-m-d")) {

        } else {
            $participants = $participants->whereBetween('collections.collect_date', [$request->startDates,$request->endDates]);
        }

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
                ->addColumn('potential_ind', function($row){
                    if($row->potential_ind == "LOW") {
                        $potential = '<button type="button" class="btn btn-sm btn-danger round" style="width: 55px">Low</button>';
                    } else if($row->potential_ind == "MEDIUM"){
                        $potential = '<button type="button" class="btn btn-sm btn-warning round" style="width: 75px">Medium</button>';
                    } else if($row->potential_ind == "HIGH"){
                        $potential = '<button type="button" class="btn btn-sm btn-success round" style="width: 55px">High</button>';
                    } else {
                        $potential = '-';
                    }
                    return $potential;
                })
                ->addColumn('continuity_ind', function($row){
                    if($row->continuity_ind == "NONE") {
                        $continuity = '<button type="button" class="btn btn-sm btn-danger round " style="width: 60px">None</button>';
                    } else if($row->continuity_ind == "LESS_STABLE"){
                        $continuity = '<button type="button" class="btn btn-sm btn-warning round " style="width: 95px">Less Stable</button>';
                    } else if($row->continuity_ind == "MEDIUM"){
                        $continuity = '<button type="button" class="btn btn-sm btn-info round " style="width: 75px">Medium</button>';
                    } else if($row->continuity_ind == "STABLE"){
                        $continuity = '<button type="button" class="btn btn-sm btn-success round " style="width: 75px">Stable</button>';
                    } else {
                        $continuity = '-';
                    }
                    return $continuity;
                })
                ->rawColumns(['participant_name_link','status','potential_ind','continuity_ind'])
                ->make(true);
        }
        return view('participantList/index',compact('participants', 'user','areas','regencies','districts','categories','participantList'));
    }

    function downloadParticipantList(Request $request)
    {
        return Excel::download(new ParticipantListExport($request), 'participantList.xlsx');
    }


}
