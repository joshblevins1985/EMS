<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

//Models
use Vanguard\BadRunSheet;
use Vanguard\Employee;
use Vanguard\Companies;
use Vanguard\runsheetaudit;
use Vanguard\User;
use Vanguard\RunSheetTracking;
use Vanguard\PcrErrors;
use Vanguard\PcrUpload;
use Vanguard\BadRunSheetErrors;
use Vanguard\EmployeeBadRunSheetError;
use Vanguard\BadRunSheetEmployee;
//end models

//Facades
use Auth;
use Exception;
use DB;
use Carbon;
use PDF;
use Illuminate\Http\Request;
use Vanguard\Notifications\BadRunSheets;
use Mail;
use Vanguard\Mail\BadRunSheetNotification;
use Vanguard\Repositories\Permission\PermissionRepository;
use Vanguard\Repositories\Role\RoleRepository;

//end Facades

class BadRunsheetController extends Controller
{
    public function __construct(RoleRepository $roles, PermissionRepository $permissions)
    {
        $this->middleware('auth');
        
        $this->middleware('permission:view.badrunsheets')->except('update', 'show', 'oneclick');
    }
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, BadRunSheet $brs)
    {
        
        
        $user= Auth::user();
        $company_id = $user->companies_id;
        
        $name= $request->name;
        $incident = $request->incident_number;
        $incdate = $request->date_submit;
        $status = $request->status;
        $employee =$request->employee;
        
        $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
        
       //dd($status);

        $brs= BadRunSheet::with('employees', 'employees.employee')->where('status', '<', 5)
        /*
        ->select('*') ;
            
            $brss = is_null($status) ? $brss : $brss->orwhere('status', $status);;
            
            // Add pcr number filter
            $brss = is_null($incident) ? $brss : $brss->orWhere('pcr_number', $incident);
            
            // Add city filter
            $brss = is_null($incdate) ? $brss : $brss->orWhere('incident_date','like','%'.$incdate.'%');
            
             // Add employee filter
            $brss = is_null($employee) ? $brss : $brss->orWhere('employee', $employee);
            
        $brs = $brss->orderBy('incident_date', 'desc')
        */
        ->get();
        
        
        

        return view('badrunsheets.index', compact('brs', 'employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit= false;

        $employees = Employee::select('last_name', 'first_name', 'user_id')->orderBy('last_name')->get();
        
        //$problems= PcrErrors::where('status', 0)->get();
        
        $problems = BadRunSheetErrors::where('status', 1)->get();

        return view('badrunsheets.create', compact('employees', 'edit', 'problems'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(),[
            'incident_date' => 'date',
            'pcr_number' => 'required|unique:badrunsheets,pcr_number',
            'employee' => 'required',

        ]);


        $brsenter = new BadRunSheet;
        
        $brsenter->incident_date = $request->incident_date_submit;
        
        $brsenter->pcr_number = $request->pcr_number;
        $brsenter->comments = $request->comments;
        $brsenter->status = $request->status;
        
        $brsenter->save();
        
        $rst = new RunSheetTracking;
        
        $rst->status = 1;
        $rst->added_by = Auth::User()->id;
        $rst->pid = $brsenter->id;

        $rst->save();
        $items = $request->employee;
        foreach($items as $key => $row){
            $insert = new BadRunSheetEmployee;
            $insert->bad_run_sheet_id = $brsenter->id;
            $insert->user_id = $row;
            $insert->save();
            
        $employee = Employee::where('user_id', $row)->first();
        
        $pcr = BadRunSheet::find($brsenter->id)->toArray();
        
        Mail::to($employee['email'])->send(new BadRunSheetNotification($pcr));
        
            
            // check for failures
        if (Mail::failures()) {
            // return response showing failed emails
        }else{
            
            $notified = BadRunSheet::find($brsenter->id);
            
            $notified->status = 2;
            
            $notified->save();
            
            $notified = BadRunSheetEmployee::find($insert->id);
            
            $notified->status = 2;
            
            $notified->save();
            
            $rst = new RunSheetTracking;
            
            $rst->status = 2;
            $rst->added_by = Auth::User()->id;
            $rst->pid = $brsenter->id;
            
            $rst->save();
        }
        
        User::find($row)->notify(new BadRunSheets($pcr));
            
        }
        
                        if ($request->hasFile('pdf')) {

            $allowedfileExtension = ['jpg', 'png', 'PNG', 'pdf', 'PDF'];

            $files = $request->file('pdf');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

//dd($check);

                if ($check) {


                    foreach ($request->pdf as $attachment) {


                        $filename = $attachment->storeAs('pcr', $rst->id . '.png');

                        $pcr = new PcrUpload;
                        $pcr->pid = $rst->id;
                        $pcr->location = $filename;
                        $pcr->save();


                    }


                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload PNG, png , jpg.</div>';

                }

            }

        }
        
       
        $brs= BadRunSheet::with('employees')->get();
        
        $pcr= $request->pcr_number;
        $user_id = $request->employee;
        
        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Added new bad run run sheet PCR number '.$pcr.'.');
        
        
    
    // Create Empty Arrays //
            $payload = [
                'problems' => [],

            ];
    
    //dd(date('Y-m-d', strtotime($request->sc['expiration'][0])));
                if($request->p){
                    $p = $request->p;
                    // Insert Applicants State Certifcations//
                    //dd($request->sc['state']);
                     foreach ($request->p['problem'] as $key => $value) {
                         
                            EmployeeBadRunSheetError::create([
                                'brs_id' => $brsenter->id,
                                'error_id' => $p['problem'][$key],
                                'note' => $p['note'][$key],
                            ]);
                        }
                }

    
        
        

        return redirect(route('badrunsheets.index'))->with('success', 'Incident Added');
    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brs = BadRunSheet::with('employees', 'audit', 'audit.employee')->find($id);
        
        return view('badrunsheets.view', compact('brs'));
        
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

        $brs= BadRunSheet::find($id);

        $employees = Employee::select('last_name', 'first_name', 'user_id')->orderBy('last_name')->get();

        return view('badrunsheets.edit', compact('edit', 'brs', 'employees'));
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

        $brsenter= BadRunSheet::find($id);

        $brsenter->incident_date = $request->incident_date;
        $brsenter->user_id = $request->employee;
        $brsenter->pcr_number = $request->pcr_number;
        $brsenter->comments = $request->comments;
        $brsenter->status = $request->status;
        
        $brsenter->save();
    //dd($request->hasFile('pdf'));
        if ($request->hasFile('pdf')) {

            $allowedfileExtension = ['jpg', 'png', 'PNG', 'pdf', 'PDF'];

            $files = $request->file('pdf');

            foreach ($files as $file) {

                $filename = $file->getClientOriginalName();

                $extension = $file->getClientOriginalExtension();

                $check = in_array($extension, $allowedfileExtension);

//dd($check);

                if ($check) {


                    foreach ($request->pdf as $attachment) {


                        $filename = $attachment->storeAs('pcr', $brsenter->id . '.pdf');

                        $pcr = new PcrUpload;
                        $pcr->pid = $brsenter->id;
                        $pcr->location = $filename;
                        $pcr->save();


                    }


                } else {

                    echo '<div class="alert alert-warning"><strong>Warning!</strong> Sorry Only Upload PNG, png , jpg.</div>';

                }

            }

        }


        // Update log on same
        $pcr= $request->pcr_number;

        $pcrold= $brsenter->getOriginal('pcr_number');

        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Updated bad run sheet PCR number from '.$pcrold.' to '.$pcr.'.');

        return redirect(route('badrunsheets.index'))->with('success', 'Incident Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function oneclick(Request $request)
    {
        $id= $request->id;

        $brs= BadRunSheet::find($id);

        $brs->status = $request->status;

        $brs->save();
        
        $rst = new RunSheetTracking;
        
        $rst->status = $request->status;
        $rst->added_by = Auth::User()->id;
        $rst->pid = $request->id;
        
        $rst->save();
        
        $emps = BadRunSheetEmployee::where('bad_run_sheet_id', $brs->id)->get();
        
        foreach ($emps as $row){
            $update = BadRunSheetEmployee::find($row->id);
            $update->status = $request->status;
            
            $update->save();
        }

        // Update log on same

        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Updated bad run run sheet');

        return back()->with('success', 'Incident Updated');
    }

    public function allBilling($userId)
    {
        $pcr = BadRunSheet::where('employee', $userId)->get();

        foreach ($pcr as $row)
        {
            $id= $row->id;

            $brs= BadRunSheet::find($id);

            $brs->status = 5;

            $brs->save();

            $rst = new RunSheetTracking;

            $rst->status = $brs->status;
            $rst->added_by = Auth::User()->id;
            $rst->pid = $brs->id;

            $rst->save();
            
            $emps = BadRunSheetEmployee::where('bad_run_sheet_id', $brs->id)->get();
        
            foreach ($emps as $row){
                $update = BadRunSheetEmployee::find($row->id);
                $update->status = $request->status;
                
                $update->save();
            }

            // Update log on same

            app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Updated bad run run sheet '. $brs->pcr_number);
        }



        return back()->with('success', 'Incident Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $empbrs = EmployeeBadRunSheetError::where('brs_id', $id);

        foreach($empbrs as $row)
        {
            $empbrs->delete();
        }

        $pcr= $request->pcr_number;
        $brs = BadRunSheet::find($id);
        $brs->delete();

        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Deleted bad run run sheet PCR number '.$pcr.'.');

        return back();
    }
    
        /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function weeklyreport()
    {
        $brs_count = BadRunSheet::select(DB::raw('count(if(status < 4,1,NULL)) bad'), DB::raw('count(*) count'), DB::raw('count(if(status >= 4,1,NULL)) fixed'), DB::raw('WEEK(created_at) monname'))->groupBy('monname')->get();
        
        $employee_count = BadRunSheet::select(DB::raw('count(*) count'), 'employee')->orderBy('count', 'desc')->groupBy('employee')->take(10)->get();
        
        //dd($employee_count->pluck('Employee.last_name'));
        
        $lastname = $employee_count->map(function ($employee_count) {
                                        return"{$employee_count->Employee->first_name} {$employee_count->Employee->last_name}";
                                    });
        
      // dd(json_encode($lastname));
      
      $brs_five = BadRunSheet::select(DB::raw('count(*) count'), 'employee')->orderBy('count', 'desc')->with('employees')->where('created_at', '<', Carbon::now()->subDays(5))->where('status', '<', 4)->groupBy('employee')->get(); 

        return view('badrunsheets.reports.weekly', compact('brs_count', 'employee_count', 'lastname', 'brs_five'));
    }
    
     public function weeklyreportpdf()
    {
        $brs_count = BadRunSheet::select(DB::raw('count(if(status < 4,1,NULL)) bad'), DB::raw('count(*) count'), DB::raw('count(if(status >= 4,1,NULL)) fixed'), DB::raw('WEEK(created_at) monname'))->groupBy('monname')->get();
        
        $employee_count = BadRunSheet::select(DB::raw('count(*) count'), 'employee')->orderBy('count', 'desc')->groupBy('employee')->take(10)->get();
        
        //dd($employee_count->pluck('Employee.last_name'));
        
        $lastname = $employee_count->map(function ($employee_count) {
                                        return"{$employee_count->Employee->first_name} {$employee_count->Employee->last_name}";
                                    });
        
      // dd(json_encode($lastname));
      
      $brs_five = BadRunSheet::with('employees')->where('created_at', '<', Carbon::now()->subDays(5))->where('status', '<', 4)->get();

        view()->share('brs_count',$brs_count);
      view()->share('employee_count' ,$employee_count);
      view()->share('lastname',$lastname);
      view()->share('brs_five',$brs_five);

        return view('badrunsheets.reports.weeklypdf', compact('brs_count', 'employee_count', 'lastname', 'brs_five'));
    }
    
    public function pdfEdit($id)
    {
        $file = PcrUpload::find($id);
        
        return view('badrunsheets.pdf.edit', compact('file'));
    }
}
