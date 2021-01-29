<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class EmployeeAbcCertification extends Model
{
    protected $fillable = ['user_id', 'certification_type','ecpiration','status', 'certification_number'];
}
