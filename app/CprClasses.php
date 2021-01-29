<?php

namespace Vanguard;



class CprClasses extends Model
{
    public function facility()
    {
        return $this->belongsTo(Facilities::class, 'location');
    }
    public function students()
    {
        return $this->hasMany(CprClassStudent::class, 'class_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Employee::class, 'instructor', 'user_id');
    }
}
