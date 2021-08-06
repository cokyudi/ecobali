<?php

namespace App\Http\Controllers;

use App\Models\Papermill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

class PapermillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $papermills = DB::table('papermills')
            ->leftJoin('papermill_categories', function ($join) {
                $join->on('papermills.id_papermill_category', '=', 'papermill_categories.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('papermills.id_regency', '=', 'regencies.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('papermills.id_district', '=', 'districts.id');
            })
            ->select(
                'papermills.id',
                'papermills.papermill_name',
                'papermill_categories.papermill_category_name',
                'districts.district_name',
                'regencies.regency_name',
            )
            ->get();

        if ($request->ajax()) {
            return Datatables::of($papermills)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPapermill">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePapermill">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('papermill/index',compact('papermills', 'user'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Papermill::updateOrCreate(
            ['id' => $request->papermill_id],
            [
                'papermill_name' => $request->papermill_name,
                'id_papermill_category' => $request->id_papermill_category,
                'contact_name_1' => $request->contact_name_1,
                'contact_position_1' => $request->contact_position_1,
                'contact_phone_1' => $request->contact_phone_1,
                'contact_email_1' => $request->contact_email_1,

                'address' => $request->address,
                'latitude' => $request->latitude,
                'langitude' => $request->langitude,
                'id_area' => $request->id_area,
                'id_district' => $request->id_district,
                'id_regency' => $request->id_regency,

                'id_purchase_price' => $request->id_purchase_price,

                'id_payment_method' => $request->id_payment_method,
                'id_bank' => $request->id_bank,
                'bank_branch' => $request->bank_branch,
                'bank_account_number' => $request->bank_account_number,
                'bank_account_holder_name' => $request->bank_account_holder_name,

                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Papermill saved successfully.','data'=>$data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Papermill  $papermill
     * @return \Illuminate\Http\Response
     */
    public function show(Papermill $papermill)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Papermill  $papermill
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        $papermill = Papermill::find($id);
        $papermill_categories = DB::table('papermill_categories')->get();
        $areas = DB::table('areas')->get();
        $districts = DB::table('districts')->get();
        $regencies = DB::table('regencies')->get();
        $purchase_prices = DB::table('purchase_prices')->get();
        $payment_methods = DB::table('payment_methods')->get();
        $banks = DB::table('banks')->get();

        return view('papermill/edit',
            compact('user','papermill','papermill_categories','areas','districts','regencies','purchase_prices','payment_methods','banks'));
    }

    public function destroy($id)
    {
        Papermill::find($id)->delete();

        return response()->json(['success'=>'Papermill deleted successfully.']);
    }

    public static function createPapermill()
    {
        $user = Auth::user();

        $papermill_categories = DB::table('papermill_categories')->get();
        $areas = DB::table('areas')->get();
        $districts = DB::table('districts')->get();
        $regencies = DB::table('regencies')->get();
        $purchase_prices = DB::table('purchase_prices')->get();
        $payment_methods = DB::table('payment_methods')->get();
        $banks = DB::table('banks')->get();

        return view('papermill/create',
            compact('user','papermill_categories','areas','districts','regencies','purchase_prices','payment_methods','banks'));
    }
}
