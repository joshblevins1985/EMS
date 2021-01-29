<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use PDF;
use Illuminate\Support\Facades\Mail;


use Vanguard\DriverHistoryTracking;
use Vanguard\Employee;
use Vanguard\User;

use Vanguard\Mail\SendDriverHistory;
use Vanguard\Notifications\DriverNotification;



class DriversNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification.drivers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Weekly notification of employee status with training';

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
        
      
        
        $users = User::whereHas(
            'roles', function($q) {
            $q->where('name', 'company.admin1');
            $q->orWhere('name', 'manager');
            $q->orWhere('name', 'company.admin');
            $q->orWhere('name', 'company.scheduling');
        }
        )->get()->toArray();
        
        
        Mail::to($users)->send(new SendDriverHistory());
        
        //Send out user notification
        foreach ($users as $row)
        {
            User::find($row['id'])->notify(new DriverNotification());
        }
        
     }
}
