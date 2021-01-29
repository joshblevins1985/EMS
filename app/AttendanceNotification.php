<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class AttendanceNotification extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
}
