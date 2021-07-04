<?php

namespace App\Http\Controllers;

use App\Models\TransportIntensity;
use Illuminate\Http\Request;
use DataTables;

class TransportIntensityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $transportIntensities = TransportIntensity::latest()->get();
        
        if ($request->ajax()) {
            $data = TransportIntensity::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editTransportIntensity">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteTransportIntensity">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('transportIntensity/index',compact('transportIntensities'));
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
        TransportIntensity::updateOrCreate(
            ['id' => $request->transportIntensity_id],
            [
                'intensity' => $request->intensity, 
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );        
   
        return response()->json(['success'=>'Transport Intensity saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransportIntensity  $transportIntensity
     * @return \Illuminate\Http\Response
     */
    public function show(TransportIntensity $transportIntensity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TransportIntensity  $transportIntensity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $transportIntensity = TransportIntensity::find($id);
        return response()->json($transportIntensity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransportIntensity  $transportIntensity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransportIntensity $transportIntensity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransportIntensity  $transportIntensity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TransportIntensity::find($id)->delete();
     
        return response()->json(['success'=>'Transport Intensity deleted successfully.']);
    }
}
