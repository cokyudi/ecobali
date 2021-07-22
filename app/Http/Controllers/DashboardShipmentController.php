<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\District;
use App\Models\Regency;
use Illuminate\Http\Request;
use App\Models\DashboardComparison;
use Illuminate\Support\Facades\Auth;


class DashboardShipmentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $categories = Category::latest()->get();
        $regencies = Regency::latest()->get();
        $districts = District::latest()->get();

        return view('dashboardShipment/index',compact('user','categories','regencies','districts'));
    }
}
