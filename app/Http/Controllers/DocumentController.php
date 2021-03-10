<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentController extends Controller
{

    public function index()
    {
        return view('mma.documents.index')
            ->with('periods', \App\Period::all())
            ->with('activities', \App\Activity::all())
            //->with('documents', \App\Document::all()->reverse())
            ->with('stations', \App\Station::all())
            ->with('date_now', date('Y-m-d'));
    }

    public function store(Request $request)
    {

        if(\App\Document::where('code',$request->code)->where('version',$request->version)->where('station_id',$request->station_id)->count() > 0 )
        {
            return redirect()->back()->withErrors(['El codigo y version del reporte ya existen!']);
        }

        $this->validate($request, [
        'doc' => 'required|max:21000',
        'station_id' => 'required',
        'period_id' => 'required',
        ]);

        $request->file('doc')->move( base_path() . '/public/docs/reports', $request->file('doc')->getClientOriginalName());
        $request->request->add(['path' => $request->file('doc')->getClientOriginalName()]);
        $document = \App\Document::create($request->all());
        $action = 'Crea Reporte | Nombre:'.$document->label.' | Estacion: '.$document->station->name.' | Id : '.$document->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Reportes Op.']);
        return redirect('/documents');
    }


    public function show($id)
    {
        $document = \App\Document::find($id);
        return view('mma.documents.show')->with('document',$document);
    }


    public function edit($id)
    {
        $document = \App\Document::find($id);
        return view('mma.documents.edit')
            ->with('periods', \App\Period::all())
            ->with('stations', \App\Station::all())
            ->with('document',$document);
    }


    public function update(Request $request, $id)
    {

        $document = \App\Document::find($id);
        if(isset($request->doc))
        {
            $request->file('doc')->move( base_path() . '/public/docs/reports', $request->file('doc')->getClientOriginalName());
            $request->request->add(['path' => $request->file('doc')->getClientOriginalName()]);
        }
        else
        {
            $request->request->add(['path' => $document->path ]);
        }

        $document->update($request->all());
        $action = 'Edita Reporte | Nombre:'.$document->label.' | Estacion: '.$document->station->name.' | Id : '.$document->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Reportes Op.']);
        return redirect('/documents');
    }


    public function destroy($id)
    {
        $document = \App\Document::find($id);
        $action = 'Elimina Reporte | Nombre:'.$document->label.' | Estacion: '.$document->station->name.' | Id : '.$document->id.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Reportes Op.']);
        $document->delete();
        return redirect('/documents');
    }

    public function edit_Comments($id)
    {
        $document = \App\Document::find($id);
        $maintenances_doc = $document->maintenances->pluck('id')->all();
        $maintenances_diff = $document->station->maintenances->whereNotIn('id', $maintenances_doc);
        if(\Auth::user()->rol == 'admin'){
            return view('mma.documents.assing_maintenances')
                ->with('document',$document)
                ->with('station',$document->station)
                ->with('maintenances_diff',$maintenances_diff)
                ->with('maintenances_assing',$document->maintenances); 
        }elseif(\Auth::user()->rol == 'company'){
            return view('mma.documents.edit_comments')->with('document',$document); 
        }

    }

    public function update_Comments(Request $request, $id)
    {
        $document = \App\Document::find($id);
        if($request->mma_comment)
        {
            $document->mma_comment = $request->mma_comment;
        }
        if($request->company_comment)
        {
            $document->company_comment = $request->company_comment;
        }

        $document->save();
        return redirect('/documents');
    }





    public function update_DocumentMaintenances(Request $request, $id)
    {
        
        //dd($request->all());
        $document = \App\Document::find($id);

        if($request->maintenances){

           foreach ($request->maintenances as $main) {

               $maintenance = \App\Maintenance::find($main);
               $maintenance->documents()->attach($id,['check_observation' => $request->check_observation]);

           }

        }
        
        $document->mma_comment = $request->mma_comment;
        $document->save();
        
        return redirect('/documents');
    }






    public function listAssingToMaintenance()
    {

      $month_now =  \Carbon\Carbon::now()->month;
      $month_span ='';
      switch ($month_now) {
          case 1:
              $month_span = "Enero";
              break;

          case 2:
              $month_span = "Febrero";
              break;
          case 3:
              $month_span = "Marzo";
              break;

          case 4:
              $month_span = "Abril";
              break;

          case 5:
              $month_span = "Mayo";
              break;

          case 6:
              $month_span = "Junio";
              break;

          case 7:
              $month_span = "Julio";
              break;

          case 8:
              $month_span = "Agosto";
              break;

          case 9:
              $month_span = "Septiembre";
              break;

          case 10:
              $month_span = "Octubre";
              break;

          case 11:
              $month_span = "Noviembre";
              break;

          case 12:
              $month_span = "Diciembre";
              break;

      }

        $maintenances = \App\Maintenance::where('year_mma',\Carbon\Carbon::now()->year)->where('month_mma',$month_span)->get();

        return view('mma.documents.listtomaintenance')
            ->with('date_now', date('Y-m-d'))
            ->with('maintenances', \App\Maintenance::where('year_mma',\Carbon\Carbon::now()->year)->get())
            ->with('years',\DB::table('maintenances')->orderBy('year_mma', 'asc')->distinct()->get(['year_mma']))
            ->with('stations', \App\Station::all());
    }

    public function createAssignToMaintenance($id)
    {
        $maintenance = \App\Maintenance::find($id);
        return view('mma.documents.documenttomaintenance')
            ->with('maintenance',$maintenance)
            ->with('documents',\App\Document::where('station_id',$maintenance->station_id)->get());
    }

    public function saveAssingToMaintenance(Request $request)
    {
        $maintenance = \App\Maintenance::find($request->maintenance_id);
        $maintenance->documents()->attach($request->document_id, array('execution_date' => $request->execution_date,'check_observation' => $request->check_observation));
        if( $maintenance->documents() && $maintenance->documents()->count() <= 1)
        {
          $maintenance->execution_date = $request->execution_date;
          $maintenance->save();
        }
        return redirect('/assign_document');

    }
}
