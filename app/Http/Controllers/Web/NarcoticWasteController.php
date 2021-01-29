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
use Vanguard\Employee;
use Vanguard\SealLog;
use Vanguard\BoxNotes;
use Vanguard\Station;

use Auth;

class NarcoticWasteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $validatedData = $request->validate([
        'attending' => 'required' ,
        'station' => 'required',
        'vial_id' => 'required',
        'used' => 'required',
        'waste' => 'required',
        'new_seal' => 'required',
    ],
    [
        'attending.required' => 'You must select the attending AEMT / Paramedic.' ,
        'station.required' => 'You must select the station in which you are working out of today.',
        'vial_id.required' => 'You must select the vial in which you are wasting.',
        'used.required' => 'You must input the total amount of the drug in which you have used.',
        'waste.required' => 'You must input the total amount of the drug in which you have wasted.',
        'new_seal.required' => 'You must input the new seal number you used to seal the drug containter.',
    ]);
    
   
    
    
        //find the employee whom used the vial
        $employee = Employee::where('rfid', $request->attending)->first();
        
        //create the waste form
        $waste = new NarcoticWaste;
        
        $waste->box = $request->box;
        $waste->seal = $request->seal;
        $waste->station = $request->station;
        $waste->attending = $employee->id;
        $waste->vial_id = $request->vial_id;
        $waste->used = $request->used;
        $waste->waste = $request->waste;
        $waste->new_seal = $request->new_seal;
        $waste->paramedic = $employee->id;
        $waste->status = 0;
        
        $waste->save();
        
        //check employee id
        
        if(!$employee->eid)
        {
            $eid = "Unknown";
        }else{
            $eid = $employee->eid;
        }
        
        //Log transaction to the narcotic controller
        $vial= new VialLog;
        
        $vial->vial_id = $request->vial_id;
        $vial->status = 6;
        $vial->comment = $employee->first_name.' '.$employee->last_name.'- EID #'. $eid.' used vial for patient care.' ;
        $vial->added_by = $employee->id;
        $vial->location = 48;
        
        $vial->save();
        
        //Update Vial Location
        
        $cs = ControlledSubstances::find($request->vial_id);
        
        $cs->location = 48;
        
        $cs->save();
        
        //insert change to the seal log
        $seal = new SealLog;
        
        $seal->box = $request->box;
        $seal->seal = $request->seal;
        $seal->tamper_seal = $request->tamper_seal;
        $seal->new_seal = $request->new_seal;
        $seal->new_tamper_seal = 'Box Used';
        $seal->employee = $employee->id;
        $seal->reason = 2;
        $seal->save();
        
        //Change Box Seal Number
        
        $box = NarcoticBoxes::find($request->box);
        
        $box->seal = $request->new_seal;
        $box ->tamper_seal = 'Box Used';
        $box->status = 3;
        
        $box->save();
        
        // Add Box Note to show what and who used the medications.
        $rx = ControlledSubstances::with('medications')->where('id', $request->vial_id)->first();
        
        if(!$rx)
        {
            $med= 'unknown';
        }else{
            $med = $rx->medications->trade_name;
        }
        
        $bnote= new BoxNotes;
        
        $bnote->added_by = $employee->id;
        $bnote->note = $employee->first_name.' '.$employee->last_name.'- EID #'. $eid.' used ' .$request->used.' units of '. $med. ' and wasted '.$request->waste. 'units' ;
        $bnote->box = $request->box;
        
        $bnote->save();
        
        //change the status of the vial to used and change the location to waste.
        
        $status = ControlledSubstances::find($request->vial_id);
        $status->status = 6;
        $status->save();
        
        //Send notification email...
        
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
        $waste = NarcoticWaste::find($id);
        
        return view('logistics.reports.narcoticwaste', compact('waste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stations = Station::where('status', '0')->pluck('station', 'id');
        
        $waste= NarcoticWaste::with('employee', 'stationinfo')->find($id);
        
        $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
        
        
        return view('logistics.narcoticwasteform', compact('stations', 'waste', 'employees'));
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
        //update waste form and make complete.
        $waste = NarcoticWaste::find($id);
        
        $waste->driver = $request->driver;
        $waste->patient_name = $request->patient_name;
        $waste->transport = $request->transport;
        $waste->administration = $request->administration;
        $waste->witness = $request->witness;
        $waste->status = 1;
        
        $waste->save();
        
        //update status of vial as destroyed...
        
        $vial = ControlledSubstances::find($waste->vial_id);
        
        $vial->status = 8;
        
        $vial->save();
        
        // Add entry into vial log;
        
        if(!$waste->employee->eid)
        {
            $eid = "Unknown";
        }else{
            $eid = $waste->employee->eid;
        }
        
        $vial= new VialLog;
        
        $vial->vial_id = $waste->vial_id;
        $vial->status = 8;
        $vial->comment = 'Medication has been appropriately destroyed according to policy.' ;
        $vial->added_by = Auth::User()->id;
        $vial->location = 48;
        
        $vial->save();
        
        return redirect("/controlled/$vial->vial_id")->with('success', 'Updated Narcotic Use Form Successfully.');
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
