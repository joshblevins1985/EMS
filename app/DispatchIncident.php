<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class DispatchIncident extends Model
{
    use Filterable;
    
    protected $guarded = [];

    public function alerts ()
    {
        return $this->hasMany(DispatchAlerts::class, 'incident_id');
    }
    
    public function stat()
    {
        return $this->belongsTo(IncidentStatus::class, 'status', 'id');
    }
    
    public function aunit()
    {
        return $this->hasManyThrough(Units::class, UnitSchedule::class, 'unit', 'id', 'unit');
    }
    
    public function type()
    {
        return $this->belongsTo(IncidentType::class, 'incident_type','id');
    }
    
    public function logs()
    {
        return $this->hasMany(IncidentLog::class, 'incident_id', 'id');
    }
    
    public function mark()
    {
        return $this->hasOne(IncidentTimes::class, 'incident_id', 'id');
    }
    public function notes()
    {
        return $this->hasMany(IncidentNote::class, 'pid', 'id');
    }
    
    public function pick_up_facility()
    {
        return $this->belongsTo(Facilities::class, 'facility');
    }
    
    public function drop_off_facility()
    {
        return $this->belongsTo(Facilities::class, 'desitination_facility_id');
    }
    public function times()
    {
        return $this->hasOne(IncidentTimes::class, 'incident_id', 'id');
    }
    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id');
    }
    
}
