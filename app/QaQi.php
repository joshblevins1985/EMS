<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class QaQi extends Model
{
    protected $table = 'qaqi';

    public $timestamps = true;
    
    public function protocols ()
    {
        return $this->belongsTo(Protocols::class, 'protocol');
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'user_id');
    }
    
    public function addedby()
    {
        return $this->belongsTo(Employee::class, 'added_by', 'user_id');
    }
    
    public function deficiencies()
    {
        return $this->hasMany(QaDefficiencies::class, 'pid');
    }
    
}
