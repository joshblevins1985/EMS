<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DrugBagSealLog extends Model
{
    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'user_id');
    }

}
