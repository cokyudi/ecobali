<?php

namespace App\Http\Controllers;

use App\Models\BoxResource;
use Illuminate\Http\Request;
use DataTables;

class BoxResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $boxResources = BoxResource::latest()->get();
        
        if ($request->ajax()) {
            $data = BoxResource::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBoxResource">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBoxResource">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('boxResource/index',compact('boxResources'));
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
        BoxResource::updateOrCreate(
            ['id' => $request->boxResource_id],
            [
                'resource_name' => $request->resource_name, 
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );        
   
        return response()->json(['success'=>'Box Resource saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BoxResource  $boxResource
     * @return \Illuminate\Http\Response
     */
    public function show(BoxResource $boxResource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BoxResource  $boxResource
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = BoxResource::find($id);
        return response()->json($area);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BoxResource  $boxResource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BoxResource $boxResource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BoxResource  $boxResource
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BoxResource::find($id)->delete();
     
        return response()->json(['success'=>'Box Resource deleted successfully.']);
    }
}
