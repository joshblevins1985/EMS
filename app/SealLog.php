<?php

namespace Vanguard;



class SealLog extends Model
{
    protected $table = 'seal_log';

    public $timestamps = true;
    
    public function Employees ()
    {
        return $this->belongsTo(Employee::class, 'employee', 'id');
    }
}
