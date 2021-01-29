<?php

namespace Vanguard\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Vanguard\Events\UnitSignOn;
use Vanguard\UnitLog;

use Auth;

class UpdateUnitLog
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $u = new UnitLog;
        $u->status = $event->status;
        $u->unit = $event->unit->id;
        $u->incident_id = $event->iid;
        $u->user_id = Auth::User()->id;
        $u->save();
    }
}
