<?php

namespace Vanguard\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

use Vanguard\ClassroomTopicTracking;

class ClassRoomSectionViewedListener
{
    
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $checkComplete = ClassroomTopicTracking::where('user_id', auth()->user()->id)->where('topic_id', $event->topic->id)->first();
        
        if(!$checkComplete){
        $trackingUpdate = new ClassroomTopicTracking;
        
        $trackingUpdate->topic_id = $event->topic->id;
        $trackingUpdate->user_id = auth()->user()->id;
        $trackingUpdate->completed = Carbon::now()->toDateTimeString();
        $trackingUpdate->classroom_id = $event->topic->classroom_id;
        
        $trackingUpdate->save();
        }
    }
}
