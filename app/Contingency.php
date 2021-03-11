<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contingency extends Model
{
    //protected $fillable = ['name_id','brand', 'model', 'sn', 'description', 'type_id','station_id','state','owner'];
    public function document()
    {
      return $this->belongTo('App\Document');
    }

}
