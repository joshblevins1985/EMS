<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class FinancialAssistance extends Model
{
    protected $table= "financial_assistance_requests";

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'user_id');
    }
}
