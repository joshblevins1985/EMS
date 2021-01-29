<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DriverTrainingCheckOffTasks extends Model
{
    public function driversCheck ()
    {
        return $this->hasMany(EmployeeDriverTask::class, 'task_id');
    }
}
