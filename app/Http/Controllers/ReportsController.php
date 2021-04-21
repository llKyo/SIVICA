<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Period;
use \DB;
use \App\Contingency;
use \App\Station;
use \App\Document;
use \App\Missing;
use \Carbon\Carbon as Carbon;

class ReportsController extends Controller
{
    public function index()
    {
      return view('mma.reports.index')
            ->with('stations', \App\Station::all())
            ->with('periods', Period::all())
            ->with('years', DB::table('maintenances')->select(DB::raw('year_mma as date'))->distinct()->get());
    }

    public function reportMaintenances(Request $request)
    {
       
        if($request->station != 'all')
        {
            $maintenances = \App\Maintenance::where('station_id',$request->station)->get();
            if($request->year != 'all')
            {
                $maintenances_y = $maintenances->where('year_mma',$request->year);
                if($request->month != 'all')
                {
                    $maintenances_m = $maintenances_y->where('month_mma',$request->month);
                }
                else
                {
                    $maintenances_m = $maintenances_y;
                }
            }
            else
            {
                $maintenances_y = $maintenances;
                if($request->month != 'all')
                {
                    $maintenances_m = $maintenances_y->where('month_mma',$request->month);
                }
                else
                {
                    $maintenances_m = $maintenances_y;
                }
            }
        }
        else
        {
            $maintenances = \App\Maintenance::all();
            if($request->year != 'all')
            {
                $maintenances_y = $maintenances->where('year_mma',$request->year);
                if($request->month != 'all')
                {
                    $maintenances_m = $maintenances_y->where('month_mma',$request->month);
                }
                else
                {
                    $maintenances_m = $maintenances_y;
                }
            }
            else
            {
                $maintenances_y = $maintenances;
                if($request->month != 'all')
                {
                    $maintenances_m = $maintenances_y->where('year_mma',$request->month);
                }
                else
                {
                    $maintenances_m = $maintenances_y;
                }
            }
        }
        if($request->station != 'all')
        {
            $station =  \App\Station::find($request->station)->name;
        }
        else
        {
            $station =  "Todas";
        }
        return view('mma.reports.maintenances')
            ->with('maintenances',$maintenances_m)
            ->with('station',$station)
            ->with('year',$request->year)
            ->with('month',$request->month);

    }

    public function reportElements(Request $request)
    {

        if($request->station != 'all')
        {
            $elements = \App\Station::find($request->station)->elements;
            if($request->name != 'all')
            {
                $elements_final = $elements->where('name',$request->name);
            }
            else
            {
                $elements_final = $elements;
            }
        }
        else
        {
            $elements = \App\Element::all();
            if($request->name != 'all')
            {
                $elements_final = $elements->where('name',$request->name);
            }
            else
            {
                $elements_final = $elements;
            }
        }

        if($request->station != 'all')
        {
            $station = \App\Station::find($request->station)->name;
        }
        else
        {
            $station = 'Todas';
        }


        return view('mma.reports.station_elements')
            ->with('elements',$elements_final)
            ->with('station',$station)
            ->with('name',$request->name);
    }

    public function reportElementsNoDiag(Request $request)
    {
        return view('mma.reports.elements_nodiag')
            ->with('elements',\App\Element::where('station_id',null)->get())
            ->with('station',$request->station)
            ->with('type',$request->type);
    }

