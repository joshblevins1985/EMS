<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;



use Auth;
use DB;
use Carbon\Carbon;
use Vanguard\FinancialAssistance;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Mail;
use Vanguard\Mail\FinancialAssistanceRequest;
use Vanguard\Mail\AdminNewFinancialRequest;
use PDF;



class FinancialAssistanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('financial_assistance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('financial_assistance.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->start_date){
            $start_date = new DateTime($request->start_date);
            $start_date = $start_date->format('Y-m-d');
        }else{
            $start_date = NULL;
        }

        if($request->end_date){
            $end_date = new DateTime($request->end_date);
            $end_date = $end_date->format('Y-m-d');
        }else{
            $end_date = NUL;
        }

        
        
        //dd($start_date->format('Y-m-d'));

        $record = new FinancialAssistance;

        $record->user_id = Auth::user()->id;
        $record->school = $request->school;
        $record->school_contact = $request->school_contact;
        $record->other_schools = $request->other_schools;
        $record->courses = $request->courses;
        $record->start_date = $start_date;
        $record->end_date = $end_date;
        $record->cost = $request->cost;
        $record->imporove = $request->imporove;
        $record->pmt_plan = $request->requested;

        $record->save();

        $totalAmount = $record->pmt_plan;
        
        //dd($totalAmount);
        $totalDays = 26;
        $range = range(1, $totalDays);

        $parts =array_sum($range);
        $perPart = $totalAmount / $totalDays;
        //dd($parts);
        $results = [];
        foreach (array_reverse($range) as $index => $day) {
            $results[$index + 1] = round($day * $perPart, 2, PHP_ROUND_HALF_UP);
        }

        return view('financial_assistance.employee_confirmation', compact('results', 'record', 'perPart'));
    }

    public function signature(Request $request, $id)
    {
        //Find Assessment in DB//
        $signature = FinancialAssistance::find($request->assid);
       
        //Get image from ajax, encode then decode the image to store//
        $data_uri = $request->signature;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        
        //store the decoded image//
        $storagePath = Storage::put('/signatures/'.$request->assid.'_employee_financial_assistance.png', $decoded_image);
        $storagePath = Storage::put('/app/signatures/'.$request->assid.'_employee_financial_assistance.png', $decoded_image);

        //store the file in the db//
        $signature->employee_signature = 'signatures/'.$request->assid.'_employee_financial_assistance.png';
        $signature->save();



        Mail::to($signature->employee->email)->send(new FinancialAssistanceRequest($signature));
        Mail::to('jblevins@peasi.net')->send(new FinancialAssistanceRequest($signature));
        
        Mail::to(['jblevins@peasi.net', 'madkins@peasi.net', 'madkins2@peasi.net', 'restep@peasi.net', 'bestep@peasi.net', 'tadkins@peasi.net'])->send(new AdminNewFinancialRequest($signature));

    }
    
    public function signaturedoe(Request $request, $id)
    {
        //Find Assessment in DB//
        $signature = FinancialAssistance::find($request->assid);
       
        //Get image from ajax, encode then decode the image to store//
        $data_uri = $request->signature;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        
        //store the decoded image//
        $storagePath = Storage::put('/signatures/'.$request->assid.'_director_financial_assistance.png', $decoded_image);
        $storagePath = Storage::put('/app/signatures/'.$request->assid.'_director_financial_assistance.png', $decoded_image);

        //store the file in the db//
        $signature->director_signature = 'signatures/'.$request->assid.'_director_financial_assistance.png';

        $signature->save();

        $message= "Notification $signature->employee->first_name $signature->employee->last_name has requested educational financial assistance.";

       Mail::to(['jblevins@peasi.net'])->send(new AdminNewFinancialRequest($signature, $message));

    }
    
    public function signatureadmin(Request $request, $id)
    {
        //Find Assessment in DB//
        $signature = FinancialAssistance::find($request->assid);
       
        //Get image from ajax, encode then decode the image to store//
        $data_uri = $request->signature;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        
        //store the decoded image//
        $storagePath = Storage::put('/signatures/'.$request->assid.'_admin_financial_assistance.png', $decoded_image);
        $storagePath = Storage::put('/app/signatures/'.$request->assid.'_admin_financial_assistance.png', $decoded_image);

        //store the file in the db//
        $signature->admin_signature = 'signatures/'.$request->assid.'_admin_financial_assistance.png';
        $signature->admin_user_id = Auth::user()->id;
        $signature->admin_date = Carbon::now();
        $signature->save();

        $message= "Notification $signature->employee->first_name $signature->employee->last_name has requested educational financial assistance.";

        Mail::to(['jblevins@peasi.net', 'madkins@peasi.net', 'madkins2@peasi.net', 'restep@peasi.net', 'bestep@peasi.net', 'tadkins@peasi.net'])->send(new AdminNewFinancialRequest($signature, $message));

    }
    
    public function signaturesuper(Request $request, $id)
    {
        //Find Assessment in DB//
        $signature = FinancialAssistance::find($request->assid);
       
        //Get image from ajax, encode then decode the image to store//
        $data_uri = $request->signature;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        
        //store the decoded image//
        $storagePath = Storage::put('/signatures/'.$request->assid.'_super_financial_assistance.png', $decoded_image);
        $storagePath = Storage::put('/app/signatures/'.$request->assid.'_super_financial_assistance.png', $decoded_image);
        //store the file in the db//
        $signature->supervisor_signature = 'signatures/'.$request->assid.'_super_financial_assistance.png';
        $signature->supervisor_user_id = Auth::user()->id;
        $signature->supervisor_date = Carbon::now();
        $signature->save();



        return 'Success';

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function review($id)
    {
        $record = FinancialAssistance::find($id);
        
        $totalAmount = $record->pmt_plan;
        
        //dd($totalAmount);
        $totalDays = 26;
        $range = range(1, $totalDays);

        $parts =array_sum($range);
        $perPart = $totalAmount / $totalDays;
        //dd($parts);
        $results = [];
        foreach (array_reverse($range) as $index => $day) {
            $results[$index + 1] = round($day * $perPart, 2, PHP_ROUND_HALF_UP);
    }
    
    return view('financial_assistance.review', compact('record', 'perPart', 'results'));
    
    }

    public function pdf($id)
    {

        $record = FinancialAssistance::find($id);

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


        $pdf = PDF::loadView('emails.admin.NewFinancialAssistanceRequestAdmin', compact('record', 'results', 'perPart'));

        return $pdf->stream('idbadge.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
