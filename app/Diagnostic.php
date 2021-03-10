<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $fillable = ['date','check_observation','option', 'element_id','path'];

    public function element()
    {
        return $this->belongsTo('App\Element');
    }
}
