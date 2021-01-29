<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public function course ()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
    
    public function lead ()
    {
        return $this->hasOne(Employee::class, 'user_id', 'insturctor');
    }
    
    public function students (){
        
        return $this->hasMany(EnrolledStudent::class, 'class_id', 'id');
    }
    
    public function course_dates(){
        return $this->hasMany(CourseDates::class, 'class_id');
    }
    
    public function complete()
    {
        return $this->hasMany(CourseCompletions::class, 'course_id', 'id');
    }
}
