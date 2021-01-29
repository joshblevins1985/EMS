<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeN95FitTest extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }

    public function mask()
    {
        return $this->belongsTo(RespiratorModels::class, 'mask_type');
    }

    public function test()
    {
        return $this->belongsTo(Employee::class, 'tester', 'user_id');

    }

}
