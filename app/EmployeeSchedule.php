<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
     protected $table= 'employee_schedule';
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
    
    public function location()
    {
        return $this->belongsTo(Units::class, 'unit');
    }
    
    public function runSheet()
    {
        return $this->hasMany(BadRunSheet::class, 'user_id', 'employee');
    }
    
}
