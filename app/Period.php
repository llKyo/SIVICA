<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = ['init_date', 'finish_date','end_restriction_date', 'description',];

    public function documents()
    {
        return $this->hasMany('App\Document');
    }
}
