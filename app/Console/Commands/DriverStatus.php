<?php

namespace Vanguard\Console\Commands;

use Vanguard\Employee;
use Vanguard\User;

use Mail;
use Vanguard\Mail\DriverStatusUpdateEmail;
use Carbon;

use Illuminate\Console\Command;

class DriverStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'driver:status';

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
        $employees= Employee::where('status', 5)
        ->where('driver', '>' , 3)
        ->where('driver', '<', 6)
        ->whereNull('hold_driver')
        ->whereDate('driver_step', Carbon::tomorrow())->get();
        
        if($employees){
            
            $employees->toArray();
            
            $users = User::whereHas(
                    'roles', function($q){
                        $q->where('name', 'company.admin1');


                    }
                    )->get()->toArray();
                    
            Mail::to($users)->send(new DriverStatusUpdateEmail($employees));
            
         
        }
    }
}
