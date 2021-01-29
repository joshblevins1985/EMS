<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeePositions extends Model
{
    public function employees()
    {
      return  $this->hasMany(Employee::class);
    }
    
    public function courses ()
    {
        return $this->belongsTo(Courses::class, 'base_level', 'id');
    }
    public  function trainingLevels ()
    {
        return $this->hasMany(FieldTrainingTaskLevel::class, 'employee_level');
    }
}
