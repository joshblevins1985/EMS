<?php

namespace Vanguard;



class EnrolledStudent extends Model
{
    public function student()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
    
    public function instructed()
    {
        return $this->belongsTo(Classes::class, 'class_id', 'id');
    }
    
  
   
}
