<?php

namespace Vanguard;


class IncidentReports extends Model
{
    public function Employee()
    {
       return $this->belongsTo(Employee::class, 'added_by', 'id');
    }
}
