<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class PatientDoctorCert extends Model
{
    public function patient(){
        return $this->belongsTo(Patients::class, 'patient_id');
    }
    
    public function pt_physician () {
        return $this->belongsTo(PatientPhysician::class, 'physician_id');
    }
    
    public function procedure(){
        return $this->belongsTo(ProcedureCode::class, 'procedure_code');
    }
}
