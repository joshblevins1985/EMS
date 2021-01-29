<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class RepairTicket extends Model
{

    protected $guarded = array();

    public function unit ()
    {
        return $this->belongsTo(Units::class, 'unit_id', 'unit_number');
    }

    public function jobs ()
    {
        return $this->hasMany(UnitMalfunctionReport::class, 'pid');
    }

    public function tasks ()
    {
        return $this->hasMany(MechanicTask::class, 'rid');
    }
}
