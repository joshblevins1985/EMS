<?php

namespace Vanguard;



class BoxNotes extends Model
{
    public function Employees ()
    {
        return $this->belongsTo(Employee::class, 'added_by', 'id');
    }
}
