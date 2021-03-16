<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\Station;

class StatisticsController extends Controller
{
    //
    public function index()
    {
        $certifications = \App\Certification::all();

            $filtered_valid = $certifications->filter(function ($value){
                return $value->isValid() == 'valid';
        });
        $filtered_expired = $certifications->filter(function ($value){
            return $value->isValid() == 'expired';
    });
    
        
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
        
       
        // $documents = Document::all()->where('station_id', 2)->sortBy('code');
        // $documents = Document::where('station_id', 2)->get()->groupBy('code')->sortBy('code');

        
        // $stations = Station::all();
        // foreach ($stations as $station) {
        //     $documents = Document::where('station_id', $station->id)->get()->sortBy('code')->groupBy('code');
        
        //     $i = $documents->first()[0]->code;
            
        //     for ($i; $i < $documents->last()[0]->code; $i++) { 
        //         if (!isset($documents[$i][0])) {
        //              $alerta .= 'No se a encontrado el documento #' . $i . 'en la estación #' . $station->id ."<br>";
        //         }
        //     }
        // }

        // return $alerta;

        $faltantes = collect();
        $documents = Document::where('station_id', 2)->get()->sortBy('code')->groupBy('code');
        
        for ($i = $documents->first()[0]->code; $i < $documents->last()[0]->code; $i++) { 
            if (!isset($documents[$i][0])) {
                $faltantes->push('Documento #' . $i . ' de la estacion ' . 'Arica');
            }
        }
        

        



        // for ($i= $documents->first()->code; $i < $documents->last()->code; $i++) { 
        //     $d = Document::where('code', $i)->where('station_id',2)->get();
        //      $alerta .= $d->code;
        //     if ($d === null) {
        //         $alerta .= 'Documento ' . $i . ' no existe';
        //     }
        // }
        
        

        // foreach($documents as $documento)
        // {
            
        //     do {
                
        //         if ($documento->code != $i) {
        //             $alerta .= 'No se a encontrado el documento #' . $documento->code . "<br>";
                    
        //         }
        //         $i++;
        //     } while ($documento->code == $i);
        // }
        
        // return $alerta;
        

        $maintenances = \App\Maintenance::where('execution_date', null )->where('year_mma',\Carbon\Carbon::now()->year)->where('month_mma',$month_span);
            
        return view('mma.statistics.index')
            ->with('stations_count',\App\Station::all()->count())
            ->with('elements_retire_count',\App\Element::where('station_id',null)->count())
            ->with('elements_retire_disable_count',\App\Element::where('station_id',null)->where('state','disable')->count())
            ->with('certification_valid_count',$filtered_valid->count())
            ->with('certification_expired_count',$filtered_expired->count())
            ->with('document_without_mma_comment',\App\Document::where('mma_comment',null)->count())
            ->with('period',\App\Period::all())
            ->with('elements_count',\App\Element::all()->count())
            ->with('elements_enable',\App\Element::where('state','enable')->count())
            ->with('maintenances',$maintenances)
            ->with('elements_disabled',\App\Element::where('state','disable')->count())
            ->with('faltantes', $faltantes);

    }
}
