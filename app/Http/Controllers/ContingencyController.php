<?php

namespace App\Http\Controllers;

use App\Contingency;
use Illuminate\Http\Request;

class ContingencyController extends Controller
{
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
    public function create($document_id)
    {
        return view('mma.contingencies.create')->with('document_id',$document_id);
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
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function show(Contingency $contingency)
    {
        return view('mma.contingencies.show')->with('contingency',$contingency);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function edit(Contingency $contingency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contingency $contingency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contingency $contingency)
    {
        //
    }
}
