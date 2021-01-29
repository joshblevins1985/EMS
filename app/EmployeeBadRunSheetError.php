<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeBadRunSheetError extends Model
{
    protected $fillable = ['brs_id', 'error_id', 'note'];
    
    public function pcr (){
        return $this->belongsTo(BadRunSheet::class, 'brs_id');
    }
}
