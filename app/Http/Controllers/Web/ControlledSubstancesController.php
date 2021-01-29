<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\ControlledSubstances;
use Vanguard\Medications;
use Vanguard\NarcoticBoxes;
use Vanguard\VialStatus;
use Vanguard\VialLog;
use Vanguard\NarcoticWaste;
use Vanguard\BoxNotes;

use Auth;
use DB;

class ControlledSubstancesController extends Controller
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
    public function index(Request $request)
    {
        $medications = ControlledSubstances::with('Medications', 'Locations')
        ->where('id', 'like', '%' . $request->vial_number . '%')
        ->paginate('10');
        
        
        
        
        
        
        
        $rx = Medications::where('controlled', '1')->get()
                    ->keyBy('id')
                    ->map(function ($rx){
                        return"{$rx->trade_name}  -  {$rx->brand_name}";
                    });
                    
        $cs = Medications::get();
                    
        $nb = NarcoticBoxes::get()
                    ->keyBy('id')
                    ->map(function ($nb){
                        return"{$nb->box_number}";
                    });
                    
        $status = VialStatus::get()
                    ->keyBy('id')
                    ->map(function ($status){
                        return"{$status->label}";
                    });
                   
        $mcount = ControlledSubstances::
                select('medication', DB::raw('count(*) as count'), DB::raw('count(IF(status = 3,1,NULL)) safe'), DB::raw('count(IF(status = 4,1,NULL)) box'), DB::raw('count(IF(status = 8,1,NULL)) destroyed') ) 
                ->groupBy('medication')
                ->get();
                
        $waste = NarcoticWaste::with('boxinfo', 'vial', 'employee', 'vial.Medications')->where('status', '0')->get();
                
             
        
        return view('logistics.controlled', compact('medications', 'rx', 'nb', 'status', 'cs', 'mcount', 'mcount', 'waste'))->with('success', 'New Controlled Substance Added');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            //validate required fields
            $this->validate($request, [
                'medication' => 'required',
                'lot_number' => 'required',
                'expiration_submit' => 'required',
                'location' => 'required',
                'dose' => 'required',
                'status' => 'required',
                'comment' => 'required'
            ]);
            
        $i = 0;
        $times_to_run = $request->run;
        $array = array();
        while ($i++ < $times_to_run)
        {
            $medication = new ControlledSubstances;
        
        $medication->medication = $request->medication;
        $medication->ndc_number = $request->ndc_number;
        $medication->lot_number = $request->lot_number;
        $medication->expiration = $request->expiration_submit;
        $medication->location = $request->location;
        $medication->dose = $request->dose;
        $medication->status = $request->status;
        
        $medication ->save();
        }
        
        
        
        
        
        $rxlog= new VialLog;
        
        $rxlog->vial_id = $medication->id;
        $rxlog->status = $request->status;
        $rxlog->location = $request->location;
        $rxlog->comment = $request->comment;
        $rxlog->added_by = Auth::User()->id;
        $rxlog->save();
        
         // Update Logging
        if($times_to_run > 1){
            $lot= "lot of controlled substances";
        }else{
            $lot="controlled substance";
        }
        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log( auth()->user()->present()->nameOrEmail . ' Added a new '.$lot.'.');
        

        
        return redirect()->route('controlled.index');
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function boxnewmed(Request $request)
    {
     
     //change vial location and status
     
     $vloc = ControlledSubstances::find($request->med);
     $vloc->location = $request->box;
     $vloc->status = 4;
     
     $vloc->save();
     
     $box = NarcoticBoxes::find($request->box)->get();
     
     //add vial note
     
     $vnote = new VialLog;
     
     $vnote->vial_id = $request->med;
     $vnote->status = 4;
     $vnote->comment = 'Vial has been added to narcotic box.';
     $vnote->added_by = Auth::User()->id;
     $vnote->location = $request->box;
     
     $vnote->save();
     
     //change box status
     
     $bstatus = NarcoticBoxes::find($request->box);
     
     $bstatus->status = 1;
     
     $bstatus->save();
     
     //add box note
    
    $bnote = new BoxNotes;
    
    $bnote->added_by = Auth::User()->id;
    $bnote->note = $vloc->medications->trade_name.' Vial Number:'. sprintf('%08d', $vloc->id ).' has been added to the box.';
    $bnote->box = $request->box;
    
    $bnote->save();
    
    return redirect()->back();
            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $vl= ControlledSubstances::with('stat','log.stat','log.employee')->find($id);
        
        $rx = Medications::where('controlled', '1')->get()
                    ->keyBy('id')
                    ->map(function ($rx){
                        return"{$rx->trade_name}  -  {$rx->brand_name}";
                    });
                    
        $cs = Medications::get();
                    
        $nb = NarcoticBoxes::orderBy('box_number')->get()
                    ->keyBy('id')
                    ->map(function ($nb){
                        return"{$nb->box_number}";
                    });
                    
        $status = VialStatus::get()
                    ->keyBy('id')
                    ->map(function ($status){
                        return"{$status->label}";
                    });
        
        return view('logistics.csshow', compact('vl', 'rx', 'cs', 'nb', 'status'));
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
        $exp = ControlledSubstances::find($id);
        
        $exp->status = 7;
        $exp->save();
        
        //add vial note
     
     $vnote = new VialLog;
     
     $vnote->vial_id = $exp->id;
     $vnote->status = 7;
     $vnote->comment = 'Vial has been removed from circulation and marked as expired.';
     $vnote->added_by = Auth::User()->id;
     $vnote->location = 64;
     
     $vnote->save();
    }
}
