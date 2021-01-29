<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\DispatchAlerts;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

//Models//
use Vanguard\Units;
use Vanguard\UnitSchedule;
use Vanguard\Station;
use Vanguard\UnitLog;
use Vanguard\Events\UnitSignOn;
use Vanguard\Events\UnitDispatched;
use Tzsk\Sms\Facade\Sms;
use Vanguard\DispatchIncident;
use Vanguard\IncidentType;
use Vanguard\UnitStatus;
use Vanguard\IncidentLog;
use Vanguard\IncidentTimes;
use Vanguard\Facilities;
use Vanguard\Patients;
use Vanguard\schedule;
use Vanguard\Employee;
//End Models//

//Filters//
use Vanguard\DispatchFilters;
//End Filters//

use Auth;
use Carbon;
use Illuminate\Database\eloquent\Collection;
use Pnlinh\GoogleDistance\Facades\GoogleDistance;
use Illuminate\Support\Facades\Crypt;
use GuzzleHttp\Client;
use Illuminate\Cookie\CookieJar;


class DispatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view1(DispatchFilters $filters)
    {
        $units= UnitSchedule::filter($filters)->get();
        
        $status= UnitStatus::get();
        
        $pending = DispatchIncident::filter($filters)->get();
        
        $incident_types = IncidentType::get();
 
        $stations= Station::where('status', 0)->get();
        //$units= UnitSchedule::with('care', 'u', 'crew', 'crew.employee')->whereDate('start', Carbon::today())->orWhere('status', '>', 0)->get();
        
        return view('dispatch.view1', compact('stations', 'units', 'pending', 'incident_types', 'status'));
    }
    
    public function available_units(DispatchFilters $filters, $id)
    {
        
        $units= UnitSchedule::filter($filters)->get();
        $incident= DispatchIncident::find($id);
        
        return view('dispatch.partials.unit_dispatch_body', compact( 'units', 'incident'));
    }
    
      /**
     * Display a listing of the units.
     *
     * @return \Illuminate\Http\Response
     */
    public function units(DispatchFilters $filters)
    {
        $units= UnitSchedule::filter($filters)->get();
 
        $stations= Station::where('status', 0)->get();
        
        $incident_types = IncidentType::get();
        //$units= UnitSchedule::with('care', 'u', 'crew', 'crew.employee')->whereDate('start', Carbon::today())->orWhere('status', '>', 0)->get();
        
        
        
        return view('dispatch.units', compact('stations', 'units', 'incident_types'));
    }
    
       /**
     * Display unit modal.
     *
     * @return \Illuminate\Http\Response
     */
    public function unit_modal(Request $request, $id)
    {
        $unit_info = UnitSchedule::with('logs', 'logs.incident', 'logs.incident.type', 'logs.status_label')->find($id);
        
        return view('dispatch.partials.unit_modal_body', compact('unit_info'));
        
        
    }
    
       /**
     * Display unit modal.
     *
     * @return \Illuminate\Http\Response
     */
    public function card($id, $security)
    {
        $confirm = encrypt($security);
        
        
        
        //dd($confirm);
        
        $i = DispatchIncident::with('patient', 'patient.insurance', 'patient.insurance.insur', 'patient.qualification')->find($id);
        
        $d = decrypt($i->security);
        
        //dd($d);
        
        if($d == $security){
            $it = IncidentTimes::where('incident_id', $id)->first();
        
        $expire_date = date("Y-m-d H:i:s", strtotime( $it->dispatched . "+12hours")); // time that you want the link to expire 
        
        //dd($expire_date);
        
        echo $now = date("Y-m-d H:i:s"); // your current time.
        
        if ($now>$expire_date) {
        
            $message= "This dispatch card has expired please contact billing for information.";
        }
        else
        {
          $message= "";
          
        }
        
        return view('dispatch.card', compact('message', 'i'));
        }else{
            $message = "The security code is invalid please contact billing for information.";
            
            return view('dispatch.card', compact('message'));
        }
        
        
        
    }
    
       /**
     * Display a listing of the pending incidents.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending(DispatchFilters $filters)
    {
        
        $units= UnitSchedule::filter($filters)->get();
        
        $stations= Station::where('status', 0)->get();
        $pending = DispatchIncident::filter($filters)->get();
        $incident_types = IncidentType::get();
        $facility = Facilities::get();
        $patients = Patients::orderBy('last_name')->get();
        
        //$units= UnitSchedule::with('care', 'u', 'crew', 'crew.employee')->whereDate('start', Carbon::today())->orWhere('status', '>', 0)->get();
        
        return view('dispatch.pending', compact('units', 'stations', 'pending', 'incident_types', 'facility', 'patients'));
    }
    
       /**
     * Display a listing of the active incidents.
     *
     * @return \Illuminate\Http\Response
     */
    public function active(DispatchFilters $filters)
    {
       // dd($filters);
        $incident_types = IncidentType::get();
        $active = DispatchIncident::with('aunit')->filter($filters)->get();
        $stations= Station::where('status', 0)->get();
        //$units= UnitSchedule::with('care', 'u', 'crew', 'crew.employee')->whereDate('start', Carbon::today())->orWhere('status', '>', 0)->get();
        $facilities = Facilities::get();
        
        return view('dispatch.active', compact('stations', 'incident_types', 'active', 'facilities', 'filters'));
    }
    
    /**
     * Sign unit on for the shift.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function signon(Request $request)
    {
        $unit = UnitSchedule::find($request->unit);
        $unit->status = $request->status;
        $unit->save();
        
        $status = $request->status;
        
        if($status == 1){
            $message= "Inspecting Unit";
        }elseif($status == 2){
            $message= "Available for run";
        }elseif($status == 3){
            
        }elseif($status == 4){
            
        }
        
        $iid= '';
        event(new UnitSignOn($status, $unit, $message, $iid));
        
        
        
        return back()->with('success', 'You have updated the units status');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dispatched($id, $uid)
    {
        //update incident status
        $i = DispatchIncident::find($id);
        $i->status = 1;
        $i->unit = $uid;
        $i->save();
        
        //Update unit status
        $unit = UnitSchedule::find($uid);
        $unit->status = 3;
        $unit->save();
        
        //Update Incident Log
        $log = new IncidentLog;
        $log->status = 1;
        $log->note = 'Unit'. $unit->care->abbreviation .'-'. $unit->u->unit_number.' dispatched' ;
        $log->incident_id = $id;
        $log->user_id = Auth::User()->id;
        $log->save();
        
        $incident_time = IncidentTimes::where('incident_id', $id)->first();
        $incident_time->dispatched = Carbon::now()->toDateTimeString();
        $incident_time->save();
        
        $status = 3;
        
        $security = decrypt($i->security);
        
        if($i->facility)
        {
            $facility = Facilities::find($i->facility);
            $message= 'PEASI:: '. $unit->care->abbreviation.'-'. $unit->u->unit_number.' '. $i->incident_number .' '. $facility->name .'  '. $facility->house_number  .' '. $facility->street .' '. $facility->city .' '. $facility->state .' '. $facility->zip .' '. $i->notes .'https://peasi.app/dispatch/card/'.$i->id.'/'.$security ;
            
        }else{
            $message= 'PEASI:: '. $unit->care->abbreviation.'-'. $unit->u->unit_number.' '.$i->incident_number .' '. $i->type->description .'  '. $i->house_number  .' '. $i->incident_address .' '. $i->address_2 .' '. $i->incident_city .' '. $i->incident_state .' '. $i->notes .'https://peasi.app/dispatch/card/'.$i->id.'/'.$security ;
        }
    
        
        $iid= $i->id;
        
        // Send Message to crew. Update Unit Log
        
        event(new UnitDispatched($status, $unit, $message, $iid));
        
        return back()->with('success', 'You have dipatched a unit');
    }
    
    public function crew_message(Request $request, $uid)
    {
        $employees = schedule::where('unit', $uid)->get();
        
        foreach($employees as $row)
        {
            $employee= Employee::where('user_id', $row->user_id)->first();
            
            $phone = '1'.$employee->phone_mobile;
            
            Sms::send("$request->message")->to([$phone])->dispatch();
        }
        
         return back()->with('success', 'You have sent a message to the crew.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function transport(Request $request)
    {
       
        
        if($request->facility)
        {
            $facility = Facilities::find($request->facility);
            
            $incident = DispatchIncident::find($request->runid);
            
            $incident->desitination_facility_id = $request->facility;
            $incident->destination_address = $facility->house_number.' '. $facility->street;
            $incident->destination_city = $facility->city;
            $incident->destination_state = $facility->state;
            $incident->destination_zip = $facility->zip;
            
            $incident->save();
            
            //update incident times
            $incident_time = IncidentTimes::where('incident_id', $incident->id)->first();
            $incident_time->transporting = Carbon::now()->toDateTimeString();
            $incident_time->save();
            
             //Update unit status
            $unit = UnitSchedule::find($incident->unit);
            $unit->status = 6;
            $unit->save();
            
            //update incident log
            $log = new IncidentLog;
            $log->status = 3;
            $log->note = 'Unit'. $unit->care->abbreviation .'-'. $unit->u->unit_number.' transporting' ;
            $log->incident_id = $incident->id;
            $log->user_id = Auth::User()->id;
            $log->save();
            
            //update unit log
            $u = new UnitLog;
            $u->status = 6;
            $u->unit = $incident->unit;
            $u->incident_id = $incident->id;
            $u->user_id = Auth::User()->id;
            $u->save();
            
            return back()->with('success', 'You have updated the unit to transporting.');
            
        }else{
            
        if($request->house_number && $request->incident_address){
            
                $address = $request->house_number.' '. $request->incident_address;
                
               // dd($address);
            }else{
                //dd('empty');
                $address= $request->address_2;
            }
            
            $incident = DispatchIncident::find($request->runid);
            
            $incident->desitination_facility_id = $request->facility;
            $incident->destination_address = $address;
            $incident->destination_city = $request->incident_city;
            $incident->destination_state = $request->incident_state;
            $incident->destination_zip = $request->incident_zip;
            
            $incident->save();
            
            //update incident times
            $incident_time = IncidentTimes::where('incident_id', $incident->id)->first();
            $incident_time->transporting = Carbon::now()->toDateTimeString();
            $incident_time->save();
            
             //Update unit status
            $unit = UnitSchedule::find($incident->unit);
            $unit->status = 6;
            $unit->save();
            
            //update incident log
            $log = new IncidentLog;
            $log->status = 3;
            $log->note = 'Unit'. $unit->care->abbreviation .'-'. $unit->u->unit_number.' transporting' ;
            $log->incident_id = $incident->id;
            $log->user_id = Auth::User()->id;
            $log->save();
            
            //update unit log
            $u = new UnitLog;
            $u->status = 6;
            $u->unit = $incident->unit;
            $u->incident_id = $incident->id;
            $u->user_id = Auth::User()->id;
            $u->save();
            
            return back()->with('success', 'You have updated the unit to transporting.');
            
        }
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function status($id, $status, $iid)
    {
       
       
       if($status == 99) //if status is acknowledge
       {
           $us = UnitSchedule::find($id);
       $us->status = $status;
       $us->save();
       
       $d = DispatchIncident::find($iid);
       $d->status = 2;
       $d->save();
           
            $it = IncidentTimes::where('incident_id', $iid)->first();
            $it->unit_acknowledged = Carbon::now()->toDateTimeString();
            $it->save();
            
            //Update Incident Log
        $log = new IncidentLog;
        $log->status = 2;
        $log->note = 'Unit'. $us->care->abbreviation .'-'. $us->u->unit_number.' acknowledged' ;
        $log->incident_id = $id;
        $log->user_id = Auth::User()->id;
        $log->save();
        
        $u = new UnitLog;
        $u->status = 99;
        $u->unit = $id;
        $u->incident_id = $iid;
        $u->user_id = Auth::User()->id;
        $u->save();
        
        
       }elseif($status == 4)
       {
           $us = UnitSchedule::find($id);
           $us->status = $status;
           $us->save();
           
           $d = DispatchIncident::find($iid);
           $d->status = 3;
           $d->save();
           
           $it = IncidentTimes::where('incident_id', $iid)->first();
            $it->enroute = Carbon::now()->toDateTimeString();
            $it->save();
            
                //Update Incident Log
        $log = new IncidentLog;
        $log->status = 3;
        $log->note = 'Unit'. $us->care->abbreviation .'-'. $us->u->unit_number.' enroute' ;
        $log->incident_id = $id;
        $log->user_id = Auth::User()->id;
        $log->save();
        
        $u = new UnitLog;
        $u->status = 4;
        $u->unit = $id;
        $u->incident_id = $iid;
        $u->user_id = Auth::User()->id;
        $u->save();
        
       }elseif($status == 5)
       {
           $us = UnitSchedule::find($id);
       $us->status = $status;
       $us->save();
           
           $d = DispatchIncident::find($iid);
       $d->status = 3;
       $d->save();
           
           $it = IncidentTimes::where('incident_id', $iid)->first();
            $it->atscene = Carbon::now()->toDateTimeString();
            $it->save();
            
                //Update Incident Log
        $log = new IncidentLog;
        $log->status = 3;
        $log->note = 'Unit'. $us->care->abbreviation .'-'. $us->u->unit_number.' at scene' ;
        $log->incident_id = $id;
        $log->user_id = Auth::User()->id;
        $log->save();
        
        $u = new UnitLog;
        $u->status = 5;
        $u->unit = $id;
        $u->incident_id = $iid;
        $u->user_id = Auth::User()->id;
        $u->save();
        
       }elseif($status == 7)
       {
           $us = UnitSchedule::find($id);
       $us->status = $status;
       $us->save();
           
           $d = DispatchIncident::find($iid);
       $d->status = 3;
       $d->save();
           
           $it = IncidentTimes::where('incident_id', $iid)->first();
            $it->arrived = Carbon::now()->toDateTimeString();
            $it->save();
            
                //Update Incident Log
            $log = new IncidentLog;
            $log->status = 3;
            $log->note = 'Unit'. $us->care->abbreviation .'-'. $us->u->unit_number.' at facility' ;
            $log->incident_id = $id;
            $log->user_id = Auth::User()->id;
            $log->save();
            
            $u = new UnitLog;
        $u->status = 7;
        $u->unit = $id;
        $u->incident_id = $iid;
        $u->user_id = Auth::User()->id;
        $u->save();
        
            
       }elseif($status == 98)
       {
           $us = UnitSchedule::find($id);
       $us->status = 2;
       $us->save();
           
           $d = DispatchIncident::find($iid);
       $d->status = 4;
       $d->save();
           
           $it = IncidentTimes::where('incident_id', $iid)->first();
            $it->available = Carbon::now()->toDateTimeString();
            $it->save();
            
                    //Update Incident Log
            $log = new IncidentLog;
            $log->status = 4;
            $log->note = 'Unit'. $us->care->abbreviation .'-'. $us->u->unit_number.' Completed incident' ;
            $log->incident_id = $id;
            $log->user_id = Auth::User()->id;
            $log->save();
            
            
            // Send Message to crew. Update Unit Log
            
        $status = "2";
        $unit = $id;
        $message = "You have cleared your last incident";
        
        event(new UnitDispatched($status, $unit, $message, $iid));
            
       }
       
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $security = rand();
        
        $security = encrypt($security);
        
        //$security = decrypt($security);
        
        //dd($security);
        //dd(time());
        $station = Station::find($request->station_id);
        
        if($request->facility)
        {
            $facility = Facilities::find($request->facility);
            
            $from = $facility->house_number.' '.$facility->street.' '.$facility->city.' '.$facility->state.' '.$facility->zip;
        }else{
          $from = $request->house_number.' '.$request->incident_address.' '.$request->incident_city.' '.$request->incident_state.' '.$request->incident_zip;
          
        }
        
        $to = $station->street_number.' '.$station->route.' '.$station->locality.' '.$station->state.' '.$station->postal_code;
        $distance = GoogleDistance::calculate($from, $to);
        
        $duration = $distance / 60;
        $duration = round($duration);
        
        //dd($duration);
        
        
        $incident_id = "";
        $incident = DispatchIncident::whereYear('pick_up', Carbon::now()->year)->count();
        $incident= $incident + 1;
        $incident_id = Carbon::now()->year.'-'.str_pad($incident, 6, '0', STR_PAD_LEFT);
        
        //dd($incident_id);
        
        $request->merge(['security' => $security]);
        $request->merge(['travel' => $duration]);
        $request->merge(['incident_number' => $incident_id]);
        if(!$request->pick_up)
        {
            $request->merge(['pick_up' => Carbon::now()]);
        }
        $data = request()->all();
        
        
        $incident = DispatchIncident::create($request->except('alert_id'));
        
        $incident_times = new IncidentTimes;
        $incident_times->incident_id = $incident->id;
        $incident_times->save();

        $alerts = $request->input('alert_id') ;
        $incident_id = $incident->id;
        foreach($alerts  as $alert){
            $dalert = new DispatchAlerts;
            $dalert->incident_id = $incident_id;
            $dalert->alert_id = $alert;
            $dalert->save();
        }
        
        return back()->with('success', 'You have added a new incident.');
        
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function street_eagle()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.insightmobiledata.com',
            // You can set any number of default request options.
            'timeout'  => 2.0,
        ]);
        
        $response = $client->request('GET', '/api/v1/vehicles');
    }
    
    public function unitMdt (CookieJar $cookieJar, Request $request)
 {
     if($request->unitId){
        $cookieJar->queue(cookie('unitId', $request->unitId, 10));
     }
     
     $employee = Schedule::where('user_id', $request->unitId)->whereDate('sin', Carbon::today())->with('unitAssigned', 'unitAssigned.incidents', 'unitAssigned.incidents.type', 'unitAssigned.incidents.pick_up_facility')->first(); 
    
     return view('dispatch.unitMdt', compact('employee'));
 }
}
