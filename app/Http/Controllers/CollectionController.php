<?php

namespace App\Http\Controllers;

use App\Export\CollectionExport;
use App\Models\Collection;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use DateTime;
use App\Imports\CollectionsImport;

class CollectionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $participants = DB::table('participants')
            ->select(
                'participants.id',
                'participants.participant_name',
            )
            ->get();


        $categories = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id')
                    ->where('category_details.year', '=', (new DateTime)->format("Y"));
            })
            ->select(
                'categories.*',
                );

        $subParticipants = DB::table('participants')
            ->joinSub($categories, 'categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('participants.id_regency', '=', 'regencies.id');
            })
            ->select(
                'participants.id as participant_id',
                'participants.participant_name as participant_name',
                'categories.category_name as category_name',
                'regencies.id as regency_id',
                'regencies.regency_name as regency_name',
            );


        $collections = DB::table('collections')
            ->joinSub($subParticipants, 'participants', function ($join) {
                $join->on('collections.id_participant', '=', 'participants.participant_id');
            })
            ->select(
                'collections.id',
                'collections.id_participant',
                'collections.quantity',
                'collections.collect_date',
                'participants.participant_name',
                'participants.category_name',
                'participants.regency_name',
            )
            ->orderBy('collect_date','DESC')
            ->get();

        if ($request->ajax()) {
            $data = $collections;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCollection">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCollection">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('collection/index',compact('collections','user','participants'));
    }

    public function store(Request $request)
    {
        Collection::updateOrCreate(
            ['id' => $request->collection_id],
            [
                'id_participant' => $request->participant_id,
                'quantity' => $request->quantity,
                'collect_date' => $request->collect_date,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Collection saved successfully.']);
    }

    public function edit($id)
    {
        $collection = Collection::find($id);
        return response()->json($collection);
    }



    public function destroy($id)
    {
        Collection::find($id)->delete();

        return response()->json(['success'=>'Collection deleted successfully.']);
    }

    public static function importCollection(Request $request)
    {
        if($request->fileImportCollection) {
            $path = ($request->fileImportCollection)->getRealPath();
            Excel::import(new CollectionsImport, $path);
        }

        return response()->json(['success'=>'Import successfully.']);

    }

    function downloadCollections()
    {
        return Excel::download(new CollectionExport, 'collections.xlsx');
    }
}
