<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class UnitMalfunctionReport extends Model
{
    public function reported_by()
    {
        return $this->belongsTo(Employee::class, 'added_by', 'user_id');
    }

    public function problems ()
    {
        return $this->hasMany(MechanicTask::class, 'pid');
    }
}
