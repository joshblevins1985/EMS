<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class CourseDates extends Model
{
    public function instruct (){
        return $this->belongsTo(Employee::class,  'instructor', 'user_id');
    }
    
    public function class_dates (){
        return $this->belongsTo(Classes::class,  'class_id');
    }
}
