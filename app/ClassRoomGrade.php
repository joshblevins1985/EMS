<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ClassRoomGrade extends Model
{
    public function userGrades()
    {
        return $this->hasMany(ClassRoomStudentGrade::class, 'gradeBookId');
    }

    public function userHighGrade($user)
    {
       // return $this->where('user_id', $user);

        return $this->hasOne(ClassRoomStudentGrade::class, 'gradeBookId')->where('user_id', $user)->orderBy('grade','desc');
    }

}
