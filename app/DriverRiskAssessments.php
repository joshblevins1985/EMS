<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DriverRiskAssessments extends Model
{
    protected $table = 'drivers_risk_assessment';

    public $timestamps = true;
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'user_id');
    }
}
