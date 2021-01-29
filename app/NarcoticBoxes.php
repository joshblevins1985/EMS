<?php

namespace Vanguard;



class NarcoticBoxes extends Model
{
    public function NarcoticLog()
    {
        return $this->hasMany(NarcoticLog::class, 'box', 'id');
    }
    
    public function ControlledSubstance ()
    {
        return $this->hasMany(ControlledSubstances::class, 'id', 'location');
    }
    
    public function BoxStations ()
    {
        return $this->belongsTo(Station::class, 'station', 'id');
    }
    
    public function SealLog ()
    {
        return $this->hasMany(SealLog::class, 'box', 'id');
    }
    public function Waste ()
    {
        return $this->hasMany(NarcoticWaste::class, 'box', 'id');
    }
}
