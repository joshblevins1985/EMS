<?php

namespace Vanguard\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Vanguard\CprClasses;

use PDF;

class CPRInvoiceMailNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    
    public $cid;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cid)
    {
        $this->cid = $cid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        $cpr = CprClasses::find($this->cid);
        
        view()->share('cpr',$cpr);
       
        $pdf = PDF::loadView('cpr.invoicepdf', compact('cpr'))->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);
    	
        $file = 'cpr_class_'.$cpr->id.'_invoice.pdf';
        
        return $this->view('emails.training.cprinvoice')->subject('CPR Class Invoice')->attachData($pdf->output(), $file);
    }
}
