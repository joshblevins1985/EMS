<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class BucyrusIncidents extends Model
{
    public function call_type ()
    {
        return $this->hasOne(IncidentType::class, 'id', 'incident_call_type');
    }
    
    public function twp ()
    {
        return $this->hasOne(BucyrusTownship::class, 'id', 'township');
    }
    
    public function crew ()
    {
        return $this->hasMany(BucyrusIncidentCrew::class, 'incident_id');
    }
    
    public function facility ()
    {
        return $this->hasOne(Facilities::class, 'id', 'txp_facility');
    }
}
