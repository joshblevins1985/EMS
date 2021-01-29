<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Vanguard\Employee;
use Vanguard\IncidentType;
use Vanguard\Units;
use Vanguard\BucyrusIncidents;
use Vanguard\Facilities;
use Vanguard\BucyrusIncidentCrew;
use Vanguard\BucyrusTownship;


use Illuminate\Http\Request;
use Auth;
use DateTime;
//Models

//end models

//Facades


class BucyrusController extends Controller
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
        //
    }
    
    public function list()
    {
        $add_pos = explode(',', Auth::user()->employee->additional_postions);
        
        //dd(in_array('16', $add_pos));
        
        if(Auth::user()->employee->primary_station == 21 && in_array('16', $add_pos) ||  Auth::user()->id == 450){
            $list = BucyrusIncidents::with('crew', 'crew.employee')->get();
            return view('bucyrus.list', compact('list'));
        }else{
            return view('errors.403');
        }
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::where('primary_station', 21)->whereBetween('status', [3, 7])->orderBy('last_name')->get();
        
        $incidenttype = IncidentType::orderBy('description')->get();
        
        $units = Units::where('status', 1)->get();
        
        $facilities = Facilities::get();
        
        $townships = BucyrusTownship::get();
        
        return view('bucyrus.create', compact('employees', 'incidenttype', 'units', 'facilities', 'townships'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = date('Y-m-d');
        
        //get form data and input to incidents
        $i = new BucyrusIncidents;
        
        $i->unit_id = $request->unit_id;
        $i->street_number = $request->street_number;
        $i->street = $request->route;
        $i->address2 = $request->address2;
        $i->city = $request->city;
        $i->state = $request->state;
        $i->zip = $request->zip;
        $i->township = $request->township;
        $i->patient = $request->patient;
        $i->call_time = $request->call_time;
        $i->dispatch_time = $request->dispatch_time;
        $i->enroute_time = $request->enroute_time;
        $i->onscene_time = $request->onscene_time;
        $i->txp_time = $request->txp_time;
        $i->clear_time = $request->clear_time;
        $i->txp_complete_time = $request->txp_complete_time;
        $i->inservice_time = $request->inservice_time;
        $i->txp_facility = $request->txp_facility;
        $i->street_txp = $request->route_txp;
        $i->address2_txp = $request->address2_txp;
        $i->city_txp = $request->city_txp;
        $i->state_txp = $request->state_txp;
        $i->zip_txp = $request->zip_txp;
        $i->incident_type = $request->incident_type;
        $i->incident_level = $request->incident_level;
        $i->incident_call_type = $request->incident_call_type;
        $i->incident_disposition = $request->incident_disposition;
        //calculate chute time//
        $dispatch = new DateTime($request->dispatch_time);
        $enroute = new DateTime($request->enroute_time);
        
        $chute_time= $dispatch->diff($enroute);
        
        //dd($chute_time->i);
        
        $i->chute_calc = $chute_time->i;
        
        //calculate response time//
        if($request->onscene_time)
        {
            
            $onscene = new DateTime($request->onscene_time);
            $response = $dispatch->diff($onscene);
            
            //dd($response->i);
            $i->response_calc = $response->i;
            
        }
        
        
        //calculate total time spent on scene//
        if($request->txp_time)
        {
            $onscene = new DateTime($request->onscene_time);
            $transport = new DateTime($request->txp_time);
            
            $time_onscene = $onscene->diff($transport);
            //dd($time_onscene->i);
            $i->onscene_calc = $time_onscene->i;
            
        }
        
        if($request->txp_complete_time)
        {
            //calculate total txp time//
             $txp_c = new DateTime($request->txp_complete_time);
             
             $txptime = $transport->diff($txp_c);
             //dd($txptime->i);
             $i->txptime_calc = $txptime->i;
             
        }
        
        //calculate total time to txp complete//
        if($request->txp_complete_time)
        {
            //calculate total txp time//
             $clear = new DateTime($request->clear_time);
        $toctxp = $txp_c->diff($clear);
        //dd($toctxp->i);
        $i->toctxp_calc = $toctxp->i;
             
        }
        
            
        //calculate total time from call to in-service//
        $inservice = new DateTime($request->inservice_time);
        $total = $dispatch->diff($inservice);
        //dd($total->i);
        $i->total_calc = $total->i;
        
        if($request->variance == 'on'){
            $variance = 1;
        }else{
            $variance = 0;
        }
        $i->variance = $variance;
        
        $i->save();
        
        
        if($request->crew){
                    $crew = $request->crew;
                    // Insert Applicants State Certifcations//
                    //dd($request->sc['state']);
                     foreach ($request->crew['user_id'] as $key => $value) {
                            BucyrusIncidentCrew::unguard();
                            BucyrusIncidentCrew::create([
                                'incident_id' => $i->id,
                                'user_id' => $value,
                                'assignment' => $crew['assignment'][$key],
                                'level' => $crew['level'][$key],
                            ]);
                        }
                }
                
        if($variance == 1){
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function monthlyReport()
    {
        
        $from = '2019-11-01';
        
        $to = '2019-11-30';
        
        $incidents = BucyrusIncidents::where('variance', 1)->whereBetween('created_at', [$from, $to])->get();
        
        return view('bucyrus.monthlyReport', compact('incidents'));
        
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
