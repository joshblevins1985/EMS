<?php

namespace Vanguard;



class BadRunSheet extends Model
{
    protected $table= 'badrunsheets';
    
    public $timestamps = true;
    
    public function employees()
    {
        return $this->hasMany(BadRunSheetEmployee::class, 'bad_run_sheet_id');
    }
    
    public function Audit()
    {
        return $this->hasMany(RunSheetTracking::class, 'pid');
    }
    
    public function pcr()
    {
        return $this->hasMany(PcrUpload::class, 'pid');
    }
    
    public function problems (){
        return $this->hasMany(EmployeeBadRunSheetError::class, 'brs_id' );
    }
}
