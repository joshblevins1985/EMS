<?php

namespace Vanguard\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class eventTrigger implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public $unit;
    
    public $message;
    
    public $url;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($unit)
    {
        $this->unit = $unit;
        $this->message = "The garage has marked repairs completed on unit number {$unit}";
        $this->url = "https://peasi.app";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['repair-complete'];
    }
}
