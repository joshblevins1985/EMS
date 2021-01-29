<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class FieldTrainingDates extends Model
{
    public function fto()
    {
    
        return $this->belongsTo(Employee::class, 'training_officer', 'user_id');
    }
    
     public function trainee()
    {
    
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
  
}
