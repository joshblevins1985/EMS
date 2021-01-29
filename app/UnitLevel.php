<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class UnitLevel extends Model
{
    public function units()
    {
        return $this->belongsTo(UnitSchedule::class, 'level');
    }
}
