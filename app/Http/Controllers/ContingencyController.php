<?php

namespace App\Http\Controllers;

use App\Contingency;
use App\Station;
use App\Document;
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
        return view('mma.contingencies.create')
        ->with('document_id',$document_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $contingency = Contingency::create([
            'anomaly_date' => request('anomaly_date'),
            'visit_date' => request('visit_date'),
            'tracing' => request('tracing'),
            'parameter' => request('parameter'),
            'ns' => request('ns'),
            'causes_power_outage' => request('causes_power_outage'),
            'cause_failure' => request('cause_failure'),
            'another_cause' => request('another_cause'),
            'solve_on_visit' => request('solve_on_visit'),
            'manage_action' => request('manage_action')
            
        ]);
        
        //TODO: Arreglar, no hace el cambio
        $document = Document::find(request('document_id'));
        $document->update([
            'contingency_id'=> $contingency->id
        ]);
        $document->save();

        return redirect('/documents');
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
    public function edit($id)
    {
        // return Contingency::find($id);
        return view('mma.contingencies.edit')->with('contingency', Contingency::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contingency = Contingency::find($id);
        $contingency->update($request->all());
        return redirect('/documents');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contingency  $contingency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contingency = Contingency::find($id);
        //TODO: borrar en la relación con Document
        $contingency->delete();
        return redirect('/documents');

    }
}
