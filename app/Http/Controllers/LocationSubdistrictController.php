<?php

namespace App\Http\Controllers;

use App\Imports\DistrictsImport;
use App\Imports\SubDistrictsImport;
use App\Models\LocationSubdistrict;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class LocationSubdistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $subdistricts = LocationSubdistrict::latest()->get();

        if ($request->ajax()) {
            $data = LocationSubdistrict::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editSubdistrict">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSubdistrict">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('subdistrict/index',compact('subdistricts'));
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
        LocationSubdistrict::updateOrCreate(
            ['id' => $request->subdistrict_id],
            [
                'subdistrict_name' => $request->subdistrict_name,
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Sub-District saved successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationSubdistrict  $locationSubdistrict
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subdistrict = LocationSubdistrict::find($id);
        return response()->json($subdistrict);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationSubdistrict  $locationSubdistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LocationSubdistrict::find($id)->delete();

        return response()->json(['success'=>'Sub-District deleted successfully.']);
    }

    public static function importSubDistrict(Request $request)
    {
        if($request->fileImportSubDistrict) {
            $path = ($request->fileImportSubDistrict)->getRealPath();
            Excel::import(new SubDistrictsImport, $path);
        }

        return response()->json(['success'=>'Import successfully.']);

    }
}
