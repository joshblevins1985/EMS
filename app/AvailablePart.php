<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class AvailablePart extends Model
{
    protected $guarded = [];
    
    public function part ()
    {
        return $this->hasMany(Part::class, 'pid', 'id');
    }
}
