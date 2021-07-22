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
            'year'                  => 'required',
        ];

        $messages = [
            'year.required'             => 'Year is required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            return response()->json(['error'=>'Failed to add target.', 'errors'=>$validator->errors()]);
        }

        $categoryDetails = CategoryDetail::where('year', '=', $request->year)->where('category_id', '=', $request->category_id_target)->first();
        if ($categoryDetails != null) {
            $userId = $categoryDetails->id;
        } else {
            $userId = $request->category_detail_id;
        }

        CategoryDetail::updateOrCreate(
            ['id' => $userId],
            [
                'category_id' => $request->category_id_target,
                'year' => $request->year,
                'semester_1_target' => $request->semester_1_target,
                'semester_2_target' => $request->semester_2_target,
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
