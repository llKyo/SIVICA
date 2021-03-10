<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Carbon\Carbon as Carbon;

class Certification extends Model
{
    protected $fillable = ['date', 'type_brand', 'sn', 'check_observation', 'duration_time','path','company_observation'];

    public function isValid()
    {
        $date_create = Carbon::parse($this->date);
        $date_now = Carbon::now();
        $date_sum = $date_create->addMonths($this->duration_time);
        return $date_sum < $date_now ? 'expired':'valid';
    }

    public function dateForChile()
    {
        return Carbon::parse($this->date)->format('d / m / Y');
    }
}
