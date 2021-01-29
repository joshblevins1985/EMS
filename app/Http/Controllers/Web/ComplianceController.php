<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Auth;
use Vanguard\Policies;
use Vanguard\Employee;
use Vanguard\EmployeeEncounters;
use Vanguard\EncounterAttachment;
use Vanguard\EncounterNote;
use Vanguard\User;
use Vanguard\IncidentReports;
use Vanguard\Attendance;
use Vanguard\AttendanceNotification;


use Illuminate\Http\Request;
use Mail;
use Vanguard\Mail\NewEncounter;
use Vanguard\Mail\EmployeeResponse;
use Vanguard\Companies;
use DB;
use PDF;

class ComplianceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:menu.compliance');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exppolicies = Policies::whereRaw('last_reviewed < DATE_SUB(NOW(),INTERVAL 1 YEAR)')->get();
        
        $encounters = EmployeeEncounters::with('Employee', 'Policies')
        ->where('department', 1)
        ->where('status', '<', '4')
        ->get();
        
        $attendance = AttendanceNotification::with(['employee' => function ($q) {
  $q->orderBy('last_name');
}])->get();
       
        return view('compliance.index', compact('exppolicies', 'encounters', 'attendance'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function encounterlist(Request $request)
    {
        //Get list of employees...
         $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
        
        //Get Search Values...
        $name= $request->name;
        $idate = $request->date_submit;
        
        //Build list of encounters..
        $encounters = EmployeeEncounters::with('Employee', 'Policies', 'EncounterReport')
        ->where('user_id', 'like', '%'.$name.'%')
        ->orderBy('doi', 'desc')->paginate(10);
        
        return view('compliance.encounterlist', compact( 'encounters', 'employees'));
    }
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function employeeattend($id)
    {
       $employee = Employee::where('user_id', $id)->first();
       
       return view('compliance.employeeattend', compact('employee'));
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit= false;
        
        $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        $companies = Companies::get();
                    
        $policies = Policies::get()
                    ->keyBy('id')
                    ->map(function($policy)
                    {
                        return "{$policy->policy_number} -- {$policy->title}";
                    });
        
        return view('compliance.encounter', compact('edit', 'employees', 'policies', 'companies'));
    }

    public function createnewpolicy()
    {
        $edit= false;
        
        
        return view('compliance.addpolicy', compact('edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        foreach($request->user_id as $user_id)
        {
           $this->validate(request(),[
            'doi' => 'required',
            'encounter_type' => 'required',
            'department' => 'required',
            'policy' => 'required',
            'incident_report' => 'required',
            'status' => 'required',
            
            ]);
            
        $encounter = new EmployeeEncounters;
        
        $encounter->doi = $request->doi_submit;
        $encounter->user_id = $user_id;
        $encounter->encounter_type = $request->encounter_type;
        $encounter->department =  $request->department;
        $encounter->policy = $request->policy;
        $encounter->follow_up = $request->follow_up;
        $encounter->fu_date = $request->fu_date_submit;
        $encounter->incident_report = $request->incident_report;
        $encounter->plan = $request->plan;
        $encounter->company_id = $request->company;
        $encounter->associated = $request->associated;
        $encounter->added_by = Auth::User()->id;
        $encounter->status = $request->status;
        $encounter->suspension_dates = $request->suspension_dates;
        
        $encounter->save();
        
        $notification = EmployeeEncounters::find($encounter->id)->toArray();
        $employee = Employee::where('user_id',$notification['user_id'])->first()->toArray();
        
        
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'company.compliance');
                $q->orWhere('name', 'company.admin1');
                $q->orWhere('name', 'company.admin');
            }
            )->get()->toArray();
       
       // Mail::to($users)->send(new NewEncounter($notification, $employee));
        
      //  if($request->ir == 2){
      //  Mail::to($employee['email'])->send(new EmployeeResponse($notification, $employee));
      //  } 
        }
        
        
        return redirect()->route('compliance.index');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attachmentSubmit(Request $request)
    {
   $this->validate($request, [
 
'name' => 'required',
 
'attachments'=>'required',
 
]);
 
if($request->hasFile('attachments'))
 
{
 
$allowedfileExtension=['pdf','jpg','png','docx'];
 
$files = $request->file('attachments');
 
foreach($files as $file){
 
$filename = $file->getClientOriginalName();
 
$extension = $file->getClientOriginalExtension();
 
$check=in_array($extension,$allowedfileExtension);
 
//dd($check);
 
if($check)
 
{
 

 
foreach ($request->attachments as $attachment) {
 
$filename = $attachment->store('attachments');
 
EncounterAttachment::create([
 
'pid' => $request->pid,
 
'file' => $filename,

'name' => $request->name
 
]);
 
}
 
return redirect()->back();
 
}
 
else
 
{
 
echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload png , jpg , doc</div>';
 
}
 
}
 
}
 
}
 

    
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function newpolicy(Request $request)
    {
        $this->validate(request(),[
            'policy_number' => 'required',
            'title' => 'required',
            'date_effective' => 'required',
            'last_reviewed' => 'required'
         ]);
        
       $policy = new Policies;
       
       $policy->policy_number = $request->policy_number;
       $policy->title = $request->title;
       $policy->date_effective = $request->date_effective_submit;
       $policy->last_reviewed  = $request->last_reviewed_submit;
       $policy->date_terminatied = $request->date_terminated_submit;
       $policy->approved_by = $request->approved_by;
       $policy->purpose = $request->purpose;
       $policy->scope = $request->scope;
       $policy->policy = $request->policy;
        
        $policy->save();
        
       return redirect()->route('compliance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $encounter = EmployeeEncounters::with('Employee', 'EncounterAttachment', 'EncounterNote', 'Policies', 'EncounterReport', 'EncounterReport.Employee')->find($id);
        
        
        return view('compliance.encountershow', compact('encounter'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function encounterreport()
    {
        $employees = Employee::where('status', '5')->get();
        
        $encounters = EmployeeEncounters::with('Employee', 'EncounterAttachment', 'EncounterNote', 'Policies' )
        ->select('user_id', DB::raw('count(*) as total'))
        ->where('encounter_type', '>', '4')
        ->groupBy('user_id')
        ->get();
        
        
        return view('compliance.encounterreport', compact('encounters', 'employees'));
    }
    


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit= true;
        
        $encounter = EmployeeEncounters::find($id);
        
        $employees = Employee::where('status', '>=', '1')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        $companies = Companies::get();
                    
        $policies = Policies::get()
                    ->keyBy('id')
                    ->map(function($policy)
                    {
                        return "{$policy->policy_number} -- {$policy->title}";
                    });
        
        return view('compliance.editencounter', compact('edit', 'encounter', 'employees', 'policies', 'companies'));
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
        $encounter = EmployeeEncounters::find($id);
        
        $encounter->doi = $request->doi_submit;
        $encounter->user_id = $request->user_id;
        $encounter->encounter_type = $request->encounter_type;
        $encounter->department =  $request->department;
        $encounter->policy = $request->policy;
        $encounter->follow_up = $request->follow_up;
        $encounter->fu_date = $request->fu_date_submit;
        $encounter->incident_report = $request->incident_report;
        $encounter->plan = $request->plan;
        $encounter->company_id = $request->company;
        $encounter->associated = $request->associated;
        $encounter->added_by = $request->added_by;
        $encounter->status = $request->status;
        
        $encounter->save();
        
        $notification = EmployeeEncounters::find($encounter->id)->toArray();
        $employee = Employee::where('user_id',$notification['user_id'])->first()->toArray();
        
        $users = User::whereHas(
            'roles', function($q){
                $q->where('name', 'company.compliance');
                $q->orWhere('name', 'company.admin1');
                $q->orWhere('name', 'company.admin');
            }
            )->get()->toArray();
       
        
        if($request->ir == 2){
        Mail::to($employee['email'])->send(new EmployeeResponse($notification, $employee));
        }
        
        return redirect()->back();
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
    
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function incidentreport(Request $request)
    {
        
        $incident = $request->id;
        
        $encounter = EmployeeEncounters::find($incident);
        
        return view('compliance.incident_report', compact('encounter'));
    }
    
          /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function export_pdf(Request $request)
  {
      $incident = $request->id;
        
        $ir = IncidentReports::find($incident)->toArray();
   
    // Send data to the view using loadView function of PDF facade
    $pdf = PDF::loadView('compliance.incident_reportview', $ir);
    // If you want to store the generated pdf to the server then you can use the store function
    //$pdf->save(storage_path().'_filename.pdf');
    // Finally, you can download the file using download function
    return $pdf->download('ir.pdf');
  }
    
       /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function incidentreportstore(Request $request)
    {
        
        
        
        $ir = new IncidentReports;
        
        $ir->incident_id = $request->incident;
        $ir->report = $request->incident_report;
        $ir->added_by = Auth::User()->id;
        
        
        $ir->save();
        
        return view('compliance.incident_report', compact('encounter'));
    }
    
              /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      public function encounter_pdf($id)
  {
      //dd($id);
      
      $encounter = EmployeeEncounters::with('Employee', 'EncounterAttachment', 'EncounterNote', 'Policies', 'EncounterReport', 'EncounterReport.Employee')->find($id);
       
       //dd($encounter);
       
       view()->share('encounter',$encounter);
       
        
    	// pass view file
            $pdf = PDF::loadView('compliance.encounterpdf')->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);
            // download pdf
            return $pdf->download($encounter->Employee->first_name.'_'.$encounter->Employee->last_name.'encounter'.$encounter->id.'.pdf');  
    
   
    
  }
}
