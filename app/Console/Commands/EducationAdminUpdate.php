<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\DailyAdminMial;

use Vanguard\ToDo;
use Vanguard\CprClasses;
use Vanguard\CourseDates;
use Vanguard\EmployeeEncounters;

use Carbon;

class EducationAdminUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'education:admin_update';

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
        $timestamp = time();
        
        if(date('N', $timestamp) === '1')
        {
            $end = date('Y-m-d H:i:s', strtotime('now'));
        
            //dd($start);
            
            $start = date('Y-m-d H:i:s', strtotime($end. '- 2 days'));
            $task = ToDo::whereBetween('completed', array($start, $end))->where('department', 1)->orWhere('assigned_to', 450)->whereBetween('completed', array($start, $end))->get();
            
            $taskp = ToDo::where('status', 2)->where('department', 1)->orWhere('assigned_to', 450)->where('status', 2)->get();
            
            $cpr = CprClasses::with('facility')->whereBetween('start_date', array($start, $end))->orderBy('start_date')->get();
        
            $ceu = CourseDates::with('instruct', 'class_dates.course' )->whereBetween('course_date', array($start, $end))->orderBy('course_date')->get();
            
            $todo = ToDo::with('employee')->where('department', 1)->where('status','<', 4)->orderBy('expected_complete')->get();
            
            $encounter= EmployeeEncounters::whereBetween('created_at', array($start, $end))->get();

            $projects = [];
            
            
        }else{
            $task = ToDo::whereDate('completed', Carbon::today())->where('department', 1)->orWhere('assigned_to', 450)->whereDate('completed', Carbon::today())->get();
            
            $taskp = ToDo::where('status', 2)->where('department', 1)->orWhere('assigned_to', 450)->where('status', 2)->get();
            
            $cpr = CprClasses::whereDate('start_date', Carbon::today())->get();
            
            $ceu = CourseDates::with('instruct', 'class_dates', 'class_dates.course')->whereDate('course_date', Carbon::today())->get();
            
            $encounter= EmployeeEncounters::whereDate('created_at', Carbon::today())->where('department', 2)->get();

            $projects = [];
            
            
        }
        

        
        Mail::to(['blevins.josh@gmail.com','jblevins@peasi.net','madkins2@peasi.net', 'madkins@peasi.net', 'tadkins@peasi.net', 'restep@peasi.net', 'bestep@peasi.net' ])->send(new DailyAdminMial($task, $taskp, $cpr, $ceu, $encounter, $projects));
        
        
    }
}
