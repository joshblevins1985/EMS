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
}