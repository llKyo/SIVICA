<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \DB;

class ReportsController extends Controller
{
    public function index()
    {
      return view('mma.reports.index')
            ->with('stations', \App\Station::all())
            ->with('years', DB::table('maintenances')->select(DB::raw('year_mma as date'))->distinct()->get());
    }

    public function reportMaintenances(Request $request)
    {
        //dd($request);
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

}
