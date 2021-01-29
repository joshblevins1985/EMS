<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DriverHistoryTracking extends Model
{
    public function employees()
    {
        return $this->hasOne(Employee::class, 'user_id', 'employee');
    }
}
