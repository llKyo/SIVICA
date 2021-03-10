<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncidentController extends Controller
{

    public function index()
    {
        return view('mma.elements_movement.index')->with('incidents', \App\Incident::all());
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $element = \App\Element::find($request->element_id);
        $incident = new \App\Incident;
        $last_incident = $element->incidents->last();

        if($element->station_id==null) //From
        {
            if($last_incident->place!=null)
            {
                $previus_place = $last_incident->place;
            }
            else
            {
                $previus_place = "Sin lugar previo";
            }

        }
        else
        {
            $previus_place = $element->station->name;
        }



        if($request->movement =='remove') // To
        {
            $element->state = $request->state;
            $element->station_id = null;
            $place = $request->place_input;

        }
        elseif($request->movement =='install')
        {
            $element->state = $request->state;
            $element->station_id = $request->station_id;
            $station = \App\Station::find($request->station_id);
            $place =  $station->name;
        }
        elseif($request->movement =='station_to_estation')
        {
            $element->state = $request->state;
            $element->station_id = $request->station_id;
            $station = \App\Station::find($request->station_id);
            $place =  $station->name;
        }

        $request->request->add(['place' => $place,'previus_place' => $previus_place]);
        \App\Incident::create($request->all());

        $action = 'Mueve Equipo | Equipo:'.$element->name->name.' | Desde: '.$previus_place.' ->  A : '.$place.' ('.$request->movement.')' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Movimiento Equipos']);

        $element->save();
        return redirect('/elements_inventary');
    }

    public function show($id)
    {

    }


    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
