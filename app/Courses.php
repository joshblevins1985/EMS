<?php

namespace Vanguard;



class Courses extends Model
{
    protected $table = 'courses';

    public $timestamps = true;
    
    public function EmployeePositions()
    {
        return $this->hasOne(EmployeePositions::class, 'id', 'base_level');
    }

    public function topic()
    
    {
        return $this->hasOne(CourseCategories::class, 'id', 'category');
    }
    
    public function instructed()
    {
        return $this->hasMany(Classes::class,  'course_id', 'id');
    }
    
    public function req_course ()
    {
        return $this->hasManyThrough(
            'Vanguard\Classes',
            'Vanguard\CourseCompletions',
            'course_id',
            'course_id',
            'id',
            'id'
            );
    }
}
