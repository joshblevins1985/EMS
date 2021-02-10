<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public function employees()
    {
       return  $this->hasMany(Employee::class, 'primary_station', 'id');
    }
    
    public function NarcoticBox()
    {
        return $this->hasMany(NarcoticBoxes::class, 'station', 'id');
    }
    
    public function Regional()
    {
        return $this->hasOne(Employee::class, 'user_id', 'regional_manager');
    }
    
    public function mgr()
    {
        return $this->hasOne(Employee::class, 'user_id', 'manager');
    }

    public function brs()
    {
        return $this->hasMany(BadRunSheet::class, 'station')->where('status', '<', 5);
    }
}
