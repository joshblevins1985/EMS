<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Vanguard\ScholarshipOppurtunities;

class ScholarshipAcceptancemail extends Mailable
{
    use Queueable, SerializesModels;
 public $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $class = ScholarshipOppurtunities::find($this->id);
        
        return $this->view('emails.scholarship.acceptance')->with(array('class' => $class));
    }
}
