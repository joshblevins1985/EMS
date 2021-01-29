<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeCompetencies extends Model
{
    public function competency () 
    {
        return $this->belongsTo(RequiredCompetencies::class, 'competency_id');
    }
}
