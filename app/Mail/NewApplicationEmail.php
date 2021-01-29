<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Vanguard\Employee;

use PDF;

class NewApplicationEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $employee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employee)
    {
        //dd($employee);
        $this->employee = $employee;
        
        //dd($employee);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
         $employees = Employee::where('user_id', $this->employee->user_id)->first();
         
         view()->share('employees',$employees);
       
            $pdf = PDF::loadView('employee.reports.application', compact('employees'))->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);
        	
            $file = $this->employee->last_name.'_'.$this->employee->first_name.'_application.pdf';
        
        return $this->view('emails.applications.new')->subject('New Employment Application')->attachData($pdf->output(), $file)->with( array('employee' => $this->employee));
        
        
    }
}
