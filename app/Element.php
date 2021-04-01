<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    protected $fillable = ['name_id','brand', 'model', 'sn', 'description', 'type_id','station_id','state','owner', 'ni', 'warranty' ];

  public function incidents()
  {
      return $this->hasMany('App\Incident');
  }

  public function station()
  {
      return $this->belongsTo('App\Station');
  }

  public function name()
  {
      return $this->belongsTo('App\Name');
  }

  public function type()
  {
      return $this->belongsTo('App\Type');
  }

  public function diagnostics()
  {
      return $this->hasMany('App\Diagnostic');
  }

}
