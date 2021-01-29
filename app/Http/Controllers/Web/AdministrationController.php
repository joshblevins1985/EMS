<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Vanguard\BadRunSheet;
use Vanguard\QaQi;
use Vanguard\UnitReviews;
use Vanguard\DrivingAssessments;
use Calendar;
use Vanguard\CprClasses;
use Vanguard\Observer;
use Vanguard\ObserverDates;
use Vanguard\Employee;
use Vanguard\CourseDates;

use DB;

use Illuminate\Http\Request;



class AdministrationController extends Controller
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
        /**
        $str = 'blevins_joshua_6545854.pdf';
        

        $chars = preg_split('/_/', $str, -1, PREG_SPLIT_NO_EMPTY);
        
        $last_name = $chars[0];
        $first_name = $chars[1];
        $run_number = substr($chars[2], 0, strrpos($chars[2], '.'));
        
        //dd($run_number);
       dd($chars);    
        */
        $brs = BadRunSheet::where('status', '<', '5')->count();
        $brsa = BadRunSheet::where('status', '5')->count();
        
        
        $currentMonth = date('m');
        
        $qa = QaQi::whereRaw('MONTH(created_at) = ?',[$currentMonth])->avg('percent');
        
        $now = date('Y-m-d', strtotime('now'));
        
        $quarter = DB::table('quarters')
        ->where(function ($query) use ($now) {
        $query->where('start', '<=', $now);
        $query->where('end', '>=', $now);
        })->first();
        
        $unitreview = UnitReviews::whereBetween('date_reviewed', array($quarter->start, $quarter->end))->count();
        
        $driverpercent = DrivingAssessments::whereBetween('date_of_evaluation', array($quarter->start, $quarter->end))->avg('performance_rating');
        
        $drivertime = DrivingAssessments::whereBetween('date_of_evaluation', array($quarter->start, $quarter->end))->sum('total_time');
        
        return view('administration.index', compact('brs', 'qa', 'unitreview', 'driverpercent', 'brsa', 'drivertime'));
        
    }
    
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
       $observers = Observer::get();
        
        $events = [];
        $data = ObserverDates::with('observer', 'preceptors')->get();
        
        
        if($data->count()) {
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->observer->first_name.' '.$value->observer->last_name,
                    false,
                    new \DateTime($value->start),
                    new \DateTime($value->end),
                    null,
                    // Add color and link on event
                    [
                        'color' => '#f05050',
                        'url' => 'https://emscomplete.app/observer/'.$value->observer->id,
                    ]
                );
            }
        }
        
        $cpr = CprClasses::with('facility')->get();
        if($cpr->count()) {
            foreach ($cpr as $key => $value) {
                $events[] = Calendar::event(
                    $value->facility->name,
                    false,
                    new \DateTime($value->start_date),
                    new \DateTime($value->end_date),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#006400',
	                    'url' => 'https://emscomplete.app/cprclasses/'.$value->id,
	                ]
                );
            }
        }
        
        $courses = CourseDates::with('class_dates', 'class_dates.course')->get();
        if($courses->count()) {
            foreach ($courses as $key => $value) {
                $start = $value->course_date.' '.$value->start_time;
                $end = $value->course_date.' '.$value->end_time;
                $events[] = Calendar::event(
                    $value->class_dates->course->title,
                    false,
                    new \DateTime($start),
                    new \DateTime($end),
                    null,
                    // Add color and link on event
	                [
	                    'color' => '#0000FF',
	                    'url' => 'https://emscomplete.app/classes/'.$value->class_dates->id,
	                ]
                );
            }
        }
        
        
        $calendar = Calendar::addEvents($events);

        $employees = Employee::orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
        
        return view('administration.calander', compact('observers','calendar', 'employees', 'cpr'));
        
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
