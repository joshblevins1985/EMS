<?php

namespace Vanguard;

class Policies extends Model
{
    protected $table = 'policies';

    public $timestamps = true;
    
    public function EmployeeEncounters()
    {
        return $this->belongsTo(EmployeeEncounters::class, 'policy', 'id');
    }
}
