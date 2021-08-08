<?php

namespace App\Http\Controllers;

use App\Imports\AreasImport;
use App\Models\ActivityProgram;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class ActivityProgramController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $activityPrograms = ActivityProgram::latest()->get();

        if ($request->ajax()) {
            $data = $activityPrograms;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editActivityProgram">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteActivityProgram">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('activityProgram/index',compact('activityPrograms','user'));
    }

    public function store(Request $request)
    {
        ActivityProgram::updateOrCreate(
            ['id' => $request->activity_program_id],
            [
                'activity_program_name' => $request->activity_program_name,
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Activity Program saved successfully.']);
    }

    public function edit($id)
    {
        $activityProgram = ActivityProgram::find($id);
        return response()->json($activityProgram);
    }

    public function destroy($id)
    {
        ActivityProgram::find($id)->delete();

        return response()->json(['success'=>'Activity Program deleted successfully.']);
    }

}
