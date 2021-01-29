<?php

namespace Vanguard\Http\Controllers\Web;

use Vanguard\ClassroomTopicTracking;
use Vanguard\Events\QuizComplete;
use Vanguard\Http\Controllers\Controller;

use Vanguard\ClassRoom;
use Vanguard\ClassRoomSectionTopic;
use Vanguard\ClassroomQuiz;
use Vanguard\QuizQuestionAnswere;
use Vanguard\StudentAnsweres;
use Vanguard\EnrolledStudent;
use Vanguard\ClassRoomQuizAttempt;
use Vanguard\ClassRoomQuizStudentResponse;
use Vanguard\ClassRoomQuizQuestions;
use Vanguard\ClassRoomQuizAnswer;
use Vanguard\ClassRoomStudentGrade;
use Vanguard\ClassRoomGrade;
use Vanguard\ClassRoomInstructor;
use Vanguard\ClassRoomEnrolledStudent;
use Vanguard\Events\StudentHasViewedSectionEvent;
use Vanguard\Employee;

use Illuminate\Http\Request;
use Embed;
use Carbon\Carbon;
use PDF;
use Vanguard\Station;

class ClassroomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard($id)
    {
        $classroom = ClassRoom::with('sections', 'sections.topics', 'sections.topics.tracking', 'gradeBook', 'gradeBook.userGrades', 'documents')->find($id);

        $userHistory = ClassroomTopicTracking::where('classroom_id', $classroom->id)->where('user_id', Auth()->user()->id)->get();

        $instructors = ClassRoomInstructor::where('classroom_id', $id)->where('user_id', auth()->user()->id)->first();


        if ($instructors) {
            $instructor = true;

            // dd($instructor);
        } else {
            $instructor = false;
        }

        return view('classroom.dashboard', compact('classroom', 'instructors', 'instructor', 'userHistory'));
    }

    public function connectEmployee(Request $request)
    {
        // dd($request);
        $classroom = ClassRoomEnrolledStudent::find($request->student_id);

        $classroom->user_id = $request->user_id;

        $classroom->save();

        return redirect()->route('classroom', ['id' => $classroom->classroom_id]);

    }

    public function addQuiz(Request $request)
    {
        //dd('Quiz Created.');
        //dd($request->due_date);
        $dueDate = $request->due_date;
        $dueDate = date('Y-m-d', strtotime($dueDate));

        //dd($dueDate);

        $quizCreate = new ClassroomQuiz;

        $quizCreate->title = $request->label;
        $quizCreate->classroom_id = $request->classroom_id;
        $quizCreate->status = 1;
        $quizCreate->save();

        $topicCreate = new ClassRoomSectionTopic;

        $topicCreate->classroom_id = $request->classroom_id;
        $topicCreate->section_id = $request->section_id;
        $topicCreate->type = 2;
        $topicCreate->label = $request->label;
        $topicCreate->due_date = $dueDate;
        $topicCreate->pid = $quizCreate->id;
        $topicCreate->status = 1;
        $topicCreate->required = $request->required;
        $topicCreate->instructions = $request->content;

        $topicCreate->save();

        if($request->graded){
            //New Event to add to graded book
        }
        return redirect()->route('classroom', ['id' => $request->classroom_id]);

        //return view('classroom.dashboard', compact('classroom', 'instructor'));
    }

    public function addYoutube(Request $request)
    {
        //dd('Quiz Created.');
        //dd($request->due_date);
        $dueDate = $request->due_date;
        $dueDate = date('Y-m-d', strtotime($dueDate));

        //dd($dueDate);
        $topicCreate = new ClassRoomSectionTopic;

        $topicCreate->classroom_id = $request->classroom_id;
        $topicCreate->section_id = $request->section_id;
        $topicCreate->link = $request->link;
        $topicCreate->type = 3;
        $topicCreate->label = $request->label;
        $topicCreate->due_date = $dueDate;
        $topicCreate->status = 1;
        $topicCreate->required = $request->required;
        $topicCreate->instructions = $request->content;

        $topicCreate->save();


        return redirect()->route('classroom', ['id' => $request->classroom_id]);


    }

    public function addVimeo(Request $request)
    {
        //dd('Quiz Created.');
        //dd($request->due_date);
        $dueDate = $request->due_date;
        $dueDate = date('Y-m-d', strtotime($dueDate));

        //dd($dueDate);
        $topicCreate = new ClassRoomSectionTopic;

        $topicCreate->classroom_id = $request->classroom_id;
        $topicCreate->section_id = $request->section_id;
        $topicCreate->link = $request->link;
        $topicCreate->type = 6;
        $topicCreate->label = $request->label;
        $topicCreate->due_date = $dueDate;
        $topicCreate->status = 1;
        $topicCreate->required = $request->required;
        $topicCreate->instructions = $request->content;

        $topicCreate->save();


        return redirect()->route('classroom', ['id' => $request->classroom_id]);


    }

    public function addPdf(Request $request)
    {
        $filename = str_replace(' ', '', $request->file->getClientOriginalName());

        $request->file->storeAs('classroomFiles', $filename);

        //dd('Quiz Created.');
        //dd($request->due_date);
        $dueDate = $request->due_date;
        $dueDate = date('Y-m-d', strtotime($dueDate));

        //dd($dueDate);
        $topicCreate = new ClassRoomSectionTopic;

        $topicCreate->classroom_id = $request->classroom_id;
        $topicCreate->section_id = $request->section_id;
        $topicCreate->link = $filename;
        $topicCreate->type = 4;
        $topicCreate->label = $request->label;
        $topicCreate->due_date = $dueDate;
        $topicCreate->status = 1;
        $topicCreate->required = $request->required;
        $topicCreate->instructions = $request->content;

        $topicCreate->save();


        return redirect()->route('classroom', ['id' => $request->classroom_id]);


    }

    public function addPpt(Request $request)
    {
        $filename = str_replace(' ', '', $request->file->getClientOriginalName());

        $request->file->storeAs('classroomFiles', $filename);

        //dd('Quiz Created.');
        //dd($request->due_date);
        $dueDate = $request->due_date;
        $dueDate = date('Y-m-d', strtotime($dueDate));

        //dd($dueDate);
        $topicCreate = new ClassRoomSectionTopic;

        $topicCreate->classroom_id = $request->classroom_id;
        $topicCreate->section_id = $request->section_id;
        $topicCreate->link = $filename;
        $topicCreate->type = 5;
        $topicCreate->label = $request->label;
        $topicCreate->due_date = $dueDate;
        $topicCreate->status = 1;
        $topicCreate->required = $request->required;
        $topicCreate->instructions = $request->content;

        $topicCreate->save();


        return redirect()->route('classroom', ['id' => $request->classroom_id]);


    }

    public function quizAttempts($pid)
    {
        $quiz = ClassroomQuiz::with('question', 'question.answers')->find($pid);

        $instructors = ClassRoomInstructor::where('classroom_id', $quiz->classroom_id)->where('user_id', auth()->user()->id)->first();

        if ($instructors) {
            $instructor = true;

            // dd($instructor);
        } else {
            $instructor = false;
        }

        return view('classroom.quiz', compact('quiz', 'instructor'));
    }

    public function quizQuestion($aid, $qid)
    {
        $studentResponse = ClassRoomQuizStudentResponse::where('user_id', auth()->user()->id)->where('attempt_id', $aid)->orderBy('question_id', 'desc')->first();

        if ($studentResponse) {

            $quiz = ClassroomQuizQuestions::where('quiz_id', $qid)->where('id', '>', $studentResponse->question_id)->first();
        } else {
            $quiz = ClassroomQuizQuestions::where('quiz_id', $qid)->first();
        }


        return view('classroom.quizQuestion', compact('quiz', 'aid', 'qid'));
    }

    public function addQuestion(Request $request)
    {
        $q = new ClassRoomQuizQuestions;
        $q->quiz_id = $request->qid;
        $q->label = $request->label;

        $q->save();

        return back();
    }

    public function addAnswer(Request $request)
    {
        $q = new ClassRoomQuizAnswer;
        $q->question_id = $request->qid;
        $q->answer = $request->label;
        $q->is_correct = $request->is_correct;

        $q->save();

        return back();
    }

    public function quizQuestionAnswered(Request $request, $aid, $qid, $questionId)
    {
        $studentAnswer = new ClassRoomQuizStudentResponse;

        $studentAnswer->user_id = auth()->user()->id;
        $studentAnswer->attempt_id = $aid;
        $studentAnswer->question_id = $questionId;
        $studentAnswer->answered = $request->answer;

        $answerCheck = ClassRoomQuizAnswer::where('id', $request->answer)->first();
        if ($answerCheck->is_correct) {
            $grade = 1;
        } else {

            $grade = 0;
        }

        $studentAnswer->grade = $grade;

        $studentAnswer->save();


        $studentResponse = ClassRoomQuizStudentResponse::where('user_id', auth()->user()->id)->where('attempt_id', $aid)->orderBy('question_id', 'desc')->first();

        if ($studentResponse) {

            $quiz = ClassroomQuizQuestions::where('quiz_id', $qid)->where('id', '>', $studentResponse->question_id)->first();

            if ($quiz) {
                return view('classroom.quizQuestion', compact('quiz', 'aid', 'qid'));
            } else {
                $studentResponses = ClassRoomQuizStudentResponse::where('user_id', auth()->user()->id)->where('attempt_id', $aid)->get();

                if ($studentResponses) {
                    $total = count($studentResponses);
                    $correct = count($studentResponses->where('grade', 1));
                    //dd($total);
                    $percent = $correct / $total * 100;

                    $percent = round($percent, 2);

                    $updateAttempt = ClassRoomQuizAttempt::find($aid);

                    $updateAttempt->grade = $percent;
                    $updateAttempt->completed = Carbon::now()->toDateTimeString();

                    $updateAttempt->save();

                    $topic = ClassRoomSectionTopic::where('pid', $qid)->first();

                    event(new StudentHasViewedSectionEvent($topic));

                    if ($topic->grade) {
                        $gradeBook = ClassRoomGrade::where('topic_id', $topic->id)->first();

                        if ($gradeBook) {
                            $studentGradeBook = ClassRoomStudentGrade::where('user_id', auth()->user()->id)->where('gradeBookId', $gradeBook->id)->first();

                            if ($studentGradeBook) {
                                if ($percent > $studentGradeBook->grade) {
                                    $message = "Your last attempt on this assessment was better thean the original grade and the gradebook has been updated.";
                                    //dd($percent.' updated ');
                                    return view('classroom.quizResult', compact('percent', 'message'));
                                } else {
                                    $message = "Your last attempt on this assessment was not greater than the original grade, no changes were made.";
                                    //dd($percent.' no added ');
                                    return view('classroom.quizResult', compact('percent', 'message'));
                                }
                            } else {

                                $addStudentGradeBook = new ClassRoomStudentGrade;

                                $addStudentGradeBook->user_id = auth()->user()->id;
                                $addStudentGradeBook->gradeBookId = $gradeBook->id;
                                $addStudentGradeBook->grade = $percent;

                                $addStudentGradeBook->save();
                                //dd($percent.' added to gradebook');
                                $message = "Your grade has been submitted to your instructor and should be available in your gradebook shortly.";
                                return view('classroom.quizResult', compact('percent', 'message'));
                            }
                        } else {
                        }
                    } else {
                        $message = "This assessment is not a requirement for your course.";
                        return view('classroom.quizResult', compact('percent', 'message'));
                    }
                }
            }
        } else {
        }


        return view('classroom.quizQuestion', compact('quiz', 'aid', 'qid'));
    }

    public function newQuizAttempt($qid)
    {
        $attempt = new ClassRoomQuizAttempt;

        $attempt->user_id = auth()->user()->id;
        $attempt->quiz_id = $qid;

        $attempt->save();

        return back();
    }

    public function youTube($id)
    {

        $topic = ClassRoomSectionTopic::find($id);

        event(new StudentHasViewedSectionEvent($topic));

        $embed = Embed::make($topic->link)->parseUrl();
        // Will return Embed class if provider is found. Otherwise will return false - not found. No fancy errors for now.
        if ($embed) {
            // Set width of the embed.
            $embed->setAttribute(['width' => 600]);

            // Print html: '<iframe width="600" height="338" src="//www.youtube.com/embed/uifYHNyH-jA" frameborder="0" allowfullscreen></iframe>'.
            // Height will be set automatically based on provider width/height ratio.
            // Height could be set explicitly via setAttr() method.
            return $embed->getHtml();
        }
        return 'Video Added';
    }


    public function quizAnswerStore(Request $request)
    {
        //
        if ($request->ajax()) {


            $grade = QuizQuestionAnswere::where('question_id', $request->question_id)->where('is_correct', 1)->first();


            if ($grade->id == $request->answere) {
                $sgrade = 1;
            } else {
                $sgrade = 0;
            }


            // dd($request->question_id);

            $answer = StudentAnsweres::create([
                'student' => Auth::User()->id,
                'question_id' => $request->question_id,
                'answered' => $request->answere,
                'grade' => $sgrade,
                'course_id' => $request->course

            ]);

            if ($request->end) {

                $student_answere = StudentAnsweres::where('course_id', $request->course)->get();

                $total_q = count($student_answere);

                $correct = 0;

                foreach ($student_answere as $sa) {
                    if ($sa->grade == 1) {
                        ++$correct;
                    }
                }

                $score = $correct / $total_q * 100;
                $quiz_id = $request->course;

                event(new QuizComplete($score, $quiz_id));
                /*
            $add_grade = EnrolledStudent::where('user_id', Auth::User()->id)->where('class_id', $request->course)->first();
            
            $add_grade->grade = $score;
            
            $add_grade->save();
            */
            } else {
                return response($answer);
            }
        } else {
            return "ajax not done";
        }
        return 'Answer stored';
    }

    public function getDownload($tid, $fileName)
    {
        //dd($tid);

        $topic = ClassRoomSectionTopic::find($tid);

        event(new StudentHasViewedSectionEvent($topic));

        //dd($topic);
        //PDF file is stored under project/public/download/info.pdf

        $file = storage_path() . "/app/classroomFiles/" . $fileName;


        // Set headers
        $headers = array(
            'Content-type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename=filename=file.pdf'
        );


        return response()->download($file, $fileName, $headers);

    }

    public function certificate($id)
    {
        $student = ClassRoomEnrolledStudent::find($id);

        view()->share('student', $student);


        // pass view file
        $pdf = PDF::loadView('classroom.certificate')->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20)->setOrientation('landscape');
        // download pdf
        return $pdf->download($student->employee->last_name . '_' . $student->employee->first_name . '_coursecert.pdf');
    }

    public function rosterByStation($id)
    {
        $class = ClassRoom::find($id);

        $stations = Station::get();

        return view('classroom.reports.rosterByStation', compact('class', 'stations'));
    }

    public function courseMenu()
    {
        $courses = ClassRoom::get();

        return view('classroom.menu', compact('courses'));
    }

}
