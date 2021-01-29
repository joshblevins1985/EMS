<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class NarcoticWaste extends Model
{
    protected $table = 'narcotic_waste_forms';

    public $timestamps = true;
    
    public function boxinfo()
    {
        return $this->belongsTo(NarcoticBoxes::class, 'box');
    }
    
    public function vial()
    {
        return $this->belongsTo(ControlledSubstances::class, 'vial_id');
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'paramedic');
    }
    
    public function drivers()
    {
        return $this->belongsTo(Employee::class, 'driver');
    }
    
    public function stationinfo()
    {
        return $this->belongsTo(Station::class, 'station');
    }
}
