<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CertificationController extends Controller
{

    public function index()
    {
        return view('mma.certifications.index')
            ->with('certifications', \App\Certification::all());
    }

    public function store(Request $request)
    {
        $request->file('doc')->move( base_path() . '/public/docs/certifications', $request->file('doc')->getClientOriginalName());
        $request->request->add(['path' => $request->file('doc')->getClientOriginalName()]);
        $certification = \App\Certification::create($request->all());
        $action = 'Crea Certificacion | Tipo / Marca:'.$certification->type_brand.' | S/N: '.$certification->sn.' | Id : '.$certification->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Certificaciones']);
        return redirect('/certifications');
    }

    public function edit($id)
    {
        return view('mma.certifications.edit')
            ->with('certification', \App\Certification::find($id));
    }

    public function update(Request $request, \App\Certification $certification)
    {

        if(isset($request->doc))
        {
            $request->file('doc')->move( base_path() . '/public/docs/certifications', $request->file('doc')->getClientOriginalName());
            $request->request->add(['path' => $request->file('doc')->getClientOriginalName()]);
        }
        else
        {
            $request->request->add(['path' => $certification->path ]);
        }

        $certification->update($request->all());
        $action = 'Edita Certificacion | Tipo / Marca:'.$certification->type_brand.' | S/N: '.$certification->sn.' | Id : '.$certification->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Certificaciones']);
        return redirect('/certifications');
    }

    public function destroy($id)
    {
        $certification = \App\Certification::find($id);
        $action = 'Elimina Certificacion | Tipo / Marca:'.$certification->type_brand.' | S/N: '.$certification->sn.' | Id : '.$certification->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Certificaciones']);
        $certification->delete();

        if(\Auth::user()->isAdmin())
        {
            return redirect('/list_certifications');
        }
        else
        {
            return redirect('/certifications');
        }

    }

    public function listCertifications()
    {
        return view('mma.certifications.list')
            ->with('certifications', \App\Certification::all());
    }

    public function edit_Comments($id)
    {
        return view('mma.certifications.edit_comments')->with('certification',\App\Certification::find($id));
    }

    public function update_Comments(Request $request, $id)
    {
        $certification = \App\Certification::find($id);
        if($request->check_observation)
        {
            $certification->check_observation = $request->check_observation;
            $certification->save();
            $action = 'Comenta Certificacion MMA | Fecha:'.$certification->updated_at.'' ;
            \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Certificaciones']);
            return redirect('/list_certifications');
        }

        if($request->company_observation)
        {
            $certification->company_observation = $request->company_observation;
            $certification->save();
            $action = 'Comenta Certificacion Empresa | Fecha:'.$certification->updated_at.'' ;
            \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Certificaciones']);
            return redirect('/certifications');
        }

    }
}
