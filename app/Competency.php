<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Competency extends Model
{
    public function EmployeeCompetencies()
    {
        return $this->hasMany(EmployeeCompetencies::class, 'competency_id');
    }
}
