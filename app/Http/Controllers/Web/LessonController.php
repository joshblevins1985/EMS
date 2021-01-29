<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\Http\Controllers\Controller;
use Vanguard\Lesson;
use Vanguard\LessonLog;
use Vanguard\CourseCompletions;
use Vanguard\Classes;
use Vanguard\Courses;
use Vanguard\EnrolledStudent;
use Vanguard\Employee;
use Vanguard\User;

use Auth;

use Vanguard\Notifications\CourseCompleted;

use Illuminate\Http\Request;


class LessonController extends Controller
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
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Lesson::create(request()->all());

        return redirect()->route('courses.show', [$request->course_id]);

    }

    /**
     * Store a newly created resource in storagae.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function lessoncomplete(Request $request)
    {
        $class = Classes::find($request->course);
        //LessonLog::create(request()->all());

        $user_id = $request->user;
        $lesson_id = $request->lesson;
        $course_id = $request->course;
        $class_id = $class->course_id;
 
        if (LessonLog::where('course_id', $course_id)->where('user_id', $user_id)->where('lesson_id', $lesson_id)->exists()) {

        } else {
            $lessonLog = new LessonLog;
            $lessonLog->user_id = $user_id;
            $lessonLog->course_id = $course_id;
            $lessonLog->lesson_id = $lesson_id;
            $lessonLog->save();
        }
        //get course lessons
        $course_lessons = Lesson::where('course_id', $class->course_id)->get();

//get the lessons the user has completed


        $user_lessons = LessonLog::where('user_id', $user_id)->where('course_id', $course_id)->get();


//check if each of the lessons for the course are complete for the user.

        foreach ($course_lessons as $lesson) {
            $completed = false;

            if ($user_lessons->isEmpty()) {
                $completed = false;
            } else {

                foreach ($user_lessons as $user_lesson) {
                    if ($user_lesson->lesson_id == $lesson->id) {
                        $completed = true;
                        break;
                    }
                }
            }
        }
//If $completed is still false, then the user has not completed the course
        if (CourseCompletions::where('course_id', $course_id)->where('user_id', $user_id)->exists()) {

        } else {
            if (!$completed) {

            } else {
                
                $eu = EnrolledStudent::where('user_id', $user_id)->where('class_id', $course_id)->first();
                
                $complete = new CourseCompletions;

                $complete->user_id = $user_id;
                $complete->course_id = $course_id;
                $complete->started =  $eu->created_at;
                $complete->completed= $eu->completed;
                $complete->class_id = $class_id;
                $complete->added_by = '99999';

                $complete->save();

                $enroll = EnrolledStudent::where('class_id', $class->id)->where('user_id', Auth::User()->id)->first();

                $enroll->completed = $complete->created_at;
                $enroll->status = 1;

                $enroll->save();

                $course = Classes::find($course_id);
                $class = Courses::find($course->course_id);
                $employees = Employee::where('user_id', $user_id)->first();

                $employee_name = $employees->first_name . ' ' . $employees->last_name;
                $course_name = $class->title;
                
                $link = "/certificate/$course_id/$user_id";

                User::find($user_id)->notify(new CourseCompleted($employee_name, $course_name, $link));


                $admin_notification = User::where('role_id', 11)->orWhere('role_id', 10)->orWhere('role_id', 9)->get();

                foreach ($admin_notification as $row) {
                    User::find($row->id)->notify(new CourseCompleted($employee_name, $course_name, $link));
                }


            }
        }

        return response()->json(['success' => 1]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
