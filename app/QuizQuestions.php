<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class QuizQuestions extends Model
{
    public function answeres()
    {
        return $this->hasMany(QuizQuestionAnsweres::class, 'question_id', 'id');
    }
}
