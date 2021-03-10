<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $fillable = ['state','place','previus_place','movement', 'observation', 'element_id', 'date'];

    public function element()
    {
        return $this->belongsTo('App\Element');
    }
}
