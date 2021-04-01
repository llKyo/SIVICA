<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class missing_document extends Model
{
    protected $fillable = ['station_id', 'name', 'document_id', 'code'];
}
