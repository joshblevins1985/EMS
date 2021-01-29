<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Vanguard\Employee;
use Vanguard\Classes;
use Vanguard\EnrolledStudent;

class CoursesEnroll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $dispcription = 'Add Required Courses to employees';
    protected $signature = 'courses:enroll';

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
        $class = Classes::where('required', '1')->get();

            $employees = Employee::where('user_id', 450)->get();

            foreach ($class as $row_class) {

                foreach ($employees as $row_employee) {
                    $class_level = explode(',', $row_class->level);
                    if (in_array($row_employee->primary_position, $class_level)) {
                        
                        $enrolled = EnrolledStudent::where('class_id', $row_class->id)->where('user_id', $row_employee->user_id)->get();
                        
                        if(count($enrolled)){
                           
                        }else{
                             $enroll = new EnrolledStudent;
                        
                        $enroll->class_id = $row_class->id;
                        $enroll->user_id = $row_employee->user_id;
                        $enroll->status = 0;
                        
                        $enroll->save();
                        }
                        
                    } else {
                        //Do nothing //
                    }
                }
            }
    }
}
