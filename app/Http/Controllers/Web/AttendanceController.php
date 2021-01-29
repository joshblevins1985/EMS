<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Attendance;
use Vanguard\schedule;
use Vanguard\Employee;
use Vanguard\AttendanceOccurance;
use Vanguard\EmployeeEncounters;

use Auth;
use DB;
use Vanguard\Export\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

use Mail;
use Vanguard\Mail\AttedanceMail;




class AttendanceController extends Controller
{
    private $start;
    private $end ;

    public function __construct()
    {
        $this->middleware('auth');
        $this->start = '2020-10-01';
        $this->end = '2020-12-31';
    }


    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $start, $end)
    {
        $name= $request->name;
        
        $noclock = schedule::with('Employee')
        ->whereHas('Employee', function($q) use($name){

                $q->where('last_name', 'like','%'.$name.'%');
                
            })
        ->leftJoin('time_punch', function($join)
        {
            $join->on('schedule.id', '=', 'time_punch.schedule_id');
        })
        ->where('sin', 'like', $request->date_submit.'%')
        ->whereNull('status' )
        ->whereNull('time_punch.time_in')->get([
            'schedule.id',
            'schedule.sin',
            'schedule.user_id'
            
            ]);
            
        $count= Attendance::
            whereBetween('date', $start, $end);
        
        return view('attendance.noclock', compact('noclock'));
    }
    
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        $occurances = AttendanceOccurance::orderBy('id')->get()
                    ->keyBy('id')
                    ->map(function ($occurance){
                        return"{$occurance->label}";
                    });
                    
        if(!$request->name && !$request->date_submit){
            $attendance = Attendance::with('type')
        ->orderBy('date', 'desc')->paginate(10);
        }elseif(!$request->date_submit){
            $attendance = Attendance::with('type')
        ->where('user_id', $request->name)
        ->orderBy('date', 'desc')->paginate(10);
        }elseif(!$request->name){
            $attendance = Attendance::with('type')
        ->Where('date', 'like', '%'.$request->date_submit.'%')
        ->orderBy('date', 'desc')->paginate(10);
        }else{
            $attendance = Attendance::with('type')
        ->where('user_id', $request->name)
        ->Where('date', 'like', '%'.$request->date_submit.'%')
        ->orderBy('date', 'desc')->paginate(10);
        }
            
        
        
        
        return view('attendance.list', compact('attendance', 'employees', 'occurances'));
    }
    
    public function multi(Request $request)
    {
        $employees = Employee::where('status', 5)->orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        $occurances = AttendanceOccurance::orderBy('id')->get()
                    ->keyBy('id')
                    ->map(function ($occurance){
                        return"{$occurance->label}";
                    });
                    
        if($request->date_submit){
        $work_date = $request->date_submit;
        }
        
        $attendance = Attendance::with('type')
        ->whereDate('date', $work_date)
        ->orderBy('date', 'desc')->paginate(10);
        
        
        return view('attendance.multi', compact('attendance', 'employees', 'occurances', 'work_date'));
    }
    
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function report()
    {
        set_time_limit(-1);
ini_set('memory_limit','2G');
        
        //get all employees
        
        $start = '2020-10-01';
        $end = '2020-12-31';
      
       $employees = Employee::where('status', 5)->orderBy('last_name')->paginate(100);

$employeesCount = Attendance::whereBetween('date', [$start, $end])
            ->whereIn('user_id', $employees->pluck('user_id')->toArray())
            ->select('user_id', DB::raw('count(*) as total'), 
            DB::raw('count(IF(occurance_type = 0,1,NULL)) hour'), 
            DB::raw('count(IF(occurance_type = 2,1,NULL)) t5'), 
            DB::raw('count(IF(occurance_type = 4,1,NULL)) t120'), 
            DB::raw('count(IF(occurance_type = 6,1,NULL)) b'), 
            DB::raw('count(IF(occurance_type = 7,1,NULL)) ncns'), 
            DB::raw('count(IF(occurance_type = 8,1,NULL)) co'), 
            DB::raw('count(IF(occurance_type = 9,1,NULL)) ntc'), 
            DB::raw('count(IF(occurance_type = 10,1,NULL)) lo'),
            DB::raw('count(IF(occurance_type = 18,1,NULL)) cofmla'),
            DB::raw('count(IF(occurance_type = 19,1,NULL)) lpdfmla'))
            ->where('status', 0)
            ->groupBy('user_id')
            ->get();
            
$complianceCount = EmployeeEncounters::whereBetween('doi', [$start, $end])
            ->whereIn('user_id', $employees->pluck('user_id')->toArray())
            ->select('user_id', DB::raw('count(IF(encounter_type >= 4,1,NULL)) compliance'))
            ->groupBy('user_id')
            ->get();
            
            
            

$employees->map(function ($employee) use ($employeesCount, $complianceCount) {
    $count = $employeesCount->where('user_id', $employee->user_id)->first();
    $ccount = $complianceCount->where('user_id', $employee->user_id)->first();

    if (!$count ) {
        $employee->hour32 = 0;
        $employee->late = 0 ;
        $employee->late120 = 0;
        $employee->blackout = 0;
        $employee->nocall = 0;
        $employee->calloff = 0;
        $employee->ntc = 0;
        $employee->lo = 0;
        
    } else {
        $employee->hour32 = $count->hour * 0;
        $employee->late = $count->t5 ;
        $employee->late120 = $count->t120 * 3;
        $employee->blackout = $count->b * 7;
        $employee->nocall = $count->ncns * 7;
        $employee->calloff = $count->co * 3;
        $employee->ntc = $count->ntc * 2;
        $employee->lo = $count->lo * 1;
        $employee->cofmla = $count->cofmla * 3;
        $employee->lpdfmla = $count->lpdfmla;
        
    }
    
    if(!$ccount){
        $employee->compliance = 0;
    }else{
        $employee->compliance = $ccount->compliance * 7;
    }
    
    $employee->total = $employee->hour32 + $employee->late + $employee->late120 + $employee->blackout + $employee->nocall +$employee->calloff + $employee->ntc + $employee->lo + $employee->cofmla + $employee->lpdfmla + $employee->compliance;

    return $employee;
});
        
        return view('attendance.report', compact('employees', 'start', 'end'));
    }
    
    
     /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function excell(Request $request)
    {
         $start = '2020-10-01';
        $end = '2020-12-31';
    
           return Excel::download(new AttendanceExport, $start.'-'.$end.'_attendance'.'.xlsx');
  
    
    }
    
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function noclock()
    {
        $noclock = schedule::with('timepunch')
        ->whereHas('timepunch', function($q)
                    {
                    $q->where('time_in', 'NULL');
                    
                    })
                    
        ->where('sin', 'like', '2018-08-24%')->get([
            'schedule.id',
            'schedule.sin',
            'schedule.user_id',
            'employee.first_name',
            'employee.last_name'
            ]);
        
        return view('attendance.noclock', compact('noclock'));
  
                    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        $occurances = AttendanceOccurance::orderBy('id')->get()
                    ->keyBy('id')
                    ->map(function ($occurance){
                        return"{$occurance->label}";
                    });
            
        
        
        return view('attendance.create', compact( 'employees', 'occurances'))->with('success', 'You have added a attendance encounter.');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $attendance = new Attendance;
        $attendance->user_id = $request->user_id;
        $attendance->occurance_type = $request->occurance_type;
        $attendance->schedule_id = $request->schedule_id;
        $attendance->date = $request->date_submit;
        $attendance->added_by = Auth::User()->id;
        $attendance->note = $request->note;
        
        $attendance->save();
        /*
        $schedule = schedule::find($request->schedule_id);
        $schedule->status = $request->status;
        
        $schedule->save();
        */
        
        $date = $request->date_submit;
        
        $employee = Employee::where('user_id', $request->user_id)->first()->toArray();
        
        if($attendance->type->points >0){
            $attendance->toArray();
            Mail::to($employee['email'])->send(new AttedanceMail($attendance));
        }

        return back()->with(compact('date'));
    }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function multi_store(Request $request)
    {
        
        
        $attendance = new Attendance;
        $attendance->user_id = $request->user_id;
        $attendance->occurance_type = $request->occurance_type;
        $attendance->schedule_id = $request->schedule_id;
        $attendance->date = $request->date_submit;
        $attendance->added_by = Auth::User()->id;
        $attendance->note = $request->note;
        
        $attendance->save();
        /*
        $schedule = schedule::find($request->schedule_id);
        $schedule->status = $request->status;
        
        $schedule->save();
        */
        
        $date = $request->date_submit;
        
        return back()->with(compact('date'));
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
        $attendance = Attendance::with('type')->find($id);
        
        $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        $occurances = AttendanceOccurance::orderBy('id')->get()
                    ->keyBy('id')
                    ->map(function ($occurance){
                        return"{$occurance->label}";
                    });
            
        
        
        return view('attendance.edit', compact('attendance', 'employees', 'occurances'));
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
        $attendance = Attendance::find($id);
        $attendance->user_id = $request->user_id;
        $attendance->occurance_type = $request->occurance_type;
        $attendance->schedule_id = $request->schedule_id;
        $attendance->date = $request->date_submit;
        $attendance->added_by = Auth::User()->id;
        $attendance->note = $request->note;
        
        
        $attendance->save();
        /*
        $schedule = schedule::find($request->schedule_id);
        $schedule->status = $request->status;
        
        $schedule->save();
        */
        
        $date = $request->date_submit;
        
        return redirect()->route('attend.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendance = Attendance::find($id);
        
        $attendance->status = 1;
        
        $attendance->save();
        
       return back()->with('success', 'You have sucessfully deleted an occurance'); 
    }
}
