<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardComparison;

class DashboardComparisonController extends Controller
{
    public function index()
    {
        return view('dashboardComparison/index');
    }
}
