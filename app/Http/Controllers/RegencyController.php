<?php

namespace App\Http\Controllers;

use App\Imports\RegenciesImport;
use App\Models\Regency;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class RegencyController extends Controller
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
        $regencies = Regency::latest()->get();
        $user = Auth::user();

        if ($request->ajax()) {
            $data = $regencies;
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editRegency">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteRegency">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('regency/index',compact('regencies','user'));
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
        Regency::updateOrCreate(
            ['id' => $request->regency_id],
            [
                'regency_name' => $request->regency_name,
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Regency saved successfully.']);
    }

    public function edit($id)
    {
        $regency = Regency::find($id);
        return response()->json($regency);
    }

    public function destroy($id)
    {
        Regency::find($id)->delete();

        return response()->json(['success'=>'Regency deleted successfully.']);
    }

    public static function importRegency(Request $request)
    {
        if($request->fileImportRegency) {
            $path = ($request->fileImportRegency)->getRealPath();
            Excel::import(new RegenciesImport, $path);
        }

        return response()->json(['success'=>'Import successfully.']);

    }
}
