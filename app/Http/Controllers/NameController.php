<?php

namespace App\Http\Controllers;

use App\Name;
use Illuminate\Http\Request;

class NameController extends Controller
{

    public function index()
    {
        return view('mma.names.index')->with('names', \App\Name::all());
    }

    public function store(Request $request)
    {
        $name = \App\Name::create($request->all());
        $action = 'Crea Nombre de Equipo | Nombre:'.$name->name.' | Id : '.$name->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Nombres Equipos']);
        return redirect('/names');
    }

    public function edit(Name $name)
    {
        return view('mma.names.edit')->with('name', $name);
    }

    public function update(Request $request, Name $name)
    {
        $name->update($request->all());
        $action = 'Edita Nombre Equipo | Id : '.$name->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Nombres Equipos']);
        return redirect('/names');
    }

    public function destroy(Name $name)
    {
        $action = 'Elimina Nombre Equipo | Id : '.$name->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Nombres Equipos']);
        $name->delete();
        return redirect('/names');
    }
}
