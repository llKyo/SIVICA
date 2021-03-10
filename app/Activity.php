<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = ['name', 'description','color'];

    public function maintenances()
    {
        return $this->hasMany('App\Maintenance');
    }
}
