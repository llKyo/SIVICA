<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['label','code','version','description','path','station_id','period_id', 'contingency_id'];

  public function station()
  {
      return $this->belongsTo('App\Station');
  }

  public function period()
  {
      return $this->belongsTo('App\Period');
  }

  public function contingency()
  {
      return $this->belongsTo('App\Contingency');
  }

  public function maintenances()
  {
      return $this->belongsToMany('App\Maintenance')->withTimestamps()->withPivot('execution_date', 'check_observation');
;
  }
}
