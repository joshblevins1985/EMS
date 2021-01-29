<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\EnrolledStudent;
use Vanguard\Classes;
use Vanguard\CourseCompletions;
use Vanguard\Employee;
use Auth;

class EnrolledStudentController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $students = $request->user_id;
        
        //dd($students);
        
        foreach($students as $key => $row){
            
            $enroll = new EnrolledStudent;
        
            $enroll->class_id = $request->class_id;
            $enroll->user_id = $row;
            $enroll->status = 0;
            
            $enroll->save();    
        }
        
        return redirect('classes/'.$request->class_id);
    }
    
    public function group(Request $request)
    {
        $stations = $request->station;
        $levels = $request->level;
       // dd($stations);
      // dd($levels);
        
        foreach($stations as $key => $srow){
            
            foreach($levels as $key => $lrow){
                //dd($row);
                $employees = Employee::where('primary_position', $lrow)->where('primary_station', $srow)->where('status', 5)->get();
                
                foreach ($employees as $emp){
                    
                    if(EnrolledStudent::where('class_id', $request->class_id)->where('user_id', $emp->user_id)->exists()){
                        
                    }else{
                        $enroll = new EnrolledStudent;
        
                        $enroll->class_id = $request->class_id;
                        $enroll->user_id = $emp->user_id;
                        $enroll->status = 0;
                        
                        $enroll->save(); 
                    }
                    
                }
            }
            
               
        }
        
        return redirect('classes/'.$request->class_id);
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
        $enroll = new EnrolledStudent;
        
        $enroll->class_id = $id;
        $enroll->user_id = Auth::User()->id;
        $enroll->status = 0;
        
        $enroll->save();
        
        return redirect('courses/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $courseId)
    {
        $enroll = EnrolledStudent::where('class_id', $courseId)->where('user_id', $id)->first();
        
        $enroll->delete();
        
         return redirect()->back()->with('success', ['You have removed the employee from the course.']); 
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function complete(Request $request)
    {
        $class = Classes::find($request->class_id);
        // Check if user want to complete all students//
        
        if($request->user_id == 0){
            $students = EnrolledStudent::where('class_id', $class->id)->where('status', 0)->get();
            
            //dd($students);
            
            
            foreach ($students as $student)
            {
                
                $complete = new CourseCompletions;
            
                $complete->user_id = $student->user_id;
                $complete->course_id = $class->id;
                $complete->added_by = Auth::User()->id;
                
                $complete->save();
                
                $enroll = EnrolledStudent::where('class_id', $class->id)->where('user_id', $student->user_id)->first();
                
                
                
                $enroll->completed = $request->date_submit;
                $enroll->status = 1;
                
                $enroll->save();
                
               // dd($enroll);
                
            }
            
        }else{
            $class = Classes::find($request->class_id);
        
            $complete = new CourseCompletions;
        
            $complete->user_id = $request->user_id;
            $complete->course_id = $class->id;
            $complete->added_by = Auth::User()->id;
            
            $complete->save();
            
            $enroll = EnrolledStudent::where('class_id', $class->id)->where('user_id', $request->user_id)->first();
            
            $enroll->completed = $request->date_submit;
            $enroll->status = 1;
            
            $enroll->save();
        }
        
    
    return redirect()->back()->with('success', ['You have completed the employee in the course.']); 
    }
}
