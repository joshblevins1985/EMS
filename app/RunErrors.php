<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class RunErrors extends Model
{
    protected $table = 'run_sheet_errors';

    public $timestamps = true;
    
    public function EmployeeError (){
        return $this->belongsTo('EmployeeRunError::class','error', 'id');
    }
    
}
