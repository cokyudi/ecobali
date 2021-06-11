<?php

namespace App\Http\Controllers;

use App\Models\District;
use Illuminate\Http\Request;
use DataTables;

class DistrictController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $districts = District::latest()->get();
        
        if ($request->ajax()) {
            $data = District::latest()->get();
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
        return view('district/index',compact('districts'));
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        District::updateOrCreate(
            ['id' => $request->district_id],
            [
                'district_name' => $request->district_name, 
                'province_name' => $request->province_name,
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
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = District::find($id);
        return response()->json($district);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        District::find($id)->delete();
     
        return response()->json(['success'=>'District deleted successfully.']);
    }
}
