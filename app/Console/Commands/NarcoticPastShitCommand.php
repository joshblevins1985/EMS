<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;
use Vanguard\NarcoticLog;

use Twilio;

class NarcoticPastShitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
    protected $signature = 'Narcotic:PastShift';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Narcotic notification if greater than end of shift';

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
        $search_date = (date('Y-m-d H:i:s', strtotime('now - 24 hours')));
        $log = NarcoticLog::whereDate('time_out', '>', $search_date)->get();
        
        foreach ($log as $row){
            
            $account_id = 'AC18e31a0e6ed7c29b26ab840feca8a3ea';
            $auth_token = 'a8f2abef873bd9eb93d32cfec6d4ee8e';
            $from_phone_number = '+17403077102'; // phone number you've chosen from Twilio
            $twilio = new Twilio($account_id, $auth_token, $from_phone_number);
            
            $to_phone_number = '+17408215531'; // who are you sending to?
            $twilio->message($to_phone_number, 'Pink Elephants and Happy Rainbows');
        }
    }
}
