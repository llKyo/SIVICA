<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceController extends Controller
{

    public function index()
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
      //dd($maintenances);
        return view('mma.maintenances.index')
            ->with('maintenances', $maintenances)
            ->with('stations', \App\Station::all())
            ->with('activities',\App\Activity::All())
            ->with('year_active',\Carbon\Carbon::now()->year)
            ->with('years',\DB::table('maintenances')->orderBy('year_mma', 'asc')->distinct()->get(['year_mma']));
    }

    public function store(Request $request)
    {
        $request->request->add(['state' => 'scheduled']);

        foreach($request->station_id as $stationid ){
            foreach($request->month_mma as $month ){

                $maintenance = \App\Maintenance::create([

                    'state' => $request->state , 
                    'station_id' => $stationid,
                    'activity_id' => $request->activity_id,
                    'year_mma' => $request->year_mma,
                    'month_mma' => $month
                ]);
                
                $action = 'Crea Mantencion | ID:'.$maintenance->id.' | Actividad: '.$maintenance->activity->name.' | Año/Mes : '.$maintenance->year_mma.'_'.$maintenance->month_mma;
                \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Mantenciones']);
          
            }
        }

        return redirect('/maintenances');
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        return view('mma.maintenances.edit')
        ->with('maintenance', \App\Maintenance::find($id))
        ->with('stations', \App\Station::all())
        ->with('activities',\App\Activity::All());
    }

    public function update(Request $request, \App\Maintenance $maintenance)
    {

        $maintenance->update($request->all());
        $action = 'Edita Mantencion | ID:'.$maintenance->id.' | Actividad: '.$maintenance->activity->name.' | Año/Mes : '.$maintenance->year_mma.'_'.$maintenance->month_mma ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Mantenciones']);
        return redirect('/maintenances');
    }

    public function destroy($id)
    {
        $maintenance = \App\Maintenance::find($id);

        $action = 'Elimina Mantencion | ID:'.$maintenance->id.' | Actividad: '.$maintenance->activity->name.' | Año/Mes : '.$maintenance->year_mma.'_'.$maintenance->month_mma  ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Mantenciones']);

        $maintenance->delete();
        return redirect('/maintenances');
    }

    public function edit_Comments($id)
    {
        return view('mma.maintenances.edit_comments')->with('maintenance',\App\Maintenance::find($id));
    }

    public function update_Comments(Request $request, $id)
    {
        $maintenance = \App\Maintenance::find($id);
        if($request->mma_comment)
        {
            $maintenance->mma_comment = $request->mma_comment;
            $maintenance->save();
            $action = 'Comenta Mantencion MMA | Fecha:'.$maintenance->updated_at.'' ;
            \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Mantenciones']);
            return redirect('/maintenances');
        }

        if($request->company_comment)
        {
            $maintenance->company_comment = $request->company_comment;
            $maintenance->save();
            $action = 'Comenta Mantencion Empresa | Fecha:'.$maintenance->updated_at.'' ;
            \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Mantenciones']);
            return redirect('/assign_document');
        }
    }

}
