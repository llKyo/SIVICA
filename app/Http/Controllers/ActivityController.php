<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function index()
    {
        return view('mma.activities.index')->with('activities',\App\Activity::all());
    }

    public function store(Request $request)
    {
        $activity = \App\Activity::create($request->all());
        $action = 'Crea Actividad | Nombre:'.$activity->name.' | Descripcion: '.$activity->description.' | Id : '.$activity->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Actividades']);
        return redirect('/activities');
    }

    public function edit($id)
    {
        return view('mma.activities.edit')->with('activity', \App\Activity::find($id));
    }

    public function update(Request $request, \App\Activity $activity)
    {
        $activity->update($request->all());
        $action = 'Edita Actividad | Nombre:'.$activity->name.' | Descripcion: '.$activity->description.' | Id : '.$activity->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Actividades']);
        return redirect('/activities');
    }

    public function destroy($id)
    {
        $activity = \App\Activity::find($id);
        $action = 'Elimina Actividad | Nombre:'.$activity->name.' | Descripcion: '.$activity->description.' | Id : '.$activity->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Actividades']);

        \App\Activity::destroy($id);
        return redirect('/activities');
    }
}
