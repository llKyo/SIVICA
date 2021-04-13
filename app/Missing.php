<?php

namespace App;

use App\Station;
use App\Document;
use App\Missings;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Missing extends Model
{
    protected $fillable = ['station_id', 'name','code'];

    public function stations()
    {
        return $this->belongsTo('App\Station');
    }

    public static function createMissing($station, $missings)
    {
        
    }

    public static function resetMissings()
    {
        DB::table('missings')->truncate();
        $stations = Station::all();

        foreach ($stations as $s) {

            $documents_ids = Document::where('station_id',$s->id)->get()->sortBy('code')->pluck('code')->unique();
            $correlatives  = collect();

            for ($i = $documents_ids->first(); $i < $documents_ids->last(); $i++) { 
                $correlatives->push($i);
            }
            
            $missings = $correlatives->diff($documents_ids);
            
            // createMissing($s, $missings);
            foreach ($missings as $m) {
            Missing::create([
                'station_id' => $s->id,
                'name' => $s->name,
                'code' => $m,
            ]);
        }
        }
    }

    public static function setMissings($station_id)
    {
        DB::table('missings')->where('station_id', $station_id)->delete();

        $documents_ids = Document::where('station_id',$station_id)->get()->sortBy('code')->pluck('code')->unique();
        //$documents = Document::where('station_id',$station_id)->get()->sortBy('code')->groupBy('code');

        $station = Station::find($station_id);
        $correlatives = collect();

        for ($i = $documents_ids->first(); $i < $documents_ids->last(); $i++) { 
            $correlatives->push($i);
        }
        
        $missings = $correlatives->diff($documents_ids);

        // createMissing($station, $missings);
        foreach ($missings as $m) {
            Missing::create([
                'station_id' => $station->id,
                'name' => $station->name,
                'code' => $m,
            ]);
        }
        
    }

    
}
