<?php

namespace Vanguard\Listeners;

use Vanguard\Events\UnitDispatched;
use Vanguard\schedule;
use Vanguard\Employee;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Tzsk\Sms\Facade\Sms;

class DispatchUnit
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
    public function handle(UnitDispatched $event)
    {
        $employees = schedule::where('unit', $event->unit->id)->get();
        
        foreach($employees as $row)
        {
            $employee= Employee::where('user_id', $row->user_id)->first();
            
            $phone = '1'.$employee->phone_mobile;
            
            Sms::send("$event->message")->to([$phone])->dispatch();
        }
        
        
    }
}
