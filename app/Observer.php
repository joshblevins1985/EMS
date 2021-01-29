<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Observer extends Model
{
    public function schedule ()
    {
        return $this->hasMany(ObserverDates::class, 'observer_id');
    }
}
