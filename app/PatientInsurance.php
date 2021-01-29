<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class PatientInsurance extends Model
{
    public function insur()
    {
        return $this->belongsTo(InsuranceTypes::class, 'carrier_id');
    }
}
