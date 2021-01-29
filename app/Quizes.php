<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Quizes extends Model
{
    public function questions()
    {
        return $this->hasMany(QuizQuestions::class, 'quiz_id', 'id');
    }
}
