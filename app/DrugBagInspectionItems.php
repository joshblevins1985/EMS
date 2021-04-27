<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrugBagInspectionItems extends Model
{

    public function type()
    {
        return $this->belongsTo(FieldType::class, 'typeId');
    }
    public function state()
    {
        return $this->hasMany(DrugBagInspectionItemsState::class, 'drugId');
    }
    public function level()
    {
        return $this->hasMany(DrugBagInspectionItemsLevel::class, 'drugId');
    }
}
