<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BadRunSheetNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $pcr;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pcr)
    {
        $this->pcr = $pcr;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.billing.badrunsheet')->with(array('pcr' => $this->pcr));
    }
}
