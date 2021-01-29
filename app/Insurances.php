<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Insurances extends Model
{
        protected $table = 'insurances';

    public $timestamps = true;
    
    public function Insurances()
    {
        return $this->belongsTo(EmployeeInsurance::class, 'id', 'insurance_id');
       
    }
}
