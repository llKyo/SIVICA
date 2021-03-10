<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Name extends Model
{
    protected $fillable = ['name'];

    public function elements()
    {
        return $this->hasMany('App\Element');
    }
}
