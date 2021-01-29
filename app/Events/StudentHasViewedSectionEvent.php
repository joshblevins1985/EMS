<?php

namespace Vanguard\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class StudentHasViewedSectionEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $topic;
    
    //public $course;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($topic)
    {
        $this->topic = $topic;
        //$this->course = $course;
    }
}
