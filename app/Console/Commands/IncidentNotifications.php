<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Vanguard\DispatchIncident;

class IncidentNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'incident:notification';

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
        $incidents= DispatchIncident::where('status', '<', 4)->get();
        
        foreach($incidents as $row)
        {
            //Check if incident will be late....
            if($row->status == 0){
                if($row->plate > 0){
                    
                }else{
                   $time = time() + $row->travel;
                    $pu = strtotime($row->pick_up);
                    
                    if($pu < $time){
                        $update = DispatchIncident::find($row->id);
                        
                        $update->plate = 1;
                        $update->save();
                    } 
                }
                    
            }elseif($row->status == 1){
                
            }elseif($row->status == 2){
                
            }elseif($row->status == 3){
                
            }
        }
    }
}
