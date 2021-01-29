<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    public function sections()
    {
        return $this->hasMany(ClassRoomSections::class, 'classroom_id')->orderBy('section_order');
    }

    public function gradeBook ()
    {
        return $this->hasMany(ClassRoomGrade::class, 'classroom_id');
    }
    
    public function students ()
    {
        return $this->hasMany(ClassRoomEnrolledStudent::class, 'classroom_id')->orderBy('temp_name');
    }
    
    public function studentGrades ()
    {
        return $this->hasMany(ClassRoomStudentGrade::class, 'classroom_id');
    }
    
    public function instructors ()
    {
        return $this->hasMany(ClassRoomInstructor::class, 'classroom_id');
    }
    
    public function documents ()
    {
        return $this->hasMany(ClassRoomDocuments::class, 'classroom_id');
    }
    
    public function schedule ()
    {
        return $this->hasMany(ClassRoomSchedule::class, 'classroom_id');
    }
}
