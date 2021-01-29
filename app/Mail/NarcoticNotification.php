<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NarcoticNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $narcoticbox;
    public $box;
    public $employeeout;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->narcoticbox = $narcoticbox;
        $this->box = $box;
        $this->employeeout= $employeeout;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.narcotics.wrongsignin')->with(array('narcoticbox' => $this->narcoticbox, 'employeeout' => $this->employeeout, 'box' => $this->box));
    }
}
