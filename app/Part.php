<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    public function part()
    {
        return $this->hasOne(AvailablePart::class, 'id', 'pid');
    }
}
