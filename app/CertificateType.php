<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class CertificateType extends Model
{
    public function states ()

    {
        return $this->belongsTo(State::class, 'state', 'id');
    }
}
