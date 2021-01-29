<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Vanguard\Classes;
use Vanguard\User;

use PDF;
use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\CertificationsExpiringMail;

class DailyCourseReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'courses:dailyreport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $class = Classes::with(['students' => function($query) {
             $query->where('status', '=', 1);
             $query->whereDate('completed', '=', date('Y-m-d'));
        }])->get();
        
        view()->share('class',$class);
        
        $pdf = PDF::loadView('classes.reports.dailycompleted', $class);
        
        $classes = Classes::with(['students' => function($query) {
             $query->where('status', '=', 1);
             $query->whereDate('completed', '=', date('Y-m-d'));
        }])->get()->toArray();
        
        
        Mail::send('emails.dailyclasses', $classes, function($message) use($pdf)
        {
           $message->to(['aevans@peasi.net', 'jblevins@peasi.net'])->subject('Daily Course Report');
           
           $message->attachData($pdf->output(), 'daily_class_report.pdf');
        });
    }
}
