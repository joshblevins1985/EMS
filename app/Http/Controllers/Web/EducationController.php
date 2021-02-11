<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\QaQi;
use Vanguard\EmployeeEncounters;
use Vanguard\ObserverDates;
use Vanguard\CprClasses;
use Vanguard\ToDo;
use Vanguard\CourseDates;
use Calendar;
use Vanguard\Facilities;
use Vanguard\CprClassStudent;
use Vanguard\Employee;
use Vanguard\User;
use Vanguard\Observer;
use Vanguard\ItSupportTicket;
use Vanguard\Asset;



use Auth;
use DB;
use Carbon\Carbon; 

use PDF;

class EducationController extends Controller
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
        $qa = QaQi::where('grade', 2)->whereNull('acknowledged')->get();
        
        $nw = QaQi::select('grade',  DB::Raw('MONTH(date) monnum'), DB::Raw('MONTHNAME(date) month'), DB::raw('count(*) as count'))
        ->orderBy('monnum', 'desc')
        ->groupBy('grade', 'month','monnum')    
        ->get();
        
        $empcount = QaQi::with('employee')->select('employee_id', DB::raw('count(*) as count'))
        ->where('grade', 2)
        ->where("date",">", Carbon::now()->subMonths(3))
        ->groupBy('grade', 'employee_id')
        ->get();
        
        $nwavg = $empcount->avg('count');
        
        $nwavg= round($nwavg);
        
        $labels = '"'.$nw->where('grade', 2)->pluck('month')->implode('", "').'"';

        $encounters = EmployeeEncounters::with('Employee', 'Policies')
        ->where('department', 2)
        ->where('status', '<', '4')
        ->paginate('5');
        /*
        $observers = ObserverDates::with('observer', 'preceptors')->whereDate('start', Carbon::today())->get();
        
        $start = date('Y-m-d H:i:s', strtotime('now'));
        
        //dd($start);
        
        $end = date('Y-m-d H:i:s', strtotime($start. '+ 30 days'));
        
        
        $cpr = CprClasses::with('facility')->whereBetween('start_date', array($start, $end))->orderBy('start_date')->get();
        
        */
        
        $qacontact = QaQi::whereNull('acknowledged')->where('grade', 2)->groupBy('employee_id')->get();

        
        $it_tickets = ItSupportTicket::where('status', '<', 3)->orderBy('priority')->get();
        $employees = Employee::get();
        
        $assets = Asset::get();
        
        $cpr = [];
        $data = CprClasses::with('facility')->get();
        if($data->count()) {
            foreach ($data as $key => $value) {
                
           
                $start = new \DateTime($value->start_date);
                $end = new \DateTime($value->end_date);
                $observers[] = [
                    'title' => $value->facility->name,
                    'start' => $start->format('c'),
                    'end' => $end->format('c'),
                    'color' => '#f05050',
                    'classId' => $value->id,
                    'url' => '/cprclasses/'.$value->id,

                    ];
                /*
                $cpr[] = Calendar::event(
                    $value->facility->name,
                    false,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#f05050',

	                ]
                );
                */
            }
        }
        
        $courses = [];
        
        $course = CourseDates::get();
        
        if($course->count()) {
            foreach ($course as $key => $value) {
                
                $start = $value->course_date.' '. $value->start_time;
                $end = $value->course_date.' '.$value->end_time;
                //dd($start);
                $start = new \DateTime($start);
                $end = new \DateTime($end);
            
                $courses[] = [
                    'title' => $value->class_dates->course->title.' '.substr($value->instruct->first_name, 0).'.'.$value->instruct->last_name,
                    'start' => $start->format('c'),
                    'end' => $end->format('c'),
                    'color' => '#062699',
                    'url' => '/classes/'.$value->id,
                    ];
                /*
                $courses[] = Calendar::event(
                    $value->class_dates->course->title.' '.substr($value->instruct->first_name, 0).'.'.$value->instruct->last_name,
                    false,
                    new \DateTime($start),
                    new \DateTime($end),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#062699',
	                    'url' => '/classes/'.$value->class_dates->id,
	                ]
                );
                */
            }
        }
        
        $obervers = [];
        
        $observer = ObserverDates::with('observer', 'preceptors')->get();
        
        
        if($observer->count()) {
            foreach ($observer as $key => $value) {
                //dd($value->start);
                $start = new \DateTime($value->start);
                $end = new \DateTime($value->end);
                $observers[] = [
                    'title' => $value->observer->first_name.' '.$value->observer->last_name,
                    'start' => $start->format('c'),
                    'end' => $end->format('c'),
                    'color' => '#FF338D',
                    'url' => '/observer/'.$value->observer->id,

                    ];
                
                
            }
        }

        $qacount = [];

        $qa = QaQi::select('created_at')->where('created_at', '>=', Carbon::today()->startOfMonth())->get()
        ->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('m');
        });


        if($qa->count()) {
            foreach ($qa as $key => $value) {
                //dd($value->start);
                $start = new \DateTime($value->created_at);
                $end = new \DateTime($value->created_at);
                $qa[] = [
                    'title' => 'QA/QI Completed '. count($value),
                    'start' => $start->format('c'),
                    'end' => $end->format('c'),
                    'color' => '#FF338D',

                ];


            }
        }
        
        
        $todo = ToDo::where('assigned_to', auth()->user()->id)->whereNull('completed')->get();

        $events = array_merge($cpr, $courses, $observers);
        
       // $calendar = Calendar::addEvents($events);
        
        $facilities= Facilities::orderBy('name')->pluck('name', 'id');
        
        $instructors = Employee::get();
        
        $events = json_encode($events);
        
        $observers = json_encode($observers);
        
        //dd($observers);
        
        
        
         return view('education.dashboard', compact('qa','todo','it_tickets', 'facilities', 'instructors', 'events', 'observers', 'nw', 'nwavg', 'empcount', 'encounters', 'labels', 'observers', 'cpr', 'qacontact', 'employees', 'assets'));
       
    
       
    //return view('education.index', compact('nw', 'nwavg', 'empcount', 'encounters', 'labels', 'observers', 'cpr', 'qacontact'));
    }

    /**
     * Produce Daily Report.
     *
     * @return \Illuminate\Http\Response
     */
    public function daily()
    {
        $start = date('Y-m-d H:i:s', strtotime('now'));
        
        //dd($start);
        
        $end = date('Y-m-d H:i:s', strtotime($start. '+ 30 days'));
        
        
        $cpr = CprClasses::with('facility')->whereBetween('start_date', array($start, $end))->orderBy('start_date')->get();
        
        $ceu = CourseDates::with('instruct', 'class_dates.course' )->whereBetween('course_date', array($start, $end))->orderBy('course_date')->get();
        
        $todo = ToDo::with('employee')->where('department', 1)->where('status', 1)->orderBy('expected_complete')->get();
        
        view()->share('cpr', $cpr);
        view()->share('todo', $todo);
        view()->share('ceu', $ceu);
        
        $pdf = PDF::loadView('education.reports.education_daily');
        
        return $pdf->download('daily_education_report.pdf');
        
        
        return view('education.reports.education_daily', compact('cpr', 'todo'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function daily_report()
    {
        $timestamp = time();

        if(date('N', $timestamp) === '1')
        {
            $end = date('Y-m-d H:i:s', strtotime('now'));

            //dd($start);

            $start = date('Y-m-d H:i:s', strtotime($end. '- 2 days'));
            $task = ToDo::whereBetween('completed', array($start, $end))->where('department', 1)->orWhere('assigned_to', 450)->whereBetween('completed', array($start, $end))->get();

            $taskp = ToDo::where('status', 2)->where('department', 1)->orWhere('assigned_to', 450)->where('status', 2)->get();

            $cpr = CprClasses::with('facility')->whereBetween('start_date', array($start, $end))->orderBy('start_date')->get();

            $ceu = CourseDates::with('instruct', 'class_dates.course' )->whereBetween('course_date', array($start, $end))->orderBy('course_date')->get();

            $todo = ToDo::with('employee')->where('department', 1)->where('status','<', 4)->orderBy('expected_complete')->get();

            $encounter= EmployeeEncounters::whereBetween('created_at', array($start, $end))->get();

            $projects = [];

            return view ('emails.training.daily_completed', compact('task', 'taskp', 'cpr', 'ceu', 'encounter', 'timestamp', 'end', 'projects' ));

        }else{
            $task = ToDo::whereDate('completed', Carbon::today())->where('department', 1)->orWhere('assigned_to', 450)->whereDate('completed', Carbon::today())->get();

            $taskp = ToDo::where('status', 2)->where('department', 1)->orWhere('assigned_to', 450)->where('status', 2)->get();

            $cpr = CprClasses::whereDate('start_date', Carbon::today())->get();

            $ceu = CourseDates::with('instruct', 'class_dates', 'class_dates.course')->whereDate('course_date', Carbon::today())->get();

            $encounter= EmployeeEncounters::whereDate('created_at', Carbon::today())->where('department', 2)->get();

            $projects = [];

            return view ('emails.training.daily_completed', compact('task', 'taskp', 'cpr', 'ceu', 'encounter', 'timestamp', 'projects' ));


        }

                
    }
    
        /**
     * Department Schedule.
     *
     * @return \Illuminate\Http\Response
     */
    public function schedule()
    {
            $cpr = [];
        $data = CprClasses::with('facility')->get();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $cpr[] = 
	                [
	                    'title' => $value->facility->name,
	                    'start' => $value->start_date,
	                    'end' => $value->end_date,
	                    'color' => '#f05050',
	                    'url' => 'https://peasi.app/cprclasses/'.$value->id,
	                    'resourceId'=> '511',
	                ];
            }
        }
        
        $courses = [];
        
        $course = CourseDates::get();
        
        if($course->count()) {
            foreach ($course as $key => $value) {
                
                $start = "$value->course_date $value->start_time";
                $end = "$value->course_date $value->end_time";
                
                $courses[] = 
	                [
	                    'title' => $value->class_dates->course->title.' '.substr($value->instruct->first_name, 0).'.'.$value->instruct->last_name,
	                    'start' => $start,
	                    'end' => $end,
	                    'color' => '#062699',
	                    'url' => 'https://peasi.app/classes/'.$value->class_dates->id,
	                    'textColor' => 'white',
	                    'resourceId'=> $value->instruct->user_id,
	                ];
            }
        }
        
        $events = array_merge($cpr, $courses);
        
        $events = json_encode($events);
        
       // dd($events);
        
       
        
        
        return view('education.schedule', compact('events'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
