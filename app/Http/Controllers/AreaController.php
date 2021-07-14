<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Imports\AreasImport;
use Illuminate\Http\Request;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

use DateTime;

class AreaController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::latest()->get();

        if ($request->ajax()) {
            $data = Area::latest()->get();
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

    public function store(Request $request)
    {
        Area::updateOrCreate(
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

    public function edit($id)
    {
        $area = Area::find($id);
        return response()->json($area);
    }

    public function destroy($id)
    {
        Area::find($id)->delete();

        return response()->json(['success'=>'Area deleted successfully.']);
    }

    public static function importArea(Request $request)
    {
        if($request->fileImportArea) {
            $path = ($request->fileImportArea)->getRealPath();
            Excel::import(new AreasImport, $path);
        }

        return response()->json(['success'=>'Import successfully.']);

    }
}
