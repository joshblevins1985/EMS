<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Vanguard\DriverHistoryTracking;
use Vanguard\Employee;
use Vanguard\User;

use PDF;

class SendDriverHistory extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        //GET TOMORROWS DATE AND DATE FROM 8 DAYS AGO
        $to = date('Y-m-d', strtotime('+1 days'));
        $from = date('Y-m-d', strtotime('-8 days'));
        
        $nd = DriverHistoryTracking::whereBetween('created_at', [$from, $to])->where('new_value', 99)->whereHas('employees', function ($q) {$q->where('driver', 1);})->groupBy('employee')->get();
        $e = Employee::where('status', 5)->get();

        view()->share('nd', $nd);
        view()->share('e', $e);
        
        $pdf = PDF::loadView('reports.driver_status', compact('nd', 'e'));
        
        
        return $this->view('emails.training.driverhistory')->subject('Weekly Employee Status Report')->attachData($pdf->output(), 'weeklyemployee.pdf');
    }
}
