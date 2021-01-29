<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Vanguard\QaQi;

use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\CertificationsExpiringMail;

class UnreadQa extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'qa:unread';

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
        
        $qa = QaQi::with('employee')->whereNull('acknowledged')->groupBy('employee_id')->get();
        
        $qaarray = $qa->toArray();
        
        foreach($qa as $row){
           Mail::send('emails.qa.unread', $qaarray, function($message) use($row)
            {
               $message->to($row->employee->email)->subject(' Unread QA Reports');
               
            }); 
            
        }
        
        
    }
}
