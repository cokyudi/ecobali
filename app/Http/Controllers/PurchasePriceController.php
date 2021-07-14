<?php

namespace App\Http\Controllers;

use App\Models\PurchasePrice;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;


class PurchasePriceController extends Controller
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

        $purchasePrices = PurchasePrice::latest()->get();
        
        if ($request->ajax()) {
            $data = PurchasePrice::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPurchasePrice">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePurchasePrice">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('purchasePrice/index',compact('purchasePrices','user'));
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
        PurchasePrice::updateOrCreate(
            ['id' => $request->purchasePrice_id],
            [
                'price' => $request->price, 
                'description' => $request->description,
                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );        
   
        return response()->json(['success'=>'Purchase Price saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchasePrice  $purchasePrice
     * @return \Illuminate\Http\Response
     */
    public function show(PurchasePrice $purchasePrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchasePrice  $purchasePrice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchasePrice = PurchasePrice::find($id);
        return response()->json($purchasePrice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchasePrice  $purchasePrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchasePrice $purchasePrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchasePrice  $purchasePrice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        PurchasePrice::find($id)->delete();
     
        return response()->json(['success'=>'Purchase Price deleted successfully.']);
    }
}
