<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = ['action','item','user_id','user_name',];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
