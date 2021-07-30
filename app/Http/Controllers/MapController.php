<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Regency;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MapController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $categories = Category::latest()->get();
        $regencies = Regency::latest()->get();
        $districts = District::latest()->get();

        return view('map/index', array(
            'user' => $user, 
            'districts'=>$districts,
            'categories' => $categories,
            'regencies' => $regencies
        ));
    }

    public function getMapParticipantsInformation(Request $request) {
        $participants = Participant::select('participants.id as id_participant','participants.*','districts.district_name','regencies.regency_name','areas.area_name','categories.category_name')
                                    ->join('categories','participants.id_category','=','categories.id')
                                    ->join('districts','participants.id_district','=','districts.id')
                                    ->join('regencies','participants.id_regency','=','regencies.id')
                                    ->join('areas','participants.id_area','=','areas.id');

        $participantsInformation = [];

        if (isset($request->idCategory) && count($request->idCategory) != 0) {
            $participants = $participants->whereIn('id_category', $request->idCategory);
        }
    
        if (isset($request->idDistrict) && count($request->idDistrict) != 0) {
            $participants = $participants->whereIn('id_district', $request->idDistrict);
        }

        if (isset($request->idRegency) && count($request->idRegency) != 0) {
            $participants = $participants->whereIn('id_regency', $request->idRegency);
        }

        $participants = $participants->get();

        foreach ($participants as $participant) {
            $description = '<table><tr><td><b>Phone Number</b></td><td><b>:</b></td><td><b>'.$participant->contact_phone_1.'</b></td></tr>';
            $description = $description.'<tr><td>Category</td><td>:</td><td>'.$participant->category_name.'</td></tr>';
            $description = $description.'<tr><td>Area</td><td>:</td><td>'.$participant->area_name.'</td></tr>';
            $description = $description.'<tr><td>Subdistrict</td><td>:</td><td>'.$participant->district_name.'</td></tr>';
            $description = $description.'<tr><td>Regency</td><td>:</td><td>'.$participant->regency_name.'</td></tr></table>';
            $description = $description.'<a href="/participants/'.$participant->id_participant.'/edit">View Detail</a>';

            $information = [
                'type' => 'FeatureCollection',
                'geometry' => [
                    'type' => 'Point',    
                    'coordinates' => [(float) $participant->langitude, (float) $participant->latitude]
                ],
                'properties'=> [
                    'title'=> $participant->participant_name,
                    'description'=> $description,
                    'marker-color' => '#0000FF',
                    'category' => $participant->id_category
                ]
            ];

            if ($participant->langitude != NULL && $participant->latitude != NULL) {
                array_push($participantsInformation, $information);
            }
            
        }

        return response()->json(['data'=>$participantsInformation]);
    }
}
