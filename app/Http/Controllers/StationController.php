<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


class StationController extends Controller
{

    public function index()
    {
        return view('mma.stations.index')->with('stations', \App\Station::all())->with('cities', \App\City::all());
    }

    public function store(Request $request)
    {
        \App\Station::create($request->all());
        $station = \App\Station::where('name', $request->name)->where('city_id', $request->city_id)->first();
        $action = 'Crea Estacion | Nombre:'.$station->name.' | Id: '.$station->id.' | Ciudad: '.$station->city->name.'' ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Estaciones']);
        return redirect('/stations');
    }

    public function edit($id)
    {
        return view('mma.stations.edit')->with('station', \App\Station::find($id))->with('cities', \App\City::all());
    }


    public function update(Request $request, \App\Station $station )
    {
        $station->update($request->all());
        $action = 'Edita Estacion | Nombre:'.$station->name.' | Id: '.$station->id ;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Estaciones']);
        return redirect('/stations');
    }

    public function destroy($id)
    {
        $station = \App\Station::find($id);
        $action = 'Elimina Estacion | Nombre:'.$station->name.' | Id: '.$id;
        \App\Log::create(['user_name' => \Auth::user()->name ,'user_id' => \Auth::user()->id ,'action' => $action,'item' => 'Estaciones']);
        \App\Station::destroy($id);
        return redirect('/stations');
    }

    public function getCoordinates(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', 'http://maps.googleapis.com/maps/api/geocode/json?address='.$request->address.'');
        $json =  $res->getBody();
        $data = json_decode($json, true);
        $latitude = $data['results'][0]['geometry']['location']['lat'];
        $longitude = $data['results'][0]['geometry']['location']['lng'];
        return $latitude.','.$longitude;
    }

}