    public function reportContingencies(Request $request)
    {
        $contingencies = collect();
        if ($request->year != 'all') {

            $date = Carbon::createFromDate($request->year, 1, 1);
            $dayStart = $date->copy()->startOfYear();
            $dayEnd = $date->copy()->endOfYear();

            if ($request->station != 'all') {
                
                if ($request->name != 'all') {

                    $documents = \App\Station::find($request->station)->documents->where('contingency_id', '!=', null);
                    foreach ($documents as $d) {
                        $contingencies->push(Contingency::find($d->contingency_id));
                    }

                    $contingencies = $contingencies->where('parameter', $request->name);
                    
                    $contingencies = $contingencies->where('anomaly_date', '>=',  $dayStart);
                    $contingencies = $contingencies->where('anomaly_date', '<=',  $dayEnd);

                } else {

                    $documents = \App\Station::find($request->station)->documents->where('contingency_id', '!=', null);
                    foreach ($documents as $d) {
                        $contingencies->push(Contingency::find($d->contingency_id));
                    }
                    $contingencies = $contingencies->where('anomaly_date', '>=',  $dayStart);
                    $contingencies = $contingencies->where('anomaly_date', '<=',  $dayEnd);
                }
            } else {
                if ($request->name != 'all') {
                    
                    $contingencies = Contingency::all();
                    $contingencies = $contingencies->where('parameter', $request->name);
                    $contingencies = $contingencies->where('anomaly_date', '>=',  $dayStart);
                    $contingencies = $contingencies->where('anomaly_date', '<=',  $dayEnd);

                } else {

                    $contingencies = Contingency::all();
                    $contingencies = $contingencies->where('anomaly_date', '>=',  $dayStart);
                    $contingencies = $contingencies->where('anomaly_date', '<=',  $dayEnd);
                }
            }
            
        } else {
            if ($request->datefilter != null) {
                $fechas    = explode ( ' - ' , $request->datefilter);
                $dateStart = Carbon::parse($fechas[0]);
                $dateEnd   = Carbon::parse($fechas[1]);

                if ($request->station != 'all') {
                    if ($request->name != 'all') {

                        $documents = \App\Station::find($request->station)->documents->where('contingency_id', '!=', null);
                        foreach ($documents as $d) {
                            $contingencies->push(Contingency::find($d->contingency_id));
                        }
                        $contingencies = $contingencies->where('parameter', $request->name);
                        $contingencies = $contingencies->where('anomaly_date', '>=',  $dateStart);
                        $contingencies = $contingencies->where('anomaly_date', '<=',  $dateEnd);

                    } else {

                        $documents = \App\Station::find($request->station)->documents->where('contingency_id', '!=', null);
                        foreach ($documents as $d) {
                            $contingencies->push(Contingency::find($d->contingency_id));
                        }
                        $contingencies = $contingencies->where('anomaly_date', '>=',  $dateStart);
                        $contingencies = $contingencies->where('anomaly_date', '<=',  $dateEnd);
                    }
                } else {
                    if ($request->name != 'all') {

                        $contingencies = Contingency::all();
                        $contingencies = $contingencies->where('parameter', $request->name);
                        $contingencies = $contingencies->where('anomaly_date', '>=',  $dateStart);
                        $contingencies = $contingencies->where('anomaly_date', '<=',  $dateEnd);

                    } else {
                        
                        $contingencies = Contingency::all();
                        $contingencies = $contingencies->where('anomaly_date', '>=',  $dateStart);
                        $contingencies = $contingencies->where('anomaly_date', '<=',  $dateEnd);
                    }
                }

            } else {
                if ($request->station != 'all') {
                    if ($request->name != 'all') {

                        $documents = \App\Station::find($request->station)->documents->where('contingency_id', '!=', null);
                        foreach ($documents as $d) {
                            $contingencies->push(Contingency::find($d->contingency_id));
                        }
                        $contingencies = $contingencies->where('parameter', $request->name);

                    } else {
                        $documents = \App\Station::find($request->station)->documents->where('contingency_id', '!=', null);
                        foreach ($documents as $d) {
                            $contingencies->push(Contingency::find($d->contingency_id));
                        }
                    }
                } else {
                    if ($request->name != 'all') {

                        $contingencies = Contingency::all();
                        $contingencies = $contingencies->where('parameter', $request->name);

                    } else {
                        $contingencies = Contingency::all();
                    }
                }
            }
            
        }

        if($request->station != 'all')
        {
            $station = \App\Station::find($request->station)->name;
        }
        else
        {
            $station = 'Todas';
        }
        
        return view('mma.reports.contingencies')
            ->with('contingencies', $contingencies)
            ->with('station',  $station)
            ->with('year', $request->year)
            ->with('name', $request->name)
            ->with('datefilter', $request->datefilter);
    }

    public function reportMissings(Request $request)
    {
        
        

        if($request->station != 'all')
        {
            Missing::setMissings($request->station);
            $correlatives = Missing::where('station_id', $request->station)->get();
            
        }
        else
        {
            Missing::resetMissings();
            $correlatives = Missing::all();
        }

        if($request->station != 'all')
        {
            $station = Station::find($request->station)->name;
        }
        else
        {
            $station = 'Todas';
        }
        
        
        return view('mma.reports.missings')
            ->with('correlatives', $correlatives)
            ->with('station', $station);
    }
}