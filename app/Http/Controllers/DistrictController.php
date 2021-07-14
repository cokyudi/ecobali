<?php

namespace App\Http\Controllers;

use App\Imports\RegenciesImport;
use App\Imports\DistrictsImport;
use App\Models\District;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;


class DistrictController extends Controller
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

    public function store(Request $request)
    {
        District::updateOrCreate(
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

    public function edit($id)
    {
        $district = District::find($id);
        return response()->json($district);
    }

    public function destroy($id)
    {
        District::find($id)->delete();

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
