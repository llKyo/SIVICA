<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            ->with('elements_disabled',\App\Element::where('state','disable')->count());
    }
}
