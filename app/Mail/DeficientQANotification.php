<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeficientQANotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $qa;
    
    public $deficiencies;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($qa, $deficiencies)
    {
        $this->qa = $qa;
        
        $this->deficiencies = $deficiencies;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.qa.deficientqanotification')->with(array('qa' => $this->qa, 'deficiencies' => $this->deficiencies));
    }
}
