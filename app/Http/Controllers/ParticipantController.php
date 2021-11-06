<?php

namespace App\Http\Controllers;

use App\Imports\ParticipantsImport;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Export\ParticipantExport;


class ParticipantController extends Controller
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

        $participantsList = DB::table('participants')
            ->leftJoin('categories', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('transport_intensities', function ($join) {
                $join->on('participants.id_transport_intensity', '=', 'transport_intensities.id');
            })
            ->leftJoin('areas', function ($join) {
                $join->on('participants.id_area', '=', 'areas.id');
            })
            ->leftJoin('districts', function ($join) {
                $join->on('participants.id_district', '=', 'districts.id');
            })
            ->leftJoin('regencies', function ($join) {
                $join->on('participants.id_regency', '=', 'regencies.id');
            })
            ->leftJoin('box_resources', function ($join) {
                $join->on('participants.id_box_resource', '=', 'box_resources.id');
            })
            ->leftJoin('purchase_prices', function ($join) {
                $join->on('participants.id_purchase_price', '=', 'purchase_prices.id');
            })
            ->leftJoin('payment_methods', function ($join) {
                $join->on('participants.id_payment_method', '=', 'payment_methods.id');
            })
            ->leftJoin('banks', function ($join) {
                $join->on('participants.id_bank', '=', 'banks.id');
            })
            ->select(
                'participants.id',
                'participants.participant_name',
                'participants.joined_date',
                'categories.category_name',
                'areas.area_name',
                'districts.district_name',
                'regencies.regency_name',
                'box_resources.resource_name',
                'purchase_prices.price',
                'payment_methods.payment_method',
                'transport_intensities.intensity',
                'banks.bank_name'
            );

        if(!empty($request->get('param'))) {
            $data = $participantsList;

            if (isset($request->get('param')["idCategory"]) && count($request->get('param')["idCategory"]) != 0) {
                $data = $data->whereIn('participants.id_category', $request->get('param')["idCategory"]);
            }

            if (isset($request->get('param')["idParticipant"]) && count($request->get('param')["idParticipant"]) != 0) {
                $data = $data->whereIn('participants.id', $request->get('param')["idParticipant"]);
            }

            if (isset($request->get('param')["idDistrict"]) && count($request->get('param')["idDistrict"]) != 0) {
                $data = $data->whereIn('participants.id_district', $request->get('param')["idDistrict"]);
            }

            if (isset($request->get('param')["idRegency"]) && count($request->get('param')["idRegency"]) != 0) {
                $data = $data->whereIn('participants.id_regency', $request->get('param')["idRegency"]);
            }

            $datas = $data->get();

            return Datatables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editParticipant">Edit</a>';

                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteParticipant">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        if ($request->ajax()) {
            $datas = $participantsList->get();
            return Datatables::of($datas)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editParticipant">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteParticipant">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('participant/index', array(
            'user' => $user,
            'districts'=>$districts,
            'participants'=> $participants,
            'categories' => $categories,
            'regencies' => $regencies
        ));
    }

    public function store(Request $request)
    {

        $idBoxCollections = collect($request->id_box_resource);
        $idBoxResources = $idBoxCollections->implode( ',' ,',');

        $photo1 = $request->url_photo_1;
        $photo2 = $request->url_photo_2;
        $imageName1 = null;
        $imageName2 = null;

        if ($photo1 != null) {
            $imageName1 = date("Ymd-his").'-1.'.$photo1->extension();
            $request->url_photo_1->move(public_path('images/participants'), $imageName1);
        } else {
            $imageName1 = $request->fileNamePhoto1;
        }

        if ($photo2 != null) {
            $imageName2 = date("Ymd-his").'-2.'.$photo2->extension();
            $request->url_photo_2->move(public_path('images/participants'), $imageName2);
        } else {
            $imageName2 = $request->fileNamePhoto2;
        }



        $data = Participant::updateOrCreate(
            ['id' => $request->participant_id],
            [
                'participant_name' => $request->participant_name,
                'id_category' => $request->id_category,
                'contact_name_1' => $request->contact_name_1,
                'contact_position_1' => $request->contact_position_1,
                'contact_phone_1' => $request->contact_phone_1,
                'contact_email_1' => $request->contact_email_1,
                'contact_name_2' => $request->contact_name_2,
                'contact_position_2' => $request->contact_position_2,
                'contact_phone_2' => $request->contact_phone_2,
                'contact_email_2' => $request->contact_email_2,
                'joined_date' => $request->joined_date,
                'id_transport_intensity' => $request->id_transport_intensity,

                'address' => $request->address,
                'latitude' => $request->latitude,
                'langitude' => $request->langitude,
                'service_area' => $request->service_area,
                'id_area' => $request->id_area,
                'id_district' => $request->id_district,
                'id_regency' => $request->id_regency,

                'id_box_resource' => $idBoxResources,
                'resource_description' => $request->resource_description,
                'id_purchase_price' => $request->id_purchase_price,

                'id_payment_method' => $request->id_payment_method,
                'id_bank' => $request->id_bank,
                'bank_branch' => $request->bank_branch,
                'bank_account_number' => $request->bank_account_number,
                'bank_account_holder_name' => $request->bank_account_holder_name,

                'notes' => $request->notes,
                'url_photo_1' => $imageName1,
                'url_photo_2' => $imageName2,

                'created_by' => $request->created_by,
                'created_datetime' => $request->created_datetime,
                'last_modified_by' => $request->last_modified_by,
                'last_modified_datetime' => $request->last_modified_datetime,
            ]
        );

        return response()->json(['success'=>'Participant saved successfully.','data'=>$data]);
    }


    public function edit($id)
    {
        $user = Auth::user();

        $participant = Participant::find($id);
        $categories = DB::table('categories')->get();
        $transport_intensities = DB::table('transport_intensities')->get();
        $areas = DB::table('areas')->get();
        $districts = DB::table('districts')->get();
        $regencies = DB::table('regencies')->get();
        $boxresources = DB::table('box_resources')->get();
        $purchase_prices = DB::table('purchase_prices')->get();
        $payment_methods = DB::table('payment_methods')->get();
        $banks = DB::table('banks')->get();

        if($user->role == "Admin") {
            return view('participant/edit',
                compact('user','participant','categories','transport_intensities','areas','districts','regencies','purchase_prices','payment_methods','banks','boxresources'));
        } else {
            return view('participant/editForViewer',
                compact('user','participant','categories','transport_intensities','areas','districts','regencies','purchase_prices','payment_methods','banks','boxresources'));
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Participant::find($id)->delete();

        return response()->json(['success'=>'Participant deleted successfully.']);
    }

    public static function createParticipant()
    {
        $user = Auth::user();

        $categories = DB::table('categories')->get();
        $transport_intensities = DB::table('transport_intensities')->get();
        $areas = DB::table('areas')->get();
        $districts = DB::table('districts')->get();
        $regencies = DB::table('regencies')->get();
        $boxresources = DB::table('box_resources')->get();
        $purchase_prices = DB::table('purchase_prices')->get();
        $payment_methods = DB::table('payment_methods')->get();
        $banks = DB::table('banks')->get();

        return view('participant/create',
            compact('user','categories','transport_intensities','areas','districts','regencies','purchase_prices','payment_methods','banks','boxresources'));
    }

    public static function importParticipant(Request $request)
    {
        if($request->fileImportParticipant) {
            $path = ($request->fileImportParticipant)->getRealPath();
            Excel::import(new ParticipantsImport, $path);
        }

        return response()->json(['success'=>'Import successfully.']);

    }

    public function getDatatableCollection(Request $request){
        $collections = DB::table('collections')
            ->where('id_participant','=',$request->idParticipant)
            ->where('collect_date', '>=',$request->startDates)
            ->where('collect_date', '<=',$request->endDates)
            ->select(
                'id',
                'collect_date',
                'quantity',
            )
            ->orderBy('collect_date','desc')
            ->get();

        return Datatables::of($collections)
            ->addIndexColumn()
            ->editColumn('collect_date', function ($collection)
            {
                return [
                    'display' => \Carbon\Carbon::parse($collection->collect_date)->format('d M Y'),
                    'timestamp' => $collection->collect_date
                ];
            })
            ->make(true);
    }

    public function getLineChartDataCollection(Request $request){
        if ($request->type == 'week') {
            $collections = DB::table('collections')
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->where('id_participant','=',$request->idParticipant)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('FLOOR((DAYOFMONTH(collect_date) - 1) / 7) + 1 week_of_month'),
                    DB::raw('MONTH(collect_date) month'),
                    DB::raw('DATE_FORMAT(collect_date, "%b") monthName'),
                    DB::raw('YEAR(collect_date) year')
                )
                ->groupBy('year','month','week_of_month','monthName');

        } else if ($request->type == 'month') {
            $collections = DB::table('collections')
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->where('id_participant','=',$request->idParticipant)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('MONTH(collect_date) month'),
                    DB::raw('MONTHNAME(collect_date) monthName'),
                    DB::raw('YEAR(collect_date) year')
                )
                ->groupBy('month','monthName','year');

        } else if ($request->type == 'quarter') {
            $collections = DB::table('collections')
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->where('id_participant','=',$request->idParticipant)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('YEAR(collect_date) year'),
                    DB::raw('QUARTER(collect_date) quarter')
                )
                ->groupBy('year','quarter');

        } else if ($request->type == 'year') {
            $collections = DB::table('collections')
                ->where('collect_date', '>=',$request->startDates)
                ->where('collect_date', '<=',$request->endDates)
                ->where('id_participant','=',$request->idParticipant)
                ->select(
                    DB::raw('ROUND(SUM(quantity),1) qty'),
                    DB::raw('YEAR(collect_date) year')
                )
                ->groupBy('year');

        }

        $collections = $collections->get();

        $totalQty = 0;
        if ($request->type == 'week') {
            $dataLine = [];
            foreach ($collections as $collection) {
                $dataLine['label'][] = ['W'.$collection->week_of_month,$collection->monthName,$collection->year];
                $dataLine['qty'][] = $collection->qty;
                $totalQty += $collection->qty;
            }
        } else if ($request->type == 'month') {
            $dataLine = [];
            foreach ($collections as $collection) {
                $dataLine['label'][] = [$collection->monthName,$collection->year];
                $dataLine['qty'][] = $collection->qty;
                $totalQty += $collection->qty;
            }
        } else if ($request->type == 'quarter') {
            $dataLine = [];
            foreach ($collections as $collection) {
                $dataLine['label'][] = ['Q'.$collection->quarter,$collection->year];
                $dataLine['qty'][] = $collection->qty;
                $totalQty += $collection->qty;
            }
        } else if ($request->type == 'year') {
            $dataLine = [];
            foreach ($collections as $collection) {
                $dataLine['label'][] = [$collection->year];
                $dataLine['qty'][] = $collection->qty;
                $totalQty += $collection->qty;
            }
        }

        $getCategory = DB::table('categories')
            ->leftJoin('participants', function ($join) {
                $join->on('participants.id_category', '=', 'categories.id');
            })
            ->leftJoin('potentials', function ($join) {
                $join->on('potentials.id_category', '=', 'categories.id');
            })
            ->where('participants.id','=',$request->idParticipant)
            ->select(
                'potentials.potential_low',
                'potentials.potential_medium',
                'potentials.potential_high'
            )
            ->first();

        $potential = "";
        $date1 = $request->startDates;
        $date2 = $request->endDates;

        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);

        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);

        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);

        $monthDiff = (($year2 - $year1) * 12) + ($month2 - $month1) +1;

        $average = $totalQty / $monthDiff;
        $potentialColor = "";

        if ( $average <= $getCategory->potential_low ) {
            $potential = "Low";
            $potentialColor = "btn-danger";
        } else if ($average > $getCategory->potential_low && $average <= $getCategory->potential_high ) {
            $potential = "Medium";
            $potentialColor = "btn-warning";
        } else if ($average > $getCategory->potential_high) {
            $potential = "High";
            $potentialColor = "btn-success";
        }

        $monthlyCollections = DB::table('collections')
            ->where('collect_date', '>=',$request->startDates)
            ->where('collect_date', '<=',$request->endDates)
            ->where('id_participant','=',$request->idParticipant)
            ->select(
                DB::raw('ROUND(SUM(quantity),1) qty'),
                DB::raw('MONTH(collect_date) month'),
                DB::raw('MONTHNAME(collect_date) monthName'),
                DB::raw('YEAR(collect_date) year')
            )
            ->groupBy('month','monthName','year')
            ->get();

        $jumlahBulanPengangkutan = 0;

        foreach ($monthlyCollections as $collection) {
            $jumlahBulanPengangkutan += 1;
        }

        $continuity = "";
        $continuityPercentage = ($jumlahBulanPengangkutan / $monthDiff)*100;
        $continuityColor = "";

        if ($continuityPercentage <= 0) {
            $continuity = "None";
            $continuityColor = "btn-danger";
        } elseif ($continuityPercentage > 0 && $continuityPercentage <= 50) {
            $continuity = "Less Stable";
            $continuityColor = "btn-warning";
        } elseif ($continuityPercentage > 50 && $continuityPercentage < 100) {
            $continuity = "Medium";
            $continuityColor = "btn-info";
        } elseif ($continuityPercentage = 100) {
            $continuity = "Stable";
            $continuityColor = "btn-success";
        }

        $totalAndAverage = DB::table('collections')
            ->where('collect_date', '>=',$request->startDates)
            ->where('collect_date', '<=',$request->endDates)
            ->where('id_participant','=',$request->idParticipant)
            ->select(
                DB::raw('COUNT(id_participant) totalPengangkutan'),
                DB::raw('NVL(ROUND(SUM(quantity),1),0) qty')
            )
            ->first();


        if($totalAndAverage->qty != 0 and $totalAndAverage->totalPengangkutan != 0) {
            $average = round($totalAndAverage->qty / $totalAndAverage->totalPengangkutan,1);
        } else {
            $average = 0;
        }

        $data = [
            'dataLine' => $dataLine,
            'potential' =>$potential,
            'continuity' =>$continuity,
            'potentialColor' =>$potentialColor,
            'continuityColor' =>$continuityColor,
            'totalUbc' =>$totalAndAverage->qty,
            'average' => $average
        ];

        return response()->json(['data'=>$data]);

    }
    function downloadParticipants(Request $request)
    {
        return Excel::download(new ParticipantExport($request), 'participants.xlsx');
    }

}
