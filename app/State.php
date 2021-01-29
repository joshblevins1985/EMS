<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';

    public function cert_types ()
    {
        return $this->hasMany(CertificateType::class, 'state', 'id');
    }
}
