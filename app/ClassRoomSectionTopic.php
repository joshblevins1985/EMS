<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ClassRoomSectionTopic extends Model
{
    public function tracking ()
    {
        return $this->hasMany(ClassroomTopicTracking::class, 'topic_id');
    }
    
    public function section ()
    {
        return $this->belongsTo(ClassRoomSections::class, 'section_id');
    }
}
