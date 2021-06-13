<?php

namespace App\Http\Controllers;

use App\Models\Dashboard1;
use Illuminate\Http\Request;

class Dashboard1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard1/index');
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
