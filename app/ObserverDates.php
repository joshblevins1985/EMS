<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ObserverDates extends Model
{
    public function observer()
    {
        return $this->belongsTo(Observer::class, 'observer_id');
    }
    
    public function preceptors()
    {
        return $this->belongsTo(Employee::class, 'preceptor');
    }
}
