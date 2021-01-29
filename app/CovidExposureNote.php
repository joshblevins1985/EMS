<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class CovidExposureNote extends Model
{
    protected $guarded = [''];

    public function employee (){
        return $this->belongsTo(Employee::class, 'added_by', 'user_id');
    }
}
