<?php

namespace App\Http\Controllers;

use App\Export\CollectionExport;
use App\Models\Collection;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $categories = DB::table('categories')->orderBy('category_name', 'asc')->get();
        $regencies = DB::table('regencies')->orderBy('regency_name', 'asc')->get();
        $districts = DB::table('districts')->orderBy('district_name', 'asc')->get();
        $participants = DB::table('participants')->orderBy('participant_name', 'asc')->get();

        $categoriesList = DB::table('categories')
            ->leftJoin('category_details', function ($join) {
                $join->on('categories.id', '=', 'category_details.category_id')
                    ->where('category_details.year', '=', (new DateTime)->format("Y"));
            })
            ->select(
                'categories.*',
                );

        $subParticipants = DB::table('participants')
            ->joinSub($categoriesList, 'categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('participants.id_regency', '=', 'regencies.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('participants.id_district', '=', 'districts.id');
            })
            ->select(
                'participants.id as participant_id',
                'participants.participant_name as participant_name',
                'categories.id as id_category',
                'categories.category_name as category_name',
                'regencies.id as regency_id',
                'regencies.regency_name as regency_name',
                'districts.id as district_id'
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
                'participants.participant_id as id_participant',
                'participants.participant_name',
                'participants.id_category as id_category',
                'participants.category_name',
                'participants.regency_id as id_regency',
                'participants.regency_name',
                'participants.district_id as id_district',
            );


        if(!empty($request->get('param'))) {
            $data = $collections;

            if (isset($request->get('param')["idCategory"]) && count($request->get('param')["idCategory"]) != 0) {
                $data = $data->whereIn('id_category', $request->get('param')["idCategory"]);
            }

            if (isset($request->get('param')["idParticipant"]) && count($request->get('param')["idParticipant"]) != 0) {
                $data = $data->whereIn('id_participant', $request->get('param')["idParticipant"]);
            }

            if (isset($request->get('param')["idDistrict"]) && count($request->get('param')["idDistrict"]) != 0) {
                $data = $data->whereIn('district_id', $request->get('param')["idDistrict"]);
            }

            if (isset($request->get('param')["idRegency"]) && count($request->get('param')["idRegency"]) != 0) {
                $data = $data->whereIn('regency_id', $request->get('param')["idRegency"]);
            }

            if (isset($request->get('param')["startDates"]) && isset($request->get('param')["endDates"])) {
                $data = $data->whereBetween('collect_date', [$request->get('param')["startDates"],$request->get('param')["endDates"]]);
            }

            $datas = $data->get();

            return Datatables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCollection">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCollection">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->editColumn('collect_date', function ($collection)
                {
                    return [
                        'display' => \Carbon\Carbon::parse($collection->collect_date)->format('d/m/Y'),
                        'timestamp' => $collection->collect_date
                    ];
                })
                ->make(true);
        }

        if ($request->ajax()) {
            $data = $collections->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editCollection">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteCollection">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->editColumn('collect_date', function ($collection)
                {
                    return [
                        'display' => \Carbon\Carbon::parse($collection->collect_date)->format('d/m/Y'),
                        'timestamp' => $collection->collect_date
                    ];
                })
                ->make(true);
        }

        return view('collection/index', array(
            'user' => $user,
            'districts'=>$districts,
            'participants'=> $participants,
            'categories' => $categories,
            'regencies' => $regencies
        ));
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

    public static function downloadCollections(Request $request)
    {
        return Excel::download(new CollectionExport($request), 'collections.xlsx');
    }


}
