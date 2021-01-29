<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ClassRoomQuizQuestions extends Model
{
    public function answers ()
    {
        return $this->hasMany(ClassRoomQuizAnswer::class, 'question_id');
    }
}
