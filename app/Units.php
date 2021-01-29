<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    public function location()
    {
        return $this->belongsTo(Station::class, 'station');
    }
    
    public function service()
    {
        return $this->hasMany(MechanicTask::class, 'unit_id', 'unit_number');
    }
    
    public function miles()
    {
        return $this->hasMany(UnitDailyMile::class, 'unit_id');
    }

    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }
}
