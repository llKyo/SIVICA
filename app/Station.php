<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    protected $fillable = ['name', 'lat', 'lng', 'address', 'state','city_id'];

  public function city()
  {
      return $this->belongsTo('App\City');
  }

  public function elements()
  {
      return $this->hasMany('App\Element');
  }

  public function maintenances()
  {
      return $this->hasMany('App\Maintenance');
  }

  public function documents()
  {
      return $this->hasMany('App\Document');
  }
  
  
}
