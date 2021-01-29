<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    protected $table = 'schedule';

    public $timestamps = true;
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
    
    public function timepunch()
    {
        return $this->hasMany(timepunch::class, 'schedule_id', 'id');
    }
    
    public function attendance()
    {
        return $this->hasOne(Attendance::class, 'schedule_id', 'id');
    }
    
    public function unitAssigned()
    {
        return $this->belongsTo(UnitSchedule::class, 'unit', 'id');
    }
    
    public function location()
    {
        return $this->belongsTo(Units::class, 'unit');
    }
    
    public function runSheet()
    {
        return $this->hasMany(BadRunSheet::class, 'employee', 'user_id');
    }
       
}
