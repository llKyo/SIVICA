<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Missing_document extends Model
{
    protected $table = 'missing_documents';
    
    protected $fillable = ['station_id', 'name','code'];
}
