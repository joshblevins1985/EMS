<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ClassroomQuiz extends Model
{
    public function question ()
    {
        return $this->hasOne(ClassRoomQuizQuestions::class, 'quiz_id');
    }
    
    public function attempts ()
    {
        return $this->hasMany(ClassRoomQuizAttempt::class, 'quiz_id');
    }
}
