<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Vanguard\Station;
use Vanguard\NarcoticClientConnection;
use Vanguard\User;

use Mail;
use Vanguard\Mail\TabletDownMail;

class TabletStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tablet:status';

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
        $tablets = Station::get();
        
        foreach($tablets as $row)
        {
            $tab_time = strtotime($row->nc_last_connection);
            $comparetime = strtotime('- 2 minutes');
            
            if($comparetime > $tab_time)
            {
                if($row->nc_status == 1){
                    $tabupdate = Station::find($row->id);
                
                    $tabupdate->nc_status = 0;
                    $tabupdate->save();
                    
                    $manager= $row->regional_manager;
                    
                    $users = User::whereHas(
                    'roles', function($q)use($manager){
                        $q->where('name', 'company.admin1');
                        $q->orWhere('name', 'logistics');
                        //$q->orWhere('name', 'company.admin');
                       // $q->orWhere('name', 'company.infotech');
                        $q->orWhere('user_id', $manager);
                        
                    }
                    )->get()->toArray();
                    
                    $station = Station::find($row->id)->toArray();
                    
                    Mail::to($users)->send(new TabletDownMail($station));
                }

                $last_entry = NarcoticClientConnection::where('pid', $row->id)->orderBy('created_at', 'desc')->first();
                
                if($row->nc_status == 0){
                    if($last_entry){
                        $last_time = strtotime($last_entry->created_at);
                        
                        if($last_time < $tab_time){
                            $new_entry = new NarcoticClientConnection;
                            
                            $new_entry->pid = $row->id;
                            
                            $new_entry->save();
                        }else{
                            
                        }
                    }else{
                        $new_entry = new NarcoticClientConnection;
                            
                            $new_entry->pid = $row->id;
                            
                            $new_entry->save();
                    }
                }
                    
            }
         
        }
    }
}
