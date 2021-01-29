<?php

namespace Vanguard;



class EncounterAttachment extends Model
{
    public function EmployeeEncounters()
    {
        return $this->belongsTo(EmployeeEncounters::class, 'pid', 'id');
    }
}
