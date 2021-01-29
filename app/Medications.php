<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Medications extends Model
{
    public function ControlledSubstances ()
    {
        return $this->hasMany(ControlledSubstances::class, 'id', 'medication');
    }
}
