<?php

namespace App\Http\Controllers;

use App\Export\ActivityExport;
use App\Imports\ActivitiesImport;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ActivityController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $activity_programs = DB::table('activity_programs')->orderBy('activity_program_name','ASC')->get();
        $categories = DB::table('categories')->orderBy('category_name','ASC')->get();
        $districts = DB::table('districts')->orderBy('district_name','ASC')->get();
        $regencies = DB::table('regencies')->orderBy('regency_name','ASC')->get();
        $programs = DB::table('activity_programs')->orderBy('activity_program_name', 'ASC')->get();

        $activities = DB::table('activities')
            ->leftJoin('activity_programs', function ($join) {
                $join->on('activities.id_program_activity', '=', 'activity_programs.id');
            })
            ->leftJoin('categories', function ($join) {
                $join->on('activities.id_category', '=', 'categories.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('activities.id_district', '=', 'districts.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('activities.id_regency', '=', 'regencies.id');
            })
            ->select(
                'activities.id',
                DB::raw('DATE_FORMAT(activities.activity_date, "%d/%m/%Y") activity_date'),
                'activity_programs.activity_program_name',
                'activities.activity',
                'activities.location',
                'activities.participant_number',
            );


        if(!empty($request->get('param'))) {

            $data = $activities;

            if (isset($request->get('param')["idCategory"]) && count($request->get('param')["idCategory"]) != 0) {
                $data = $data->whereIn('activities.id_category', $request->get('param')["idCategory"]);
            }

            if (isset($request->get('param')["idProgram"]) && count($request->get('param')["idProgram"]) != 0) {
                $data = $data->whereIn('activities.id_program_activity', $request->get('param')["idProgram"]);
            }

            if (isset($request->get('param')["idDistrict"]) && count($request->get('param')["idDistrict"]) != 0) {
                $data = $data->whereIn('activities.id_district', $request->get('param')["idDistrict"]);
            }

            if (isset($request->get('param')["idRegency"]) && count($request->get('param')["idRegency"]) != 0) {
                $data = $data->whereIn('activities.id_regency', $request->get('param')["idRegency"]);
            }

            if (isset($request->get('param')["startDates"]) && isset($request->get('param')["endDates"])) {
                $data = $data->whereBetween('activities.activity_date', [$request->get('param')["startDates"],$request->get('param')["endDates"]]);
            }

            $datas = $data->get();



            return Datatables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editActivity">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteActivity">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if ($request->ajax()) {
            $data = $activities->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editActivity">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteActivity">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('activity/index',compact('activities', 'user','activity_programs','categories','districts','regencies','programs'));

    }
    public function store(Request $request)
    {

        $data = Activity::updateOrCreate(
            ['id' => $request->activity_id],
            [
                'id_program_activity' => $request->id_program_activity,
                'activity' => $request->activity,
                'activity_date' => $request->activity_date,
                'location' => $request->location,
                'id_category' => $request->id_category,
                'id_district' => $request->id_district,
                'id_regency' => $request->id_regency,
                'participant_number' => $request->participant_number,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Activity saved successfully.','data'=>$data]);
    }

    public function edit($id)
    {
        $activity = Activity::find($id);
        return response()->json($activity);
    }

    public function destroy($id)
    {
        Activity::find($id)->delete();

        return response()->json(['success'=>'Activity deleted successfully.']);
    }

    public static function importActivity(Request $request)
    {
        if($request->fileImportActivity) {
            $path = ($request->fileImportActivity)->getRealPath();
            Excel::import(new ActivitiesImport, $path);
        }

        return response()->json(['success'=>'Import successfully.']);
    }

    function downloadActivities(Request $request)
    {
        return Excel::download(new ActivityExport($request), 'activities.xlsx');
    }
}
