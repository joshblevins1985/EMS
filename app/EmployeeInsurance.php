<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeInsurance extends Model
{
    protected $table = 'employee_insurances';

    public $timestamps = true;
    
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
        return $this->hasOne(Insurances::class, 'id', 'insurance_id');
    }
}
