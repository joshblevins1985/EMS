<?php

namespace Vanguard;



class PayRates extends Model
{
    
    protected $table = 'pay_rates';

    public $timestamps = true;
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
}
