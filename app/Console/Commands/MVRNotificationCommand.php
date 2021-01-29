<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;
use Carbon;
use Vanguard\Employee;
use Vanguard\User;

use Vanguard\Notifications\MVRNotification;

class MVRNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mvr:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies human resources to rerun employees Motor Vehicle Reports.';

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
        $employee = Employee::where('status', 5)->whereDate('dod', Carbon::today())->get();
        
        $users = User::whereHas(
            'roles', function($q) {
            $q->where('name', 'company.scheduling');
            $q->orWhere('name', 'company.humanresource');
            $q->orWhere('name', 'company.admin1');

        }
        )->get()->toArray();
        
        foreach ($employee as $e)
        {
            $message= "The motor vehicle report for $e->first_name $e->last_name employee id E-$e->eid has expired. Please rerun the motor vehicle report through the insurance carrier and update the driver risk assessment.";
            
            foreach ($users as $row)
            {
                User::find($row['id'])->notify(new MVRNotification($message, $e));
            }
        }
        
            
   
    }
}
