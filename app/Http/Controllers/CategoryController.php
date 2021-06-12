<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    
    public function index(Request $request)
    {
        $categories = Category::latest()->get();
        
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCategory">Edit</a>';
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCategory">Delete</a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('category/index',compact('categories'));
    }
     
   
    public function store(Request $request)
    {
        Category::updateOrCreate(
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
   
        return response()->json(['success'=>'Category saved successfully.']);
    }
    
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
  
    public function destroy($id)
    {
        Category::find($id)->delete();
     
        return response()->json(['success'=>'Category deleted successfully.']);
    }
}
