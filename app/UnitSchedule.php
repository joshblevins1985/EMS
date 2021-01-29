<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class UnitSchedule extends Model
{
    protected $table= 'unit_schedule';
    
    use Filterable;
    
    public function care()
    {
        return $this->belongsTo(UnitLevel::class, 'level', 'id');
    }
    public function u()
    {
        return $this->belongsTo(Units::class, 'unit', 'id');
    }
    public function crew()
    {
        return $this->hasMany(schedule::class, 'unit', 'id');
    }
    
    public function logs()
    {
        return $this->hasMany(UnitLog::class, 'unit', 'id');
    }
    
    public function stat()
    {
        return $this->belongsTo(UnitStatus::class, 'status', 'id');
    }
    
    public function unit_notes ()
    {
        return $this->hasMany(UnitNote::class, 'unit_id', 'id');
    }
    
    public function incidents ()
    {
        return $this->hasMany(DispatchIncident::class, 'unit', 'id');
    }
    
 
}

