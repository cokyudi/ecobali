<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Participant;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Models\DashboardComparison;
use Illuminate\Support\Facades\Auth;


class DashboardComparisonController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $participants = Participant::latest()->get();
        $categories = Category::latest()->get();
        $regencies = Regency::latest()->get();
        $districts = District::latest()->get();

        return view('dashboardComparison/index',compact('user','participants','categories','regencies','districts'));
    }
}
