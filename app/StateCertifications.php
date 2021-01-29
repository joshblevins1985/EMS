<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class StateCertifications extends Model
{
    protected $table = 'employee_state_certifications';

    public $timestamps = true;
    
   protected $fillable = ['user_id', 'state', 'certification_level','expiration','status', 'certification_number'];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
    
    public function states ()
    {
        return $this->belongsTo(States::class, 'state');
    }
    
    public function certtype ()
    {
        return $this->belongsTo(StateCertificationTypes::class, 'certification_level');
    }
    
}
