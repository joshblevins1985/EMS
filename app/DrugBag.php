<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DrugBag extends Model
{
    public function station()
    {
        return $this->belongsTo(Station::class, 'stationId');
    }
}
