<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Employee;
use Vanguard\User;
use Vanguard\FieldTrainingDates;
use Vanguard\DriverHistoryTracking;
use Vanguard\FieldTrainingTask;
use Vanguard\EmployeeCompetencies;
use Vanguard\EmployeeFieldTrainingTask;
use Vanguard\DriversTrainingLogs;
use Vanguard\DriverTrainingCheckOffTasks;
use Vanguard\EmployeeDriverTask;

use PDF;
use Auth;
use Carbon;
use Illuminate\Support\Facades\Mail;
use Vanguard\Mail\FtoPayEmail;

use Vanguard\Notifications\FtComplete;

use Vanguard\Mail\FtCompleteMail;
use Vanguard\Mail\FtoCompleteEmployee;



class FieldTrainingDate extends Controller
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
    public function dashboard()
    {
        $employees = Employee::where('employee_status', '<' , 99)->orderBy('last_name')->get();

        return view ('fto.dashboard', compact('employees'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userDashboard($userid)
    {
        $employee = Employee::where('user_id', $userid)->first();
        $competencies = EmployeeCompetencies::where('user_id', $employee->user_id)->get();
        $trainingLevel= $employee->employeepositions->trainingLevels->pluck('training_level')->toArray();
        $employeeFtoTasks = EmployeeFieldTrainingTask::where('user_id', $userid)->get();
        $drivingTasks = DriverTrainingCheckOffTasks::with(['driversCheck' => function ($q) use($employee){ $q->where('user_id', $employee->user_id); }])->get();

        //dd($trainingLevel);
        $ftoTasks = FieldTrainingTask::whereIn('level', $trainingLevel)->get();

        return view ('fto.ftoShow', compact('employee', 'ftoTasks', 'competencies', 'employeeFtoTasks', 'drivingTasks'));
    }
    
    public function addDriverCheck(Request $request)
    {
        $log = new DriversTrainingLogs;
        
        $log->ftodate_id = $request->training_date;
        $log->employee_id = $request->employee_id;
        $log->trainingOfficer_id = $request->trainingOfficer;
        $log->type = $request->type;
        
        $log->save();
        
        $trainingTasks = DriverTrainingCheckOffTasks::where('status', 1)->get();
        
        foreach ($trainingTasks as $trainingTask)
        {
            $empDt = new EmployeeDriverTask;
            
            $empDt->user_id = $request->employee_id;
            $empDt->fto_id = $request->trainingOfficer;
            $empDt->task_id = $trainingTask->id;
            $empDt->checkoff_id = $log->id;
            
            $empDt->save();
        }
        
        
        return back();
        }
        
    public function updateDriverCheckMiles(Request $request)
    {
        $log = DriversTrainingLogs::find($request->form_id);
        
        $log->miles_driven = $request->miles_driven;
        
        $log->save();
        
        return back();
    }

    public function ftoTaskAdd($userid)
    {
        $employee = Employee::where('user_id', $userid)->first();
        $trainingLevel= $employee->employeepositions->trainingLevels->pluck('training_level')->toArray();

        $ftoTasks = FieldTrainingTask::whereIn('level', $trainingLevel)->get();

        foreach($ftoTasks as $row)
        {
            $newTask = new EmployeeFieldTrainingTask;

            $newTask->task_id = $row->id;
            $newTask->user_id = $userid;

            $newTask->save();
        }

        return back();
    }

    public function ftoTaskComplete($userId, $taskId)
    {
     $task = EmployeeFieldTrainingTask::where('user_id', $userId)->where('task_id', $taskId)->first();

     $task->fto_user_id = Auth::user()->employee->user_id;
     $task->fto_signed = Carbon::now()->toDateTimeString();

     $task->save();

        return back();
    }

    public function traineeTaskComplete($userId, $taskId)
    {
        $task = EmployeeFieldTrainingTask::where('user_id', $userId)->where('task_id', $taskId)->first();


        $task->user_signed = Carbon::now()->toDateTimeString();

        $task->save();

        return back();
    }


    public function completeAllTasks($userId)
    {
        $tasks = EmployeeFieldTrainingTask::where('user_id', $userId)->get();

        if(count($tasks)){
           foreach ($tasks as $task)
           {
               $task->fto_user_id = Auth::user()->employee->user_id;
               $task->fto_signed = Carbon::now()->toDateTimeString();

               $task->save();
           }
        }



        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ftoModalBody($userId)
    {
        $employees = Employee::orderBy('last_name')->get();
        
        $trainee = Employee::where('user_id', $userId)->first();
        
        


        if(in_array(18, explode(',', Auth::user()->employee->additional_postions ))){
            
            return view('fto.partials.ftoDateModalBodyADMIN', compact('trainee', 'employees'))  ;  
            
        }elseif(in_array(22, explode(',', Auth::user()->employee->additional_postions ))){
            
            return view('fto.partials.ftoDateModalBodyADMIN', compact('trainee', 'employees'))  ; 
            
        }else{
            return view('fto.partials.ftoDateModalBodyFTO', compact('userId')) ;
        }
 
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function ndComplete($userId)
    {
        
        //Update employees completion date
            $dstatus = 0;
            $ftodate = Employee::where('user_id', $userId)->first();

            $ftodate->fto_end_date = date('Y-m-d');
            $ftodate->status = 5;
            $ftodate->driver = 0;
            $ftodate->employee_status = 99;

            $ftodate->save();
            
            $employee = Employee::with('employeepositions', 'station')->where('user_id', $userId)->first();
            
            $history = new DriverHistoryTracking;
            
            $history->employee = $userId;
            $history->original_value = $employee->getOriginal('employee_status');
            $history->new_value = $dstatus;
            $history->updated_by = Auth::User()->id;
            
            $history->save();
            
            return '200';
 
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fieldComplete($userId)
    {
        
        //Update employees completion date
            $dstatus = 1;
            $ftodate = Employee::where('user_id', $userId)->first();

            $ftodate->fto_end_date = date('Y-m-d');
            $ftodate->status = 5;
            $ftodate->driver = 1;
            $ftodate->employee_status = 3;

            $ftodate->save();

        $history = new DriverHistoryTracking;

        $history->employee = $employee->user_id;
        $history->original_value = $employee->getOriginal('employee_status');
        $history->new_value = $dstatus;
        $history->updated_by = Auth::User()->id;


        //Get employees field training dates to send report to accounting...
        //$fto = FieldTrainingDates::groupBy('training_officer')->where('payroll', '0')->get();

        // Check if the employee is a driver...
        if ($employee->driver == 1) {
            //If true create message content to send in notification / email...
            $m = $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->employeepositions->label . ' - ' . $employee->station->station . ' has completed the field training orientation. They are cleared by the education department to start driver orientation.';
            $n = $m = $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->employeepositions->label . ' - ' . $employee->station->station . ' has completed the field training orientation. They are cleared by the education department to start driver orientation.';
            $history->note = 'Employee completed the field training orientation. They are cleared by the education department to start driver orientation.';

        } else {
            //If employee is a non driver create message content to send in notification / email...
            $m = $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->employeepositions->label . ' - ' . $employee->station->station . ' has completed the field training process. They are cleared by the education department to run independently at their certified level. <strong> <span class="red-text"> This employees is a non-driver </span></strong>';
            $n = $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->employeepositions->label . ' - ' . $employee->station->station . ' has completed the field training process. They are cleared by the education department to run independently at their certified level. <strong> <span class="red-text"> This employees is a non-driver </span></strong>';
            $history->note = 'Employee completed the field training orientation. They are cleared by the education department and are a non-driver.';

            $ftodate->employee_status = 99;
            $ftodate->save();

        }

        $history->save();

        $users = User::whereHas(
            'roles', function($q) {
            $q->where('name', 'company.scheduling');
            $q->orWhere('name', 'company.compliance');
            $q->orWhere('name', 'company.humanresource');
            $q->orWhere('name', 'company.admin1');

        }
        )->get()->toArray();

        //Send out user notification
        foreach ($users as $row)
        {
            User::find($row['id'])->notify(new FtComplete($employee, $n));
        }

        //Mail Completion email to admin, scheduling, training...

        Mail::to($users)->send(new FtCompleteMail($m));
            
            return '200';
 
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function driverComplete($userId)
    {
        
        //Update employees completion date
            $dstatus = 1;
            $ftodate = Employee::where('user_id', $userId)->first();

            $ftodate->fto_end_date = date('Y-m-d');
            $ftodate->status = 5;
            $ftodate->driver = 1;
            $ftodate->employee_status = 99;

            $ftodate->save();
            
            $employee = Employee::with('employeepositions', 'station')->where('user_id', $userId)->first();
            
            $history = new DriverHistoryTracking;
            
            $history->employee = $userId;
            $history->original_value = $employee->getOriginal('employee_status');
            $history->new_value = $dstatus;
            $history->updated_by = Auth::User()->id;
            
            //Generate appropriate message and notification.
            
                $m =  $employee->first_name .' '. $employee->last_name .' - '. $employee->employeepositions->label .' - '. $employee->station->station .' has completed the drivers training orientation. They are cleared by the education department as a driver and provider.';
                $n = $employee->first_name .' '. $employee->last_name .' - '. $employee->employeepositions->label .' - '. $employee->station->station .' has completed the drivers training orientation. They are cleared by the education department as a driver and provider.';
                $history->note = 'Employee completed the driver orientation. They are cleared by the education department to start driver orientation.';
        
            $history->save();
            
            // Generate array of users to send message to.

        $users = User::whereHas(
            'roles', function($q) {
            $q->where('name', 'company.scheduling');
            $q->orWhere('name', 'company.compliance');
            $q->orWhere('name', 'company.humanresource');
            $q->orWhere('name', 'company.admin1');

        }
        )->get()->toArray();

        //Send out user notification
        foreach ($users as $row)
        {
            User::find($row['id'])->notify(new FtComplete($employee, $n));
        }

        //Mail Completion email to admin, scheduling, training...

        //Mail::to($users)->send(new FtCompleteMail($m));

        /**Notify employee of status ***This needs Updated to include appropriate messages.***

        Mail::to($employee['email'])->send(new FtoCompleteEmployee()); */
            
            return '200';
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // dd($request->training_officer);
        
        $sec = strtotime($request->date); 
  
        // convert seconds into a specific format 
        $date = date("Y-m-d", $sec); 
        
        
        $userid = $request->eid;
        $employee = Employee::with('employeepositions', 'station')->where('user_id', $userid)->first();
        $dstatus = $employee->employee_status;
        //Insert FTO Date
        $ft = new FieldTrainingDates;

        $ft->user_id = $request->eid;
        $ft->date = $date;
        $ft->total_hours = $request->hours;
        $ft->training_officer = $request->training_officer;
        $ft->type = $request->type;
        $ft->payroll = 0;

        $ft->save();

        //dd($dstatus);
        //Check if employee has completed field training and Field Orientation.

        //If true continue
        if ($request->complete == 1 && $request->type == 1) {

            //Update employees completion date
            $dstatus = 2;
            $ftodate = Employee::where('user_id', $request->eid)->first();

            $ftodate->fto_end_date = date('Y-m-d');
            $ftodate->status = $dstatus;

            $ftodate->save();
            
            $history = new DriverHistoryTracking;
            
            $history->employee = $employee->user_id;
            $history->original_value = $employee->getOriginal('employee_status');
            $history->new_value = $dstatus;
            $history->updated_by = Auth::User()->id;
            

            //Get employees field training dates to send report to accounting...
            //$fto = FieldTrainingDates::groupBy('training_officer')->where('payroll', '0')->get();

            // Check if the employee is a driver...
            if ($employee->driver == 1) {
                //If true create message content to send in notification / email...
                $m = $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->employeepositions->label . ' - ' . $employee->station->station . ' has completed the field training orientation. They are cleared by the education department to start driver orientation.';
                $n = $m = $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->employeepositions->label . ' - ' . $employee->station->station . ' has completed the field training orientation. They are cleared by the education department to start driver orientation.';
                $history->note = 'Employee completed the field training orientation. They are cleared by the education department to start driver orientation.';
                
            } else {
                //If employee is a non driver create message content to send in notification / email...
                $m = $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->employeepositions->label . ' - ' . $employee->station->station . ' has completed the field training process. They are cleared by the education department to run independently at their certified level. <strong> <span class="red-text"> This employees is a non-driver </span></strong>';
                $n = $employee->first_name . ' ' . $employee->last_name . ' - ' . $employee->employeepositions->label . ' - ' . $employee->station->station . ' has completed the field training process. They are cleared by the education department to run independently at their certified level. <strong> <span class="red-text"> This employees is a non-driver </span></strong>';
                $history->note = 'Employee completed the field training orientation. They are cleared by the education department and are a non-driver.';
                
            }
            
            $history->save();
            /*
        //Check if driver status has been updated
        if($employee->getOriginal('employee_status') != $dstatus){
            dd('Driver has been updated. The original value is '.$employee->getOriginal('employee_status'). 'while the current status is'. $dstatus);
        }else
        {
            dd('Driver has not been updated. The original value is '.$employee->getOriginal('employee_status'). 'while the current status is'. $dstatus);
        }
        */
        // Generate array of users to send message to.

        $users = User::whereHas(
            'roles', function($q) {
            $q->where('name', 'company.scheduling');
            $q->orWhere('name', 'company.compliance');
            $q->orWhere('name', 'company.humanresource');
            $q->orWhere('name', 'company.admin1');

        }
        )->get()->toArray();

        //Send out user notification
        foreach ($users as $row)
        {
            User::find($row['id'])->notify(new FtComplete($employee, $n));
        }

        //Mail Completion email to admin, scheduling, training...

        Mail::to($users)->send(new FtCompleteMail($m));

        /**Notify employee of status ***This needs Updated to include appropriate messages.***

        Mail::to($employee['email'])->send(new FtoCompleteEmployee()); */


        }
        //Check if employee has completed drivers training.
        elseif($request->complete == 1 && $request->type == 2){
            //Update employees completion date
            $dstatus = 99;
            $ftodate = Employee::where('user_id', $request->eid)->first();

            $ftodate->fto_end_date = date('Y-m-d');
            $ftodate->status = $dstatus;

            $ftodate->save();
            
            $history = new DriverHistoryTracking;
            
            $history->employee = $employee->user_id;
            $history->original_value = $employee->getOriginal('employee_status');
            $history->new_value = $dstatus;
            $history->updated_by = Auth::User()->id;

            //Generate appropriate message and notification.
            if($employee->driver == 1){
                $m =  $employee->first_name .' '. $employee->last_name .' - '. $employee->employeepositions->label .' - '. $employee->station->station .' has completed the drivers training orientation. They are cleared by the education department as a driver and provider.';
                $n = $employee->first_name .' '. $employee->last_name .' - '. $employee->employeepositions->label .' - '. $employee->station->station .' has completed the drivers training orientation. They are cleared by the education department as a driver and provider.';
                $history->note = 'Employee completed the driver orientation. They are cleared by the education department to start driver orientation.';
                
            }else{
                $m = $employee->first_name .' '. $employee->last_name .' - '. $employee->employeepositions->label .' - '. $employee->station->station .' has completed the drivers training orientation. They are listed as a non-driver please contact education or human resources to confirm.';
                $n = $employee->first_name .' '. $employee->last_name .' - '. $employee->employeepositions->label .' - '. $employee->station->station .' has completed the drivers training orientation. They are listed as a non-driver please contact education or human resources to confirm.';
                $history->note = 'Employee completed the driver orientation. They are cleared by the education department to start driver orientation.';
                
            }

            $history->save();
            /*
        //Check if driver status has been updated
        if($employee->getOriginal('employee_status') != $dstatus){
            dd('Driver has been updated. The original value is '.$employee->getOriginal('employee_status'). 'while the current status is'. $dstatus);
        }else
        {
            dd('Driver has not been updated. The original value is '.$employee->getOriginal('employee_status'). 'while the current status is'. $dstatus);
        }
        */
        // Generate array of users to send message to.

        $users = User::whereHas(
            'roles', function($q) {
            $q->where('name', 'company.scheduling');
            $q->orWhere('name', 'company.compliance');
            $q->orWhere('name', 'company.humanresource');
            $q->orWhere('name', 'company.admin1');

        }
        )->get()->toArray();

        //Send out user notification
        foreach ($users as $row)
        {
            User::find($row['id'])->notify(new FtComplete($employee, $n));
        }

        //Mail Completion email to admin, scheduling, training...

        Mail::to($users)->send(new FtCompleteMail($m));

        /**Notify employee of status ***This needs Updated to include appropriate messages.***

        Mail::to($employee['email'])->send(new FtoCompleteEmployee()); */

        }

        
        if($request->ajax()){
                
                if($ft->type == 1){
                    $type = 'Field';
                }elseif($ft->type == 2){
                    $type = 'Drivers';
                }
                $fto = $ft->fto;
                
                return "<tr> <td>$ft->date </td> <td> $ft->total_hours </td> <td> $fto->first_name $fto->last_name </td> <td> $type</td></tr>";
            }
            return back();

        //return user back to employee page

        


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
        $employee = Employee::find($id);

        $employee->orientation_start_date = $request->didactic_start_date_submit;
        $employee->orientation_end_date = $request->didactic_end_date_submit;
        $employee->fto_start_date = $request->fto_start_date_submit;
        $employee->fto_end_date = $request->fto_end_date_submit;

        $employee->save();



        return redirect()->route('employees.show', [$id]);
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
    public function ftopay_pdf(Request $request)
    {
        $employees = Employee::whereHas('ftopaydates', function($q){ $q->where('payroll', 0);} )->orderBy('last_name')->get();


        view()->share('employees', $employees);

        // pass view file
        $pdf = PDF::loadView('hr.reports.ftopay')->setPaper('a4')->setOption('margin-left', 10)->setOption('margin-right', 10)->setOption('margin-bottom', 10)->setOption('margin-top', 10);
        // download pdf
        return $pdf->download('ftopayreport.pdf');

        view()->share('employees', $employees);
        view()->share('status', $status);

        return view('hr.index');
    }
}
