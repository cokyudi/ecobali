<?php

namespace App\Http\Controllers;

use App\Models\LocationArea;
use Illuminate\Http\Request;
use DataTables;

class LocationAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areas = LocationArea::latest()->get();
        
        if ($request->ajax()) {
            $data = LocationArea::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editArea">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteArea">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('area/index',compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        LocationArea::updateOrCreate(
            ['id' => $request->area_id],
            [
                'area_name' => $request->area_name, 
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );        
   
        return response()->json(['success'=>'Area saved successfully.']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LocationArea  $locationArea
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = LocationArea::find($id);
        return response()->json($area);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LocationArea  $locationArea
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        LocationArea::find($id)->delete();
     
        return response()->json(['success'=>'Area deleted successfully.']);
    }
}
