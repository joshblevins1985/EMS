<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use PDF;

class MaintenanceCompleteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $task = $this->task;
       
        
        view()->share('task',$task);
       
        $pdf = PDF::loadView('mechanic.reports.maintenanceReport', compact('task'))->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);
    	
        $file = 'repair_'.$task->id.'_report.pdf';
        
        return $this->view('emails.maintenance.maintenanceComplete')->subject('Vehicle Repair Completed')->attachData($pdf->output(), $file);
    }
}
