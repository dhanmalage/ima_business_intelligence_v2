<?php

namespace App\Http\Controllers;

use App\ImaEventDetail;
use Illuminate\Http\Request;

class ImaEventDetailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\ImaEventDetail  $imaEventDetail
     * @return \Illuminate\Http\Response
     */
    public function show(ImaEventDetail $imaEventDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImaEventDetail  $imaEventDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ImaEventDetail $imaEventDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImaEventDetail  $imaEventDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ImaEventDetail $imaEventDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImaEventDetail  $imaEventDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImaEventDetail $imaEventDetail)
    {
        //
    }
}
