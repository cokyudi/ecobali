<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use DateTime;

class CategoryController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id')
                    ->where('category_details.year', '=', (new DateTime)->format("Y"));
            })
            ->select(
                'categories.*',
                DB::raw('(CASE WHEN category_details.target IS NULL THEN "not set" ELSE category_details.target END) AS target'))
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

        return view('category/index', compact('categories'));
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
            CategoryDetail::updateOrCreate(
                [
                    'category_id' => $data->id,
                    'target' => $request->this_year_target, 
                    'year' => (new DateTime)->format("Y"),
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
        $category = Category::find($id);
        return view('category/edit')->with('category', $category);
    }
  
    public function destroy($id)
    {
        Category::find($id)->delete();
     
        return response()->json(['success'=>'Category deleted successfully.']);
    }
}
