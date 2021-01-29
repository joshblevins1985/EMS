<?php

namespace Vanguard\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UnitDispatched
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $status;
    public $unit;
    public $message;
    public $iid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($status, $unit, $message, $iid)
    {
        $this->status = $status; 
        $this->unit = $unit;
        $this->message = $message;
        $this->iid = $iid;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
