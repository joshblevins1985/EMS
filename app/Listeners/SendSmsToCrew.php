<?php

namespace Vanguard\Listeners;

use Vanguard\Events\UnitSignOn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Tzsk\Sms\Facade\Sms;

class SendSmsToCrew
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UnitSignOn  $event
     * @return void
     */
    public function handle(UnitSignOn $event)
    {
       
        Sms::send("Your status has been updated to $event->message")->to(['17408215531'])->dispatch();
    }
}
