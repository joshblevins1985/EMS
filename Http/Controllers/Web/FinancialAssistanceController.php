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
        $record->other_schools = $request->other_schools;
        $record->courses = $request->courses;
        $record->start_date = $start_date;
        $record->end_date = $end_date;
        $record->cost = $request->cost;
        $record->imporove = $request->imporove;
        $record->pmt_plan = $request->requested;

        $record->save();

        $totalAmount = $request->requested;
        $totalDays = 26;
        $range = range(1, $totalDays);

        $parts =array_sum($range);
        $perPart = $totalAmount / $parts;

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
        $storagePath = Storage::put('/signatures/'.$request->assid.'_financial_assistance.png', $decoded_image);
        
        //store the file in the db//
        $signature->employee_signature = 'signatures/'.$request->assid.'_financial_assistance.png';
        $signature->save();



        Mail::to($signature->employee->email)->send(new FinancialAssistanceRequest($signature));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
