<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Dashboard1;
use App\Models\District;
use App\Models\Collection;
use App\Models\Participant;
use App\Models\Regency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Dashboard1Controller extends Controller
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
        $collections = Collection::latest()->get();
        $participants = Participant::latest()->get();

        $totalCollection = 0;
        for ($i = 0; $i < count($collections); $i++) {
            $totalCollection = $totalCollection + $collections[$i]->quantity;
        }

        return view('dashboard1/index', array(
            'user' => $user, 
            'districts'=>$districts, 
            'collections'=> $collections, 
            'participants'=> $participants,
            'categories' => $categories,
            'regencies' => $regencies,
            'totalCollection' => $totalCollection
        ));
    }

    public function getNumberOfParticipants() {
        
        $participantCategory = Category::latest()->get();
        $numberOfParticipants = [
            ["Category", "Number of Participant"]
        ];

        for ($i = 0; $i < count($participantCategory); $i++) {
            $categoryName = $participantCategory[$i]->category_name;
            $countParticipant = Participant::where('id_category', $participantCategory[$i]->id)->get();
            array_push($numberOfParticipants, [$categoryName, count($countParticipant)]);
        }

        return response()->json(['data'=>$numberOfParticipants]);
    }

    public function getContribution() {
        $participantCategory = Category::latest()->get();
        $contribution = [
            ["Category", "Contribution"]
        ];

        for ($i = 0; $i < count($participantCategory); $i++) {
            $categoryName = $participantCategory[$i]->category_name;
            $participantsCollections = Collection::join('participants','collections.id_participant','=','participants.id')
                                                 ->join('categories','participants.id_category','=','categories.id')
                                                 ->where('categories.id', $participantCategory[$i]->id)
                                                 ->get();
            $categoryContribution = 0;
            for ($j = 0; $j < count($participantsCollections); $j++) {
                $categoryContribution = $categoryContribution + $participantsCollections[$j]->quantity;
            }
            array_push($contribution, [$categoryName, $categoryContribution]);
        }

        return response()->json(['data'=>$contribution]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dashboard1  $dashboard1
     * @return \Illuminate\Http\Response
     */
    public function show(Dashboard1 $dashboard1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dashboard1  $dashboard1
     * @return \Illuminate\Http\Response
     */
    public function edit(Dashboard1 $dashboard1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dashboard1  $dashboard1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dashboard1 $dashboard1)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dashboard1  $dashboard1
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dashboard1 $dashboard1)
    {
        //
    }
}
