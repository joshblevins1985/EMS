<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DrugBag extends Model
{

    public function inspection()
    {
        return $this->hasOne(DrugBagInspection::class, 'drugBagId')->latest();
    }

    public function station()
    {
        return $this->belongsTo(Station::class, 'stationId');
    }
    public function level()
    {
        return $this->belongsTo(UnitLevel::class, 'bagLevelId');
    }
    public function lastAssigned()
    {
        return $this->hasOne(DrugBagSealLog::class, 'bag_id')->latest();
    }
}
