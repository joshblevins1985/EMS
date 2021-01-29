<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class ClassroomTopicTracking extends Model
{
    public function topic()
    {
        return $this->belongsTo(ClassRoomSectionTopic::class, 'topic_id');
    }
}
