<?php

namespace Vanguard;



class AttendanceOccurance extends Model
{
    protected $table= 'attendance_occurance_types';
    
    public $timestamps = true;
    
    public function type()
    {
        return $this->hasMany(Attendance::class);
    }
    
    
}
