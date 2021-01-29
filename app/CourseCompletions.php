<?php

namespace Vanguard;



class CourseCompletions extends Model
{
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
    
    public function classesfrom()
    {
        return $this->belongsTo(Classes::class,  'course_id', 'id');
    }
    
    
}
