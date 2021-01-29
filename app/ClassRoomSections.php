<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ClassRoomSections extends Model
{
    public function topics ()
    {
        return $this->hasMany(ClassRoomSectionTopic::class, 'section_id');
    }
    
    public function course ()
    {
        return $this->belongsTo(ClassRoom::class, 'classroom_id');
    }
}
