<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{

  public function stations()
  {
      return $this->hasMany('App\Station');
  }
}
