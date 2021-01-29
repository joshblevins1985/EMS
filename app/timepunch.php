<?php

namespace Vanguard;

class timepunch extends Model
{
    protected $table = 'time_punch';

    public $timestamps = true;
    
    protected $dates = ['time_in', 'time_out'];
    
    public function employee(){
        
       return $this->belongsTo(Employee::class, 'employee_id', 'user_id');
    }
    
    public function schedule()
    {
        return $this->belongsTo(schedule::class, 'schedule_id', 'id');
    }
}
