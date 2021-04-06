<?php

namespace App\Http\Controllers;
use File;
use App\Diagnostic;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{

    public function index()
    {
        return view('mma.diag_repair.index')->with('diag_repairs', \App\Diagnostic::all());
    }

    public function store(Request $request)
    {
        $request->file('doc')->move( base_path() . '/public/docs/diagnostic_repair', $request->file('doc')->getClientOriginalName());
        $request->request->add(['path' => $request->file('doc')->getClientOriginalName()]);
        $diagnostic = \App\Diagnostic::create($request->all());

        $action = 'Crea Diagnostico | Observacion / Chequeo :'.$diagnostic->check_observation.' | Elemento: '.$diagnostic->element->name->name.' | Id : '.$diagnostic->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Diagnosticos']);

        return redirect('/elements_inventary');
    }

    public function show(Diagnostic $diagnostic)
    {

    }

    public function edit($id)
    {
        return view('mma.diag_repair.edit')->with('diag_repair', \App\Diagnostic::find($id));
    }

    public function update(Request $request, $id)
    {
        $diagnostic = \App\Diagnostic::find($id);
        if($request->file('doc'))
        {
            $request->file('doc')->move( base_path() . '/public/docs/diagnostic_repair', $request->file('doc')->getClientOriginalName());
            $request->request->add(['path' => $request->file('doc')->getClientOriginalName()]);
        }
        $diagnostic->update($request->all());

        $action = 'Edita Diagnostico | Observacion / Chequeo :'.$diagnostic->check_observation.' | Elemento: '.$diagnostic->element->name->name.' | Id : '.$diagnostic->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Diagnosticos']);

        return redirect('/diag_repair');
    }

    public function destroy($id)
    {
        $diagnostic = \App\Diagnostic::find($id);
        $action = 'Elimina Diagnostico | Id : '.$diagnostic->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Diagnosticos']);
        $destinationPath = public_path().'/docs/diagnostic_repair/'.$diagnostic->path; 
        if (file_exists($destinationPath)) {
            unlink($destinationPath);
        }
        $diagnostic->delete();
        return redirect('/diag_repair');
    }
}
