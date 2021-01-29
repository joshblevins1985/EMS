<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewEncounter extends Mailable
{
    use Queueable, SerializesModels;
    
    public $notification;
    public $employee;
    
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($notification, $employee)
    {
        $this->notification = $notification;
        $this->employee = $employee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.compliance.NewEncounterNotification')->with(array('notification' => $this->notification, 'employee' => $this->employee));
    }
}
