<?php

namespace Vanguard;



class EmployeeEncounters extends Model
{
    public function Employee()
    {
        return $this->belongsTo(Employee::class, 'user_id', 'user_id');
    }
    
    public function Policies()
    {
        return $this->hasOne(Policies::class, 'id', 'policy');
    }
    
    public function EncounterAttachment()
    {
        return $this->hasMany(EncounterAttachment::class, 'pid', 'id');
    }
    
    public function EncounterNote()
    {
        return $this->hasMany(EncounterNote::class, 'pid', 'id');
    }
    
    public function EncounterReport()
    {
        return $this->hasMany(IncidentReports::class, 'incident_id', 'id');
    }
    
    public function company()
    {
        return $this->belongsTo(Companies::class, 'company_id', 'id');
    }
}
