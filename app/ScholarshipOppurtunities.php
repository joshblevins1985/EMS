<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ScholarshipOppurtunities extends Model
{
    public function applicants()
    {
        return $this->hasMany(ScholarshipApplication::class, 'oppurtunity_id');
    }
}
