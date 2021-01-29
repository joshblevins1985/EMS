<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class MechanicTask extends Model
{
    protected $guarded = array();

    public function task_label()
    {
        return $this->belongsTo(UnitMalfunction::class,'task', 'id');
    }
    
    public function mechanic()
    {
        return $this->belongsTo(Employee::class,'mechanic_assigned', 'user_id');
    }
    
    public function unit()
    {
        return $this->belongsTo(Units::class, 'unit_id', 'unit_number');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'mechanic_assigned');
    }
    public function report()
    {
        return $this->belongsTo(UnitMalfunctionReport::class, 'pid', 'id');
    }
    
    public function notes(){
        return $this->hasMany(MechanicTaskNote::class, 'task_id');
    }
}
