<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use PDF;
use Vanguard\FinancialAssistance;

class AdminNewFinancialRequest extends Mailable
{
    use Queueable, SerializesModels;
    
    public $signature;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($signature)
    {
        $this->signature = $signature;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $signature = $this->signature;

        $record = FinancialAssistance::find($signature->id);

        $totalAmount = $record->pmt_plan;
        $totalDays = 26;
        $range = range(1, $totalDays);
        $parts =array_sum($range);
        $perPart = $totalAmount / $totalDays;

        $results = [];
        foreach (array_reverse($range) as $index => $day) {
            $results[$index + 1] = round($day * $perPart, 2, PHP_ROUND_HALF_UP);
        }

        view()->share('record',$record);
        view()->share('results',$results);
        view()->share('perPart',$perPart);

       
       // $pdf = PDF::loadView('emails.admin.NewFinancialAssistanceRequestAdmin', compact('record', 'results', 'perPart'));
    	
      //  $file = 'financial_assistance_agreement'.$record->employee->first_name.'_'.$record->employee->last_name.'_invoice.pdf';

        return $this->view('emails.admin.NewFinancialAssistanceRequestAdminEmail', compact('signature'))->subject('Employee Requested Financial Assistance');
    }
}
