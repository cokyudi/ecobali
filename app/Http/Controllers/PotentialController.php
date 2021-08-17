<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Potential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Log;

class PotentialController extends Controller
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

        $potentials = DB::table('potentials')
            ->leftJoin('categories', function ($join) {
                $join->on('potentials.id_category', '=', 'categories.id');
            })
            ->select(
                'potentials.id',
                'categories.category_name',
                'potential_low',
                'potential_medium',
                'potential_high'
            )
            ->get();

        $categories = Category::latest()->get();

        if ($request->ajax()) {
            return Datatables::of($potentials)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPotential">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePotential">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('potential/index',compact('potentials','user','categories'));
    }

    public function store(Request $request)
    {
        Potential::updateOrCreate(
            ['id' => $request->potential_id],
            [
                'id_category' => $request->id_category,
                'potential_low' => $request->potential_low,
                'potential_medium' => $request->potential_medium,
                'potential_high' => $request->potential_high,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Potential saved successfully.']);
    }

    public function edit($id)
    {
        $potential = Potential::find($id);
        return response()->json($potential);
    }

    public function destroy($id)
    {
        Potential::find($id)->delete();

        return response()->json(['success'=>'Potential deleted successfully.']);
    }

}
