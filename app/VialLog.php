<?php

namespace Vanguard;



class VialLog extends Model
{
    public function vial()
    {
        return $this->belongsTo(ControlledSubstances:: class, 'vial_id');
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee:: class, 'added_by');
    }
    
    public function stat()
    {
        return $this->belongsTo(VialStatus:: class, 'status');
    }
    
    public function loc()
    {
        return $this->belongsTo(NarcoticBoxes::class, 'location');
    }
}
