<?php

namespace App\Http\Controllers;

use App\Models\Glasses;
use Illuminate\Http\Request;

class GlassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $glasses =Glasses::paginate(2);
        return view('index',['glasses'=>$glasses]);
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
     * @param  \App\Models\Glasses  $glasses
     * @return \Illuminate\Http\Response
     */
    public function show(Glasses $glasses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Glasses  $glasses
     * @return \Illuminate\Http\Response
     */
    public function edit(Glasses $glasses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Glasses  $glasses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Glasses $glasses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Glasses  $glasses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Glasses $glasses)
    {
        //
    }
}
