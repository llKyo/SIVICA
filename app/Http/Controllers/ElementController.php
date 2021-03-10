<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElementController extends Controller
{

    public function index()
    {
        return view('mma.elements_inventary.index')
        ->with('elements', \App\Element::all())
        ->with('stations', \App\Station::all())
        ->with('names', \App\Name::all())
        ->with('types', \App\Type::all());
    }


    public function store(Request $request)
    {
        $element = \App\Element::create($request->all());
        $action = 'Crea Equipo | Nombre:'.$element->name.' | Modelo: '.$element->model.' | S/N: '.$element->sn.'| Id : '.$element->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Equipos']);
        return redirect('/elements_inventary');
    }


    public function show($id)
    {
        $element = \App\Element::find($id);
        return view('mma.elements_inventary.show')->with('element',$element);
    }

    public function edit($id)
    {
        return view('mma.elements_inventary.edit')
            ->with('element', \App\Element::find($id))
            ->with('stations', \App\Station::all())
            ->with('names', \App\Name::all())
            ->with('types', \App\Type::all());
    }


    public function update(Request $request, $id)
    {
        $element = \App\Element::find($id);
        $element->update($request->all());
        $action = 'Edita Equipo | Nombre:'.$element->name.' | Modelo: '.$element->model.' | S/N: '.$element->sn.'| Id : '.$element->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Equipos']);

        return redirect('/elements_inventary');
    }


    public function destroy($id)
    {
        $element = \App\Element::find($id);

        $action = 'Elimina Equipo (con sus movimientos y diagnosticos ) | Nombre:'.$element->name.' | Modelo: '.$element->model.' | S/N: '.$element->sn.'| Id : '.$element->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Equipos']);
        $element->incidents()->delete();
        $element->diagnostics()->delete();
        $element->delete();

        return redirect('/elements_inventary');
    }

    public function move_edit($id)
    {
        return view('mma.elements_inventary.move_edit')->with('element', \App\Element::find($id))->with('stations', \App\Station::all());
    }

    public function diag_repair($id)
    {
        return view('mma.elements_inventary.diagnostic_repair')->with('element', \App\Element::find($id));
    }

    public function listElements()
    {
        return view('mma.elements_inventary.list')->with('elements', \App\Element::all())->with('stations', \App\Station::all());
    }
}
