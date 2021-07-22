<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $categories = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id')
                    ->where('category_details.year', '=', (new DateTime)->format("Y"));
            })
            ->select(
                'categories.*',
                DB::raw('NVL((CASE WHEN MONTH(NOW()) < 7 THEN category_details.semester_1_target ELSE  category_details.semester_1_target END), "Not Set") AS target'))
            ->get();

        if ($request->ajax()) {
            return Datatables::of($categories)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('category/index', compact('categories','user'));
    }

    function getSemester() {
        if (((new DateTime)->format("m")) > 6) {
            return "S2";
        } else {
            return "S1";
        }
    }

    public function store(Request $request)
    {
        $data = Category::updateOrCreate(
            ['id' => $request->category_id],
            [
                'category_name' => $request->category_name,
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        if($data->wasRecentlyCreated) {
            if (((new DateTime)->format("m")) > 6) {
                $semester1Target = null;
                $semester2Target = $request->this_year_target;
            } else {
                $semester1Target = $request->this_year_target;
                $semester2Target = null;
            }

            CategoryDetail::updateOrCreate(
                [
                    'category_id' => $data->id,
                    'year' => (new DateTime)->format("Y"),
                    'semester_1_target' => $semester1Target,
                    'semester_2_target' => $semester2Target,
                    'created_by' => $request->created_by,
                    'created_datetime' => $request->created_datetime,
                    'last_modified_by' => $request->last_modified_by,
                    'last_modified_datetime' => $request->last_modified_datetime,
                ]
            );
        }

        return response()->json(['success'=>'Category saved successfully.']);
    }

    public function edit($id)
    {
        $user = Auth::user();
        $category = Category::find($id);
        return view('category/edit', compact('category','user'));
    }

    public function destroy($id)
    {
        Category::find($id)->delete();

        return response()->json(['success'=>'Category deleted successfully.']);
    }
}
