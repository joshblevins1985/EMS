<?php
namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;

use Vanguard\StateCertifications;
use Vanguard\Employee;
use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\CertificationsExpiringMail;

class CertificationsExpiring extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
     protected $dispcription = 'Send eamil to users with expiring certifications';
    protected $signature = 'Certifications:Expiring';

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
        $employees = Employee::where('status', 5)->where('user_id', '450')->get();
        
        foreach ($employees as $row){
            $now = date('Y-m-d', strtotime('now'));
        $day30 = strtotime('now + 30 days');
        $day60 = date('Y-m-d', strtotime('now + 60 days'));
            $expiring = StateCertifications::where('user_id', $row->user_id)->whereBetween('expiration', array($now,$day60))->get();
            
            if(!$expiring){
                
            }else{
                
                Mail::to('jblevins@peasi.net')->send(new CertificationsExpiringMail($expiring));
            }
            
        }

        
    }
}
