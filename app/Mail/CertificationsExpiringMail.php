<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Database\Eloquent\Collection;

class CertificationsExpiringMail extends Mailable
{
    use Queueable, SerializesModels;
    public $expiring;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $expiring)
    {
        $this->expiring = $expiring;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.certifications.expiring')->with(compact('expiring'));
    }
}
