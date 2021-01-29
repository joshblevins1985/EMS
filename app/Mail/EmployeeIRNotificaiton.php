<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmployeeIRNotificaiton extends Mailable
{
    use Queueable, SerializesModels;

    public $encounter;
    public $employee;
    public $notification;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($encounter, $employee, $notification)
    {
        $this->encounter = $encounter;
        $this->employee = $employee;
        $this->notification = $notification;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.compliance.incidentreportnotification')->with(array('encounter' => $this->encounter, 'employee' => $this->employee, 'notification' => $this->notification));
    }
}
