<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    public function types ()
    {
        return $this->belongsTo(CertificateType::class, 'type');
    }
    public function states ()
    {
        return $this->belongsTo(State::class, 'state');
    }

}
