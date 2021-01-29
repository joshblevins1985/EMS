<?php

namespace Vanguard;



class EncounterNote extends Model
{
    protected $table = 'encounter_notes';

    public $timestamps = true;
    
    public function EmployeeEncounter()
    {
        return $this->belongsTo(EmployeeEncounters::class, 'pid', 'id');
    }
}
