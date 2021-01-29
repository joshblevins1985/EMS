<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\IncidentReports;
use Vanguard\Employee;
use Vanguard\EmployeeEncounters;
use Vanguard\User;

use Auth;
use Mail;
use Vanguard\Mail\NewEncounter;
use Vanguard\Mail\EmployeeIRNotificaiton;
use DB;
use PDF;
use Input;

class IncidentReportController extends Controller
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
        $employee = Employee::find( Auth::User()->id);
        
        if(!$employee){
            return back()->with('error', 'Your user id is not found contact compliance to report problems.');
        }elseif($employee->first_name == $request->first_name && $employee->last_name == $request->last_name){
           if(!$request->incident){
            $compliance = new EmployeeEncounters;
            
            $compliance->doi = $request->doi_submit;
            $compliance->user_id = Auth::User()->id;
            $compliance->encounter_type = 7;
            $compliance->department = 1;
            $compliance->incident_report = $request->incident_report;
            $compliance->associated = "Employee Incident Report";
            $compliance->added_by = Auth::User()->id;
            $compliance->status = 0;
            
            $compliance->save();
            
            $encounter = new IncidentReports;
        
        $encounter->incident_id = $compliance->id;
        $encounter->doi = $request->doi;
        $encounter->location = $request->location;
        $encounter->report = $request->incident_report;
        $encounter->added_by = Auth::User()->id;
        
        $encounter->save();
        
        $employee= Employee::find($encounter->added_by)->toArray();
        
        $notification = EmployeeEncounters::find($encounter->incident_id)->toArray();
        
        
        $encounter->toArray();
            
        }else{
           $encounter = new IncidentReports;
        
        $encounter->incident_id = $request->incident;
        $encounter->report = $request->incident_report;
        $encounter->added_by = Auth::User()->id;
        
        $encounter->save();
        
        $employee= Employee::find($encounter->added_by)->toArray();
        
        $notification = EmployeeEncounters::find($encounter->incident_id)->toArray();
        
        
        $encounter->toArray(); 
        }
        
         $users = Employee::whereHas(
            'employeepositions', function($q){
                $q->where('primary_position', '19');
                $q->orWhere('primary_position', '18');
                $q->orWhere('primary_position', '25');
            }
            )->get()->toArray();
            
        
        
        Mail::to($users)->send(new EmployeeIRNotificaiton($encounter, $employee, $notification));
        
        return redirect()->route('dashboard')->with('success','You have sent your incident report to compliance. Thank you'); 
        }else{
            return back()->withErrors([ 'Your signature names do not match the name on file with the company. The company has on file for your name '. $employee->first_name.' '.$employee->last_name.'.'])->withInput(Input::all());;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ir = IncidentReports::find($id);
        
        return view('compliance.incident_reportview', compact('ir'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
      public function export_pdf(Request $request, $id)
  {
      $ir = IncidentReports::find($id);
      
      view()->share('ir',$ir);

        
        	// pass view file
            $pdf = PDF::loadView('compliance.irpdf');
            // download pdf
            return $pdf->download('incidentreport.pdf');
        
        
        return back()->withInput();
        
        
    
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
