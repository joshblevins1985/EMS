<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Vanguard\CprClasses;
use Vanguard\ToDo;
use Vanguard\CourseDates;

use PDF;

class SendEducationDaily extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
       
        $start = date('Y-m-d H:i:s', strtotime('now'));
        
        //dd($start);
        
        $end = date('Y-m-d H:i:s', strtotime($start. '+ 30 days'));
        
        
        $cpr = CprClasses::with('facility')->whereBetween('start_date', array($start, $end))->orderBy('start_date')->get();
        
        $ceu = CourseDates::with('instruct', 'class_dates.course' )->whereBetween('course_date', array($start, $end))->orderBy('course_date')->get();
        
        $todo = ToDo::with('employee')->where('department', 1)->where('status', 1)->orderBy('expected_complete')->get();
        
        view()->share('cpr', $cpr);
        view()->share('todo', $todo);
        view()->share('ceu', $ceu);
        
        $pdf = PDF::loadView('education.reports.education_daily', compact('cpr', 'todo', 'ceu'))->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);
    	
        $file = 'education_'.date('m-d-Y').'pdf';
        
        return $this->view('emails.training.daily')->subject('Daily Education Update')->attachData($pdf->output(), $file);
        
    }
}
