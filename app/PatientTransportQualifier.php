<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class PatientTransportQualifier extends Model
{
    protected $guarded = [''];
    
    public function qualifier(){
        return $this->belongsTo(TransportQualifier::class, 'transport_qualifier_id');
    }
    
    public function pt_condition(){
        return $this->belongsTo(PatientMedicalHistory::class, 'medical_condition');
    }
    
    public function stat(){
        return $this->belongsTo(PatientTransportQuailifierStatus::class, 'status');
    }
    public function patient(){
        return $this->belongsTo(Patients::class, 'patient_id');
    }
}
