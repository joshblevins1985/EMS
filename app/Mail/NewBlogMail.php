<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class NewBlogMail extends Mailable
{
    use Queueable, SerializesModels;

    public $row;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($row)
    {
        $this->row = $row; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->row->file)
        {
            $file = storage_path('/app/'.$this->row['file']);
            return $this->view('emails.training.blog')->with(array('row' => $this->row))
                ->subject($this->row['title'])
                ->from('noreply@peasi.net', 'PEASI PORTAL')
                ->attach( $file );
        }else{
            return $this->view('emails.training.blog')->with(array('row' => $this->row))

                ->from('noreply@peasi.net', 'PEASI PORTAL')
                ->subject($this->row['title']);
        }

    }
}
