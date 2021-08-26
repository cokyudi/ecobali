<?php

namespace App\Http\Controllers;

use App\Export\SalesExport;
use App\Models\Area;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Log;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;

class SaleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $papermills = DB::table('papermills')->get();

        $sales = DB::table('sales')
            ->leftJoin('papermills', function ($join) {
                $join->on('sales.id_papermill', '=', 'papermills.id');
            })
            ->select(
                'sales.id',
                'sales.sale_date',
                'papermills.papermill_name',
                'sales.delivered_to_papermill',
                'sales.weighing_scale_gap_eco',
                'sales.weighing_scale_gap_eco_percent',
                'sales.moisture_content_and_contaminant',
                'sales.moisture_content_and_contaminant_percent',
                'sales.received_at_papermill',
                'sales.total_weight_accepted',
            )
            ->get();

        if ($request->ajax()) {
            $data = $sales;
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editSale">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteSale">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->editColumn('sale_date', function ($collection)
                {
                    return [
                        'display' => \Carbon\Carbon::parse($collection->sale_date)->format('d/m/Y'),
                        'timestamp' => $collection->sale_date
                    ];
                })
                ->make(true);
        }

        return view('sale/index',compact('sales','user','papermills'));
    }

    public function store(Request $request)
    {

        $sale_date = $request->sale_date;
        $collected_d_min_1 = round($request->collected_d_min_1,1);
        $delivered_to_papermill = round($request->delivered_to_papermill,1);
        $weighing_scale_gap_eco = round(($collected_d_min_1 - $delivered_to_papermill),1);
        $weighing_scale_gap_eco_percent = round(($weighing_scale_gap_eco / $collected_d_min_1) * 100,1);
        $id_papermill = $request->id_papermill;
        $received_at_papermill = round($request->received_at_papermill,1);
        $weighing_scale_gap_papermill = round(($received_at_papermill - $delivered_to_papermill),1);
        $weighing_scale_gap_papermill_percent = round(($weighing_scale_gap_papermill / $delivered_to_papermill) * 100,1);
        $moisture_content_and_contaminant = $request->moisture_content_and_contaminant;
        $moisture_content_and_contaminant_percent = round(($moisture_content_and_contaminant / $received_at_papermill) * 100,1);
        $deduction = round(($moisture_content_and_contaminant + (-$weighing_scale_gap_papermill)),1);
        $deduction_percent = round(($deduction / $delivered_to_papermill) * 100,1);
        $total_weight_accepted = round(($received_at_papermill - $moisture_content_and_contaminant),1);


        Sale::updateOrCreate(
            ['id' => $request->sales_id],
            [
                'sale_date' => $sale_date,
                'collected_d_min_1' => $collected_d_min_1,
                'delivered_to_papermill' => $delivered_to_papermill,
                'weighing_scale_gap_eco' => $weighing_scale_gap_eco,
                'weighing_scale_gap_eco_percent' => $weighing_scale_gap_eco_percent,
                'id_papermill' => $id_papermill,
                'received_at_papermill' => $received_at_papermill,
                'weighing_scale_gap_papermill' => $weighing_scale_gap_papermill,
                'weighing_scale_gap_papermill_percent' => $weighing_scale_gap_papermill_percent,
                'moisture_content_and_contaminant' => $moisture_content_and_contaminant,
                'moisture_content_and_contaminant_percent' => $moisture_content_and_contaminant_percent,
                'deduction' => $deduction,
                'deduction_percent' => $deduction_percent,
                'total_weight_accepted' => $total_weight_accepted,

                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Sale saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::find($id);
        return response()->json($sale);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Sale::find($id)->delete();

        return response()->json(['success'=>'Sales deleted successfully.']);
    }

    function downloadSales()
    {
        return Excel::download(new SalesExport, 'sales.xlsx');
    }
}
