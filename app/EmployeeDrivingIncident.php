<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeDrivingIncident extends Model
{
    public function type ()
    {
        return $this->belongsTo(DrivingIncident::class, 'incident_type', 'id');
    }
}
