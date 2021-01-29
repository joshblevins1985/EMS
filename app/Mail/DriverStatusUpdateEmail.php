<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class DriverStatusUpdateEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $employees;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employees)
    {
        $this->employees = $employees;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.hr.driverupdateemail')->with(array('eployees' => $this->employees));
    }
}
