<?php

namespace App\Http\Controllers;

use App\Models\ActivityProgram;
use App\Models\Category;
use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Models\DashboardComparison;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class DashboardActivitiesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $categories = Category::latest()->get();
        $regencies = Regency::latest()->get();
        $districts = District::latest()->get();
        $programs = ActivityProgram::latest()->get();

        return view('dashboardActivities/index',compact('user','categories','regencies','districts','programs'));
    }

    public function getActivities (Request $request) {

        $activitiesGeneral = DB::table('activities')
            ->select(
                DB::raw('COUNT(DISTINCT id_regency) regency_coverage'),
                DB::raw('COUNT(DISTINCT id_district) district_coverage'),
                DB::raw('COUNT(DISTINCT location) location_coverage'),
                DB::raw('SUM(participant_number) participant_number'),
            );

        $numberOfParticipant = DB::table('activities')
            ->leftJoin('activity_programs', function ($join) {
                $join->on('activities.id_program_activity', '=', 'activity_programs.id');
            })
            ->select(
                DB::raw('SUM(participant_number) participant_number'),
                DB::raw('activity_program_name'),
            )
            ->groupBy('activity_program_name');

        $numberOfLocation = DB::table('activities')
            ->leftJoin('categories', function ($join) {
                $join->on('activities.id_category', '=', 'categories.id');
            })
            ->select(
                DB::raw('COUNT(location) location'),
                DB::raw('category_name'),
            )
            ->groupBy('category_name');

        $mapData = DB::table('activities')
            ->leftJoin('regencies', function ($join) {
                $join->on('activities.id_regency', '=', 'regencies.id');
            })
            ->select(
                DB::raw('SUM(participant_number) participant_number'),
                DB::raw('regency_name'),
            )
            ->groupBy('regency_name');

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $activitiesGeneral = $activitiesGeneral->whereIn('id_category', $request->idCategory);
            $numberOfParticipant = $numberOfParticipant->whereIn('id_category', $request->idCategory);
            $numberOfLocation = $numberOfLocation->whereIn('id_category', $request->idCategory);
            $mapData = $mapData->whereIn('id_category', $request->idCategory);
        }

        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $activitiesGeneral = $activitiesGeneral->whereIn('id_district', $request->idDistrict);
            $numberOfParticipant = $numberOfParticipant->whereIn('id_district', $request->idDistrict);
            $numberOfLocation = $numberOfLocation->whereIn('id_district', $request->idDistrict);
            $mapData = $mapData->whereIn('id_district', $request->idDistrict);
        }

        if (isset($request->idProgram) && count($request->idProgram) != 0) {
            $activitiesGeneral = $activitiesGeneral->whereIn('id_program_activity', $request->idProgram);
            $numberOfParticipant = $numberOfParticipant->whereIn('id_program_activity', $request->idProgram);
            $numberOfLocation = $numberOfLocation->whereIn('id_program_activity', $request->idProgram);
            $mapData = $mapData->whereIn('id_program_activity', $request->idProgram);
        }

        if (isset($request->idRegency) && count($request->idRegency) != 0) {
            $activitiesGeneral = $activitiesGeneral->whereIn('id_regency', $request->idRegency);
            $numberOfParticipant = $numberOfParticipant->whereIn('id_regency', $request->idRegency);
            $numberOfLocation = $numberOfLocation->whereIn('id_regency', $request->idRegency);
            $mapData = $mapData->whereIn('id_regency', $request->idRegency);
        }

        $activitiesGeneral = $activitiesGeneral->first();
        $numberOfParticipant = $numberOfParticipant->get();
        $numberOfLocation = $numberOfLocation->get();
        $mapData = $mapData->get();

        $totalAllParticipant = $activitiesGeneral->participant_number;


        $locations = [
            ["Category", "Location", ["role"=>"style"]]
        ];

        $listColor = array("#99B898", "#FECEA8", "#FF847C", "#E84A5F", "#474747","#2494be","F6B75A","#c6ebc9","#70af85","#f0e2d0","#aa8976","#125d98");

        foreach ($numberOfLocation as $location) {
            array_push($locations, [$location->category_name, $location->location, $listColor[array_rand($listColor)]]);
        }

        if (sizeof($locations) === 1) {
            array_push($locations, ['', 0, null]);
        }

        $activityByRegency = [];
        $regencies = DB::table('regencies')
            ->select(
                DB::raw( 'regencies.regency_name regency_name'),
            )->get();

        foreach ($regencies as $regency) {
            $found = false;
            foreach ($mapData as $dataMap) {
                if ($dataMap->regency_name == $regency->regency_name) {
                    $opacity = round(($dataMap->participant_number)/$totalAllParticipant,3);
                    if ($opacity < 0.05) {
                        $opacity = 0.05;
                    }
                    $activityByRegency[$dataMap->regency_name] = [$dataMap->participant_number, $opacity];
                    $found = true;
                    break;
                }
            }
            if ($found == false) {
                $activityByRegency[$regency->regency_name] = [0, 0];
            }
        }

        $numberOfParticipantBar = [
            ["Program", "Number of Participant"],
        ];

        foreach ($numberOfParticipant as $numOfParticipant) {
            array_push($numberOfParticipantBar, [$numOfParticipant->activity_program_name, round($numOfParticipant->participant_number,0)]);
        }

        if(sizeof($numberOfParticipantBar) === 1) {
            array_push($numberOfParticipantBar, ["", 0]);
        }




        $data = [
            'districtsCoverage' => $activitiesGeneral->district_coverage,
            'regenciesCoverage' =>$activitiesGeneral->regency_coverage,
            'totalParticipants'=> $totalAllParticipant,
            'totalLocation' => $activitiesGeneral->location_coverage,
            'activityByRegency' => $activityByRegency,
            'numberOfParticipantBar' => $numberOfParticipantBar,
            'locations' => $locations
        ];

        return response()->json(['data'=>$data]);

    }
}
