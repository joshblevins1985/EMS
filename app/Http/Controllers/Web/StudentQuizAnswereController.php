<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Vanguard\QuizQuestions;
use Vanguard\QuizQuestionAnswere;
use Vanguard\EnrolledStudent;
use Vanguard\StudentAnsweres;

use Auth;

use Illuminate\Http\Request;

class StudentQuizAnswereController extends Controller
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
        //
    if ($request->ajax()) {
        
        
        $grade = QuizQuestionAnswere::where('question_id', $request->question_id)->where('is_correct', 1)->first();
        
        
            if($grade->id == $request->answere){
            $sgrade = 1;
            }else{
            $sgrade = 0;
            }
        
        
        
      // dd($request->question_id);
        
        $answer= StudentAnsweres::create([
            'student' => Auth::User()->id,
            'question_id' => $request->question_id,
            'answered' => $request->answere,
            'grade' => $sgrade,
            'course_id' => $request->course

        ]);
        
        if($request->end){
            
            $student_answere = StudentAnsweres::where('course_id', $request->course)->get();
            
            $total_q = count($student_answere);
            
            $correct = 0;
            
            foreach($student_answere as $sa)
            {
                if($sa->grade == 1){
                    ++$correct;
                }
            }
            
            $score = $correct / $total_q * 100;
            
            $add_grade = EnrolledStudent::where('user_id', Auth::User()->id)->where('class_id', $request->course)->first();
            
            $add_grade->grade = $score;
            
            $add_grade->save();
            
            
        }else{
            return response($answer);
        }
        
        
    }else{
        return "ajax not done";
    }
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
