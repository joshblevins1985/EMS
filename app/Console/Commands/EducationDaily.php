<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\SendEducationDaily;

use Vanguard\CprClasses;
use Vanguard\ToDo;
use Vanguard\CourseDates;

use PDF;

class EducationDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'education:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily email to all education for tasks/courses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $start = date('Y-m-d H:i:s', strtotime('now'));
        
        //dd($start);
        
        $end = date('Y-m-d H:i:s', strtotime($start. '+ 30 days'));
        
        
        $cpr = CprClasses::with('facility')->whereBetween('start_date', array($start, $end))->orderBy('start_date')->get();
        
        $ceu = CourseDates::with('instruct', 'class_dates.course' )->whereBetween('course_date', array($start, $end))->orderBy('course_date')->get();
        
        $todo = ToDo::with('employee')->where('department', 1)->where('status','<', 4)->orderBy('expected_complete')->get();
        
        view()->share('cpr', $cpr);
        view()->share('todo', $todo);
        view()->share('ceu', $ceu);
        
        $pdf = PDF::loadView('education.reports.education_daily', compact('cpr', 'todo', 'ceu'))->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);
    	
        $file = 'education_'.date('m-d-Y').'.pdf';
        
        $cpr = CprClasses::with('facility')->whereBetween('start_date', array($start, $end))->orderBy('start_date')->get()->toArray();
        
        Mail::send('emails.training.daily', $cpr,  function($message) use($pdf, $file)
        {
           $message->to([ 'jblevins@peasi.net', 'bchapman@peasi.net', 'astone@peasi.net'])->subject('Daily Education Dept Report');
           
           $message->attachData($pdf->output(), $file);
        });
    }
}
