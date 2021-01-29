<?php

namespace Vanguard\Console\Commands;
use Vanguard\Employee;

use Carbon;
use Illuminate\Console\Command;

class DriverStatusUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'driver:status_update';

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
        ->whereDate('driver_step', Carbon::today())->get();
        
        foreach($employees as $e){
            
            if($e->driver == 2){
                $u = Employee::find($e->id);
                
                $u->driver = 3;
                $u->driver_step = Carbon::today()->addDays(30);
                
                $u->save();
            }elseif($e->driver == 3){
                $u = Employee::find($e->id);
                
                $u->driver = 4;
                $u->driver_step = Carbon::today()->addDays(30);
                
                $u->save();
            }elseif($e->driver == 4){
                $u = Employee::find($e->id);
                $u->driver_step = Carbon::today()->MODIFY('+6 months');
                
                $u->driver = 1;
                
                $u->save();
            }elseif($e->driver == 5){
                $u = Employee::find($e->id);
                
                $u->driver = 1;
                $u->driver_step = Carbon::today()->MODIFY('+6 months');
                
                $u->save();
            }
            
        }
    }
}
