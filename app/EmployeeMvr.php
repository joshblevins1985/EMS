<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeMvr extends Model
{
    protected $table = 'employee_mvr';

    public $timestamps = true;
    
    public function mvroffense ()
    {
        return $this->belongsTo(MvrOffense::class,  'offense', 'id');
    }
}
