<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DispatchAlerts extends Model
{
    public function alert ()
    {
        return $this->belongsTo(AddressFlag::class, 'alert_id');
    }
}
