<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;


use Vanguard\Employee;
use Vanguard\CourseCompletions;
use Vanguard\MobileCarrier;
use Vanguard\EmployeePositions;
use Vanguard\Station;
use Vanguard\Courses;
use Vanguard\Classes;
use Vanguard\BucyrusIncidents;

use Carbon;

use PDF;
use DB;
use Auth;

class HumanResourcesController extends Controller
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
        
        $btd = Employee::where('driver', 5)->where('status', '<', 8)->get();
        
        $ftoems = Employee::where('driver', 5)->where('status', '<', 8)->get();
        
        $ftowc = Employee::where('driver', 5)->where('status', '<', 8)->get();
        
        $medic_count = Employee::where('primary_position', 5)->where('status', 5)->count();
        
        $aemt_count = Employee::where('primary_position', 4)->where('status', 5)->count();
        
        $emt_count = Employee::where('primary_position', 3)->where('status', 5)->count();
        
        $cct_count = Employee::where('primary_position', 8)->where('status', 5)->count();
        
        $wc_count = Employee::where('primary_position', 11)->where('status', 5)->count();
        
        $dispatcher_count = Employee::where('primary_position', 2)->where('status', 5)->count();
        
        $e_driver_count = Employee::where('driver', 1)->where('status', 5)->count();
        
        $n_driver_count = Employee::where('driver', 6)->where('status', 5)->count();
        
        $btd_count = Employee::where('driver', 5)->where('status', 5)->count();
        
        $non_driver_count = Employee::where('driver', 0)->where('status', 5)->count();
        
        $courses = CourseCompletions::with('employee', 'classesfrom.course')->whereDate('created_at', Carbon::today())->get();
        
        $orientation = Employee::where('status', '3')->get(); 
        
        $ftoems = Employee::with('fieldtraining', 'fieldtraining.fto')->where('status', '4')->whereBetween('primary_position', array('3', '9'))->get(); 
        
        $ftowc = Employee::where('status', '3')->where('primary_position', '11')->get(); 
        
        $driving = Employee::whereBetween('driver', [2,4])->where('status', 5)->orderBy('driver_step')->get();
        
        $user = Auth::user();
        $mobilecarriers = MobileCarrier::pluck('label', 'id');
        $employeepositions = EmployeePositions::pluck('label', 'id');
        $station = Station::pluck('station', 'id');
        
        
        
        return view('hr.index', compact('btd', 'ftoems', 'ftowc', 'medic_count', 'aemt_count', 'emt_count', 'cct_count', 'wc_count', 'dispatcher_count', 'e_driver_count', 'n_driver_count', 'btd_count', 'non_driver_count', 'courses', 'orientation', 'ftoems', 'ftowc', 'driving', 'user', 'mobilecarriers', 'employeepositions', 'station'));
    }


    /**
     * Display a listing of stations.
     *
     * @return \Illuminate\Http\Response
     */
    public function stations()
    {
        
        $stations = Station::where('status', 0)
        ->with(['employees' => function($q){
            $q->where('status', '>', 1);
            $q->where('status', '<', 8);
        }])
        ->orderBy('station')->get();
        
        return view('hr.stations', compact('stations'));
    }
    
     /**
     * Display a listing of stations.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdf()
    {
        

        
        return view('hr.pdftest');
    }
    
    /**
     * Display a listing of stations.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
       $compare_start = date("Y-m-d", strtotime("first day of previous month"));
       $compare_end = date("Y-m-d", strtotime("last day of previous month"));
       
       $start = date('Y-m-01', strtotime('- 1 year'));
       $end = date('Y-m-d');
       
       $employee = Employee::
       selectRaw('count(*) as count_all')
       ->selectRaw('sum(if(status = 5, 1,0)) as count_active')
       ->selectRaw("sum(if(status = 8 AND updated_at BETWEEN '$end' AND '$start', 1,0)) as count_term")
       ->selectRaw("sum(if(status = 8 AND updated_at BETWEEN '$compare_start' AND '$compare_end', 1,0)) as count_term_compare")
       ->first() ;
            
            //dd($employee);
       
       $total = $employee->count_active + $employee->count_all; 
       $average = $total/ 2 ;   
       $to = $employee->count_term / $average * 100; echo round($to);
       $toc = $employee->count_term_compare / $average * 100; echo round($to);
       
       //dd($employee->count_term);
       
       $data = array(
           'company_attrition' => round($to),
           'company_attrition_compare' => round($toc)
           );
           
        $chute_n = BucyrusIncidents::where('chute_calc', '>', 0)->where('incident_type', '2')->avg('chute_calc');
        
        $chute_e = BucyrusIncidents::where('chute_calc', '>', 0)->where('incident_type', '1')->avg('chute_calc');
        
        $response = BucyrusIncidents::whereNotNull('response_calc')->avg('response_calc');
        
        $total = BucyrusIncidents::where('total_calc', '>', 0)->avg('total_calc');

        $runType = BucyrusIncidents::with('call_type')
            ->select('incident_call_type' , DB::raw('count(*) as incident_typeCount'))
            ->groupBy('incident_call_type')->get();
            
        $stats = BucyrusIncidents::with('call_type')
        ->groupBy('incident_call_type')
        ->get([
            DB::raw('incident_call_type as label'),
            DB::raw('COUNT(*) as value')
        ])
        ->toJson();
        
            
            $runType = $runType->mapWithKeys(function ($runType){
                return [$runType->call_type->description => $runType->incident_typeCount];
            })->toArray();
        
        $json = json_encode($runType, JSON_FORCE_OBJECT);
        
       // dd($combined);
       // dd($stats);
        
        return view('dashboard.newAdmin', compact('data', 'runType', 'chute_n', 'chute_e', 'response', 'total', 'stats'));
    }
    
    public function adminFilter()
    {
       $compare_start = date("Y-m-d", strtotime("first day of previous month"));
       $compare_end = date("Y-m-d", strtotime("last day of previous month"));
       
       $start = date('Y-m-01', strtotime('- 1 year'));
       $end = date('Y-m-d');
       
       $employee = Employee::
       selectRaw('count(*) as count_all')
       ->selectRaw('sum(if(status = 5, 1,0)) as count_active')
       ->selectRaw("sum(if(status = 8 AND updated_at BETWEEN '$end' AND '$start', 1,0)) as count_term")
       ->selectRaw("sum(if(status = 8 AND updated_at BETWEEN '$compare_start' AND '$compare_end', 1,0)) as count_term_compare")
       ->first() ;
            
            //dd($employee);
       
       $total = $employee->count_active + $employee->count_all; 
       $average = $total/ 2 ;   
       $to = $employee->count_term / $average * 100; echo round($to);
       $toc = $employee->count_term_compare / $average * 100; echo round($to);
       
       //dd($employee->count_term);
       
       $data = array(
           'company_attrition' => 50,
           'company_attrition_compare' => round($toc)
           );

        
        return $data;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function driver_pdf(Request $request)
    {
        if($request->driver == 0 || $request->driver == 1 || $request->driver == 2 || $request->driver == 3 || $request->driver == 4 || $request->driver == 5){
           $employees = Employee::where('driver', $request->driver)->where('status', 5)->orderBy('dod', 'asc')->get(); 
           if($request->driver == 0){
               $status="Non-Drivers";
           }elseif($request->driver == 1){
               $status="Active Drivers";
           }elseif($request->driver == 2){
               $status="30 - Step 1";
           }elseif($request->driver == 3){
               $status="30 - Step 2";
           }elseif($request->driver == 4){
               $status="30 - Step 3";
           }elseif($request->driver == 5){
               $status="BTD Program";
           }elseif($request->driver == 6){
               $status="All Employees";
           }
        }else{
            $employees = Employee::where('status', 5)->get();
        }
        

        view()->share('employees', $employees);
        view()->share('status', $status);

        // pass view file
        $pdf = PDF::loadView('hr.reports.driver')->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 5)->setOption('margin-top', 5);
        // download pdf
        return $pdf->download('driver_report.pdf');

        return view('hr.index');
    }
    
    public function required_course_report()
    {
        
        
        $courses = Courses::with(['instructed' => function ($q){ $q->groupBy('course_id');}], 'instructed.complete', 'instructed.complete.employee' , 'instructed.course')->where('required', 1)->get();
        
      
        
        return view('hr.required_courses', compact('courses'));
    }
    
    public function update_cc()
    {
        $cc = CourseCompletions::where('course_id', '>' , 11)->get();
        
        foreach ($cc as $c)
        {
            $course = Classes::where('id', $c->course_id)->first();
            
            $u = CourseCompletions::find($c->id);
            
            $u->class_id = $course->course_id;
            
            $u->save();
        }
        
       
    }
}
