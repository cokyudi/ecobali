<?php

namespace App\Http\Controllers;

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

        return view('dashboardComparison/index',compact('user'));
    }
}
