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


class ParticipantController extends Controller
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

        $participants = DB::table('participants')
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
            )
            ->get();

        if ($request->ajax()) {
            return Datatables::of($participants)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editParticipant">Edit</a>';

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteParticipant">Delete</a>';

                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('participant/index',compact('participants', 'user'));
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

        return view('participant/edit',
            compact('user','participant','categories','transport_intensities','areas','districts','regencies','purchase_prices','payment_methods','banks','boxresources'));
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

}
