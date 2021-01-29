<?php

namespace Vanguard;



class Companies extends Model
{
    protected $table = 'companies';

    public $timestamps = true;
    
    public function users()
    {
        return $this->hasMany(User::class);
        
        
    }
    
    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id');
        
        
    }
}
