<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeRunError extends Model
{
    protected $table = 'employee_run_sheet_errors';

    public $timestamps = true;
    
    public function RunError (){
        return $this->hasOne(RunErrors::class, 'id', 'error');
    }
    
    public function Employee (){
        return $this->belongsTo(Employee::class, 'user_id');
    }
    
}
