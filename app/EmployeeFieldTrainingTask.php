<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeFieldTrainingTask extends Model
{
    public function fieldOfficer()
    {
        return $this->hasOne(Employee::class,  'user_id', 'fto_user_id');
    }
    public function trainee()
    {

        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
}
