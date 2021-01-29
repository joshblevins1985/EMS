<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DriversTrainingLogs extends Model
{
    public function FtoDate ()
    {
        return $this->belongsTo(FieldTrainingDates::class, 'ftodate_id');
    }
}
