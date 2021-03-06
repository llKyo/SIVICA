<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contingency extends Model
{
    protected $fillable = [
        'anomaly_date',
        'visit_date',
        'tracking',
        'parameter',
        'ns',
        'causes_power_outage',
        'cause_failure',
        'another_cause',
        'solve_on_visit',
        'manage_action',
    ];

    

    public function document()
    {
        return $this->hasMany('App\Document');
    }

    public function station()
    {
      return $this->belongsTo('App\Station');
    }


}
