<?php

namespace Vanguard;


class ControlledSubstances extends Model
{
    

    public $timestamps = true;
    
    public function Medications ()
    {
        return $this->belongsTo(Medications::class, 'medication', 'id');
    }
    
    public function Locations () 
    {
        return $this->belongsTo(NarcoticBoxes::class, 'location');
    }
    
    public function log()
    {
        return $this->hasMany(VialLog::class, 'vial_id');
    }
    
    public function stat()
    {
        return $this->belongsTo(VialStatus::class, 'status');
    }
}
