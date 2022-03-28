<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Courses;
use Vanguard\Classes;
use Vanguard\Employee;
use Vanguard\EmployeePositions;
use Vanguard\EnrolledStudent;
use Vanguard\CourseDates;
use Vanguard\Station;


use Auth;
use PDF;
class ClassesController extends Controller
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
        $classes = Classes::with('students')->orderBy('start')->paginate(15);
        
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $edit = false;
        
        $courses = Courses::orderBy('title')->get();
        
        $instructors = Employee::where('status', 5)->get();
        
        $levels = EmployeePositions::get();
        
        return view('classes.create', compact('courses', 'instructors', 'levels', 'edit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year_count = Classes::where('recert', $request->recert)->count();
        
        $year_count = $year_count + 1;
        
        $iid = 'C-'. $request->type .'-'. $request->recert .'-'.sprintf('%05d', $year_count );
        
        
        
        
        $class = new Classes;
        
        $class->course_id = $request->course_id;
        $class->start = $request->start_submit;
        $class->end = $request->end_submit;
        $class->type = $request->type;
        $class->location = $request->location;
        $class->required = $request->required;
        $class->status = $request->status;
        $class->recert = $request->recert;
        $class->insturctor = $request->instructor;
        $class->iid = $iid;
        $class->level = json_encode($request->level);
        
        
        $class->save();
        
        return redirect()->route('classes.index');
        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = Employee::where('status', '>', 0)->orderBy('last_name')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        $employee = Employee::with('employeepositions')->where('status', '>', 0)->orderBy('last_name')->get();
        
        $stations = Station::get();
        
        $levels = EmployeePositions::get();
        
        $class = Classes::with('students', 'course_dates', 'course_dates.instruct')->find($id);
        
        $enrolled = EnrolledStudent::with(['student' => function($query)  {
          
            $query->orderBy('last_name');
          
        }])->where('class_id', $id)->paginate(20);
        
        return view('classes.show', compact('class', 'enrolled', 'employees', 'employee', 'stations', 'levels'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  int  $student
     * @return \Illuminate\Http\Response
     */
    public function certificate($id, $student)
    {
        $class = Classes::with('course', 'course.topic')->find($id);
        
        $enrolled = EnrolledStudent::with('student')->where('class_id', $id)->where('user_id', $student)->first();

      view()->share('class',$class);
      view()->share('enrolled', $enrolled);
        
    	// pass view file
            $pdf = PDF::loadView('classes.certificate')->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20)->setOrientation('landscape');
            // download pdf
         //   return $pdf->download('coursecert.pdf');
            
        return view('classes.certificate', compact('class', 'enrolled'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = true;
        
        $courses = Courses::orderBy('title')->get();
        
        $instructors = Employee::where('status', 5)->get();
        
        $levels = EmployeePositions::get();
        
        $class = Classes::find($id);
        
        return view('classes.edit', compact('edit', 'class', 'courses', 'instructors', 'levels'));
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
        $levels = $request->level;
        
        if(empty($levels)){
          $class = Classes::find($id);
        
        $class->course_id = $request->course_id;
        $class->start = $request->start_submit;
        $class->end = $request->end_submit;
        $class->type = $request->type;
        $class->location = $request->location;
        $class->required = $request->required;
        $class->status = $request->status;
        $class->recert = $request->recert;
        $class->insturctor = $request->instructor;
       
        
        
        $class->save();  
        }else{
            
            $levels = implode(',', $levels);
            
            $class = Classes::find($id);
        
        $class->course_id = $request->course_id;
        $class->start = $request->start_submit;
        $class->end = $request->end_submit;
        $class->type = $request->type;
        $class->location = $request->location;
        $class->required = $request->required;
        $class->status = $request->status;
        $class->recert = $request->recert;
        $class->insturctor = $request->instructor;
        $class->level = $levels;
        
        
        $class->save();
        }
        
        
        
        return redirect()->route('classes.index');
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function dailycoursepdf()
    {
        $classes = Classess::with(['enrolled',function($query) use ($id){
     $query->where('departamento_id', '=', $id);
}]);


    }
}
