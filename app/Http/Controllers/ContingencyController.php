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

        $contingency = Contingency::create($request->all());
        $document = Document::find(request('document_id'));
        $document->update(['contingency_id'=> $contingency->id]);
        $document->save();
  
        $action = 'Crea Contingencia | Fecha:'.$contingency->anomaly_date.' | Estacion: '.$document->station->name.' | Id : '.$contingency->id.'';
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Contingencias']);

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

        $action = 'Edita Estacion | Id: '.$contingency->id ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Contingencias']);
        
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
        $document = Document::where('contingency_id', $id);

        $action = 'Elimina Contingencia | Id: '.$id;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Contingencias']);

        $document->update(['contingency_id' => null]);
        $contingency->delete();

        return redirect('/documents');
    }
}
