<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['date','state', 'station_id','activity_id','year_date','month_date','day_date','year_mma','month_mma',];

    public function activity()
    {
        return $this->belongsTo('App\Activity');
    }

    public function station()
    {
        return $this->belongsTo('App\Station');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function documents()
    {
        return $this->belongsToMany('App\Document')->withTimestamps()->withPivot('execution_date', 'check_observation');
    }

}
