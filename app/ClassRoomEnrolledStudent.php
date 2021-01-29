<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ClassRoomEnrolledStudent extends Model
{
    public function employee ()
    {
        return $this->belongsTo(Employee::class,'user_id', 'user_id');
    }

    
    public function course ()
    {
        return $this->belongsTo(ClassRoom::class, 'classroom_id');
    }
}
