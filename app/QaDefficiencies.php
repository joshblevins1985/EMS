<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class QaDefficiencies extends Model
{
    
     protected $table = 'qa_deficiencies';

    public $timestamps = true;
    
    protected $fillable = ['pid'];
}
