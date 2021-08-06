<?php

namespace App\Http\Controllers;

use App\Models\PapermillCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class PapermillCategoryController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $papermillCategories = PapermillCategory::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($papermillCategories)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPapermillCategory">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePapermillCategory">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('papermillCategory/index',compact('papermillCategories','user'));
    }

    public function store(Request $request)
    {
        PapermillCategory::updateOrCreate(
            ['id' => $request->papermill_category_id],
            [
                'papermill_category_name' => $request->papermill_category_name,
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Papermill Category saved successfully.']);
    }

    public function edit($id)
    {
        $papermillCategory = PapermillCategory::find($id);
        return response()->json($papermillCategory);
    }

    public function destroy($id)
    {
        PapermillCategory::find($id)->delete();

        return response()->json(['success'=>'Papermill Category deleted successfully.']);
    }
}
