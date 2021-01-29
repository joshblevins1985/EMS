<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class PatientMedicalHistory extends Model
{
    public function condition()
    {
        return $this->belongsTo(MedicalConditions::class, 'condition_id');
    }
}
