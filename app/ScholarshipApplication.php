<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ScholarshipApplication extends Model
{
    public function school()
    {
        return $this->hasOne(ScholarshipOppurtunities::class, 'id', 'oppurtunity_id');
    }
    
    public function agreement()
    {
        return $this->hasOne(ScholarshipContract::class, 'student_id', 'id');
    }
}
