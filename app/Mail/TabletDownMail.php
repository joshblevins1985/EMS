<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TabletDownMail extends Mailable
{
    use Queueable, SerializesModels;

    public $station;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($station)
    {
        
        $this->station = $station;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.it.tabletstatusmail')->with(array('station' => $this->station));
    }
}
