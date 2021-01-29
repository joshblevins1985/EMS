<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Calendar;
use Vanguard\CprClasses;
use Vanguard\Facilities;
use Vanguard\CprClassStudent;
use Vanguard\Employee;
use Vanguard\User;
use Vanguard\CourseDates;
use Vanguard\Observer;
use Vanguard\ObserverDates;

use Vanguard\Notifications\CPRInvoiceNotification;
use Vanguard\Mail\CPRInvoiceMailNotification;
use Vanguard\Mail\CPRInvoiceMailInternalNotification;


use Auth;
use PDF;
use Mail;
use Carbon;
use DateTime;



class CprClassesController extends Controller
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
        

        
        $events = array_merge($cpr, $courses, $observers);
        
       // $calendar = Calendar::addEvents($events);
        
        $facilities= Facilities::orderBy('name')->pluck('name', 'id');
        
        $instructors = Employee::get();
        
        $events = json_encode($events);
        
        $observers = json_encode($observers);
        
        //dd($observers);
        
         return view('cpr.cprcalendar', compact('calendar', 'facilities', 'instructors', 'events', 'observers'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editModal($classId)
    {
        //dd($classId);
        $facilities= Facilities::orderBy('name')->pluck('name', 'id');

        $instructors = Employee::get();

        $class= CprClasses::find($classId);

        return view('cpr.partials.cprEditModalBody', compact('facilities', 'instructors', 'class'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $facility = Facilities::find($request->location);
        
        //$start = $request->date_submit.' '.$request->start;
        
        //$end = $request->date_submit.' '.$request->end;
        
            $cpr = new CprClasses;
            
            $cpr->location = $request->location;
            $cpr->start_date = $request->start;
            $cpr->end_date = $request->end;
            $cpr->is_contract = $facility->contracted;
            $cpr->email = $request->email;
            $cpr->status = '1';
            $cpr->added_by = Auth::User()->id;
            
            $cpr->save();
            
            return redirect()->route('cprclasses.index');
        
    }
    
        /**
     * Store a newly created student to class.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function student(Request $request)
    {
        $addstudent = new CprClassStudent;
        
        $addstudent->class_id = $request->class_id;
        $addstudent->student = $request->student;
        
        $addstudent->save();
            
            return back()->with('success', 'You have added a new student to the class.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cpr = CprClasses::find($id);
        
        return view('cpr.show', compact('cpr'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        $cpr = CprClasses::find($id);
        
       view()->share('cpr',$cpr);
       
        
    	// pass view file
            $pdf = PDF::loadView('cpr.invoicepdf')->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20);
            // download pdf
            return $pdf->download('cprinvoice.pdf');
    }
    
    public function send_invoice($id)
    {
       
       $cpr = CprClasses::find($id)->update(['status' => 3]);
      $cpr = CprClasses::find($id);
      $cid = $id;
      
      
        
       Mail::to(['jblevins@peasi.net', 'jbeery@peasi.net'])->send(new CPRInvoiceMailInternalNotification($id));
       
       
       if($cpr->email)
       {
           
        Mail::to($cpr->email)->send(new CPRInvoiceMailNotification($cid));
       
       }
       
            
        $users = User::whereHas(
            'roles', function($q) {
            $q->where('name', 'company.admin1');
            

        }
        )->get()->toArray();

        //Send out user notification
        foreach ($users as $row)
        {
            User::find($row['id'])->notify(new CPRInvoiceNotification($cid));
        }
        
        
        
        return back()->with('success', 'You have sent an email containing the invoice for this course.');
        
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
