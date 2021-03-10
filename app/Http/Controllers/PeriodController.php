<?php

namespace App\Http\Controllers;

use App\Period;
use Illuminate\Http\Request;

class PeriodController extends Controller
{
    public function index()
    {
        return view('mma.periods.index')->with('periods',\App\Period::all());
    }

    public function store(Request $request)
    {
        $period = \App\Period::create($request->all());
        $action = 'Crea Periodo | Fecha Inicio:'.$period->init_date.' | Fecha Termino: '.$period->finish_date.' | Id : '.$period->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Periodos']);
        return redirect('/periods');
    }

    public function edit(Period $period)
    {
        return view('mma.periods.edit')->with('period',$period);
    }

    public function update(Request $request, Period $period)
    {
        $period->update($request->all());
        $action = 'Edita Periodo | Fecha Inicio:'.$period->init_date.' | Fecha Termino: '.$period->finish_date.' | Id : '.$period->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Periodos']);
        return redirect('/periods');
    }

    public function destroy(Period $period)
    {
        $action = 'Elimina Periodo | Id : '.$period->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Periodos']);
        $period->delete();
        return redirect('/periods');
    }
}
