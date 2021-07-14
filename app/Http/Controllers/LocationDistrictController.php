<?php

namespace App\Http\Controllers;

use App\Imports\DistrictsImport;
use App\Models\LocationDistrict;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class LocationDistrictController extends Controller
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

        $districts = LocationDistrict::latest()->get();

        if ($request->ajax()) {
            $data = LocationDistrict::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editDistrict">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteDistrict">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('district/index',compact('districts','user'));
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
        LocationDistrict::updateOrCreate(
            ['id' => $request->district_id],
            [
                'district_name' => $request->district_name,
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'District saved successfully.']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationDistrict  $locationDistrict
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = LocationDistrict::find($id);
        return response()->json($district);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LocationDistrict  $locationDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LocationDistrict $locationDistrict)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationDistrict  $locationDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LocationDistrict::find($id)->delete();

        return response()->json(['success'=>'District deleted successfully.']);
    }

    public static function importDistrict(Request $request)
    {
        if($request->fileImportDistrict) {
            $path = ($request->fileImportDistrict)->getRealPath();
            Excel::import(new DistrictsImport, $path);
        }

        return response()->json(['success'=>'Import successfully.']);

    }
}
