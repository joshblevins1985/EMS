<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Vimeo\Laravel\Facades\Vimeo;
use Vanguard\Courses;
use Vanguard\Lesson;
use Vanguard\LessonLog;
use Vanguard\Quizes;
use Vanguard\CourseCompletions;
use Vanguard\Classes;
use Vanguard\EnrolledStudent;
use Vanguard\CourseDates;
use Vanguard\Employee;

use Auth;
use PDF;

use Illuminate\Http\Request;

class CoursesController extends Controller
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
        $courses = Classes::where('status', 1)->with('course')->orderBy('order', 'DESC')->paginate('5');
        
        return view('courses.index', compact('courses'));
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
        if(EnrolledStudent::where('class_id', $id)->where('user_id', Auth::User()->id)->exists())
        {
            $enrolled = true;
        }else{
            $enrolled = false;
        }
        
        $student_data = EnrolledStudent::where('class_id', $id)->where('user_id', Auth::User()->id)->first();
        
        $class = Classes::find($id);
        
        $course = Courses::find($class->course_id);
        
        $lessons = Lesson::where('course_id', $class->course_id)->orderBy('order', 'asc')->get();
        $user_lessons = LessonLog::where('user_id', Auth::User()->id)->where('course_id', $course->id)->get();
        
        $quizes= Quizes::where('course_id', $class->course_id)->get();
        
        $complete = CourseCompletions::where('user_id', Auth()->User()->id)->where('course_id', $class->id)->first();
        
        if(!$complete){
            $course_status = 'Incomplete';
        }else{
        $course_status = 'Completed '. date('m-d-Y', strtotime($complete->created_at));
        }
        
        $quiz = Quizes::with('questions', 'questions.answeres')->where('course_id', $class->course_id)->get();
        
        return view('courses.course', compact('class', 'course', 'lessons', 'user_lessons', 'quizes', 'course_status', 'enrolled', 'quiz', 'student_data'));
        
        
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function roster($course_id, $date, $date_id)
    {
        $students = EnrolledStudent::whereHas('student')->with('student')->where('status','>=', 0)->where('class_id', $course_id)->get();
        
        $class = Classes::with('course')->find($course_id);
        
        $cdate = CourseDates::find($date_id);
        
        view()->share('students', $students);
        view()->share('class', $class);
        view()->share('cdate', $cdate);
        
        // pass view file
        $pdf = PDF::loadView('classes.reports.roster')
        ->setPaper('a4', 'landscape')
        ->setOption('margin-left', 5)
        ->setOption('margin-right', 5)
        ->setOption('margin-bottom', 5)
        ->setOption('margin-top', 5);
        // download pdf
        return $pdf->download('course_roster.pdf');
        
        return view('courses.index', compact('courses'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function history($id)
    {
        $hx = Employee::with('enrolledcourses', 'enrolledcourses.instructed', 'enrolledcourses.instructed.lead', 'statecertifications', 'statecertifications.certtype')->find($id);
    
         view()->share('hx',$hx);
       
        
    	// pass view file
            $pdf = PDF::loadView('education.reports.studentclasses')->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20);
            // download pdf
            return $pdf->download('studenthx.pdf');
        
    }
}
