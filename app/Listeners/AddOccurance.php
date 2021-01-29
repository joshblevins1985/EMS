<?php

namespace Vanguard\Listeners;

use Vanguard\Events\ClockIn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddOccurance
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
     * @param  ClockIn  $event
     * @return void
     */
    public function handle(ClockIn $event)
    {
        var_dump($event->clockin['first_name'].'was clocked in');
    }
}
