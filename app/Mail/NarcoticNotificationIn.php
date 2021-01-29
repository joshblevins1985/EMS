<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NarcoticNotificationIn extends Mailable
{
    use Queueable, SerializesModels;
    
    public $narcoticbox;
    public $box;
    public $employeeout;
    public $employeein;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($narcoticbox, $box, $employeeout, $employeein)
    {
        $this->narcoticbox = $narcoticbox;
        $this->box = $box;
        $this->employeeout= $employeeout;
        $this->employeein = $employeein;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.narcotics.notificationin')->with(array('narcoticbox' => $this->narcoticbox, 'employeeout' => $this->employeeout, 'box' => $this->box, 'employeein' => $this->employeein));
    }
}
