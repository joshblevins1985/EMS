<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class PatientPhysician extends Model
{
    protected $guarded = [''];
    
    public function doctor (){
        return $this->belongsTo(Physician::class, 'physician_id');
    }
}
