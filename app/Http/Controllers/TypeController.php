<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    public function index()
    {
        return view('mma.types.index')->with('types', \App\Type::all());
    }


    public function store(Request $request)
    {
        $type = \App\Type::create($request->all());
        $action = 'Crea Tipo de Equipo | Nombre:'.$type->name.' | Id : '.$type->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Tipos Equipos']);
        return redirect('/types');
    }

    public function edit(Type $type)
    {
        return view('mma.types.edit')->with('type', $type);
    }

    public function update(Request $request, Type $type)
    {
        $type->update($request->all());
        $action = 'Edita Tipo de Equipo | Id : '.$type->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Tipos Equipos']);
        return redirect('/types');
    }

    public function destroy(Type $type)
    {
        $action = 'Elimina Tipo de Equipo | Id : '.$type->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Tipos Equipos']);
        $type->delete();
        return redirect('/types');
    }
}
