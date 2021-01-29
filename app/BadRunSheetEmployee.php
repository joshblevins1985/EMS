<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class BadRunSheetEmployee extends Model
{
    public function employee(){
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
    
    public function pcr (){
        return $this->belongsTo(BadRunSheet::class, 'bad_run_sheet_id');
    }
}
