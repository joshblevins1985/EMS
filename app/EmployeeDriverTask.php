<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeDriverTask extends Model
{
    public function employee ()
    {
        return $this->hasOne(Employee::class, 'user_id', 'user_id');
    }
    
    public function trainingOfficer ()
    {
        return $this->hasOne(Employee::class, 'fto_id', 'user_id');
    }
    
    public function driversTask ()
    {
        return $this->hasOne(DriverTrainingCheckOffTasks::class, 'task_id');
    }
}
