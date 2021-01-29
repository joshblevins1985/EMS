<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class StudentAnsweres extends Model
{
    protected $table = 'student_quiz_answeres';
    
    protected $fillable = ['student', 'question_id', 'answered', 'grade', 'course_id'];
    
}
