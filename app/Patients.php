<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Patients extends Model
{
    public function station()
    {
        return $this->belongsTo(Station::class, 'primary_station', 'id');
    }
    
    public function insurance()
    {
        return $this->hasMany(PatientInsurance::class, 'patient_id');
    }
    
    public function medical()
    {
        return $this->hasMany(PatientMedicalHistory::class, 'patient_id');
    }
    
    public function qualification()
    {
        return $this->hasMany(PatientTransportQualifier::class, 'patient_id');
    }
    
    public function physician (){
        return $this->hasMany(PatientPhysician::class, 'patient_id');
    }
    
    public function notes (){
        return $this->hasMany(PatientTrackingNote::class, 'patient_id')->orderBy('created_at');
    }
    
    public function certifications(){
        return $this->hasMany(PatientDoctorCert::class, 'patient_id');
    }
}
