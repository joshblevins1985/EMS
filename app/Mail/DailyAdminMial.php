<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DailyAdminMial extends Mailable
{
    use Queueable, SerializesModels;
    
    public $task;
    public $taskp;
    public $cpr;
    public $ceu;
    public $encounter;
    public $projects;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task, $taskp, $cpr, $ceu, $encounter, $projects)
    {
        $this->task = $task;
        $this->taskp = $taskp;
        $this->cpr = $cpr;
        $this->ceu = $ceu;
        $this->encounter = $encounter;
        $this->projects = $projects;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.training.daily_completed')->with(array('task' => $this->task,'taskp' => $this->taskp, 'cpr' => $this->cpr, 'ceu' => $this->ceu, 'encounter' => $this->encounter, 'projects' => $this->projects));
    }
}
