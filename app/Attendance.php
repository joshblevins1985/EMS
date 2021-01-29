<?php

namespace Vanguard;



class Attendance extends Model
{
    protected $table= 'attendance';
    
    public $timestamps = true;
    
    public function employee()
    {
    return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }

    public function punch()
    {
        return $this->belongsTo(schedule::class, 'schedule_id', 'id');
    }
    
     public function type()
    {
        return $this->belongsTo(AttendanceOccurance::class, 'occurance_type');
    }
        
}
