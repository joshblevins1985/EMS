<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GoodQANotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $qa;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qa)
    {
        $this->qa = $qa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.qa.goodqanotification')->with(array('qa' => $this->qa));
    }
}
