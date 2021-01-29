<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class UnitLog extends Model
{
    public function incident()
    {
        return $this->belongsTo(DispatchIncident::class, 'incident_id', 'id');
    }
    
    public function status_label()
    {
        return $this->belongsTo(UnitStatus::class, 'status', 'id');
    }
}
