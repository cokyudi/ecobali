<?php

namespace App\Http\Controllers;

use App\Models\CategoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;


class CategoryDetailController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $semester = $request->semester;

        $rules = [
            'year'         => [
                'required',
                Rule::unique('category_details', 'year')->where(function ($query) use ($semester) {
                    return $query->where('semester', $semester);
                })
            ],
            'semester'              => 'required',
            'target'                => 'required'
        ];

        $messages = [
            'year.required'             => 'Year is required',
            'year.unique'               => 'Combination between Year and Semester already exist',
            'semester.required'         => 'Semester is required',
            'target.required'           => 'Target is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error'=>'Failed to add target.', 'errors'=>$validator->errors()]);
        }

        CategoryDetail::updateOrCreate(
            ['id' => $request->category_detail_id],
            [
                'category_id' => $request->category_id_target,
                'target' => $request->target,
                'year' => $request->year,
                'semester' => $request->semester,
                'created_by' => $request->created_by_target,
                'created_datetime' => $request->created_datetime_target,
                'last_modified_by' => $request->last_modified_by_target,
                'last_modified_datetime' => $request->last_modified_datetime_target,
            ]
        );
        return response()->json(['success'=>'Target saved successfully.']);
    }

    public function show($id)
    {
        $categoryDetails = DB::table('category_details')->where('category_id', $id)->get();

        return Datatables::of($categoryDetails)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategoryDetail">Edit</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategoryDetail">Delete</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);

    }

    public function edit($id)
    {
        $categoryDetail = CategoryDetail::find($id);
        return response()->json($categoryDetail);
    }


    public function update(Request $request, CategoryDetail $categoryDetail)
    {
        //
    }

    public function destroy($id)
    {
        CategoryDetail::find($id)->delete();

        return response()->json(['success'=>'Target deleted successfully.']);
    }
}
