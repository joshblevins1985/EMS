<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class CovidExposure extends Model
{
    protected $guarded =[''];

    public function employee ()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'user_id');
    }

    public function patient ()
    {
        return $this->belongsTo(CovidPatientExposure::class, 'pid');
    }

    public function notes ()
    {
        return $this->hasMany(CovidExposureNote::class, 'pid');
    }
}
