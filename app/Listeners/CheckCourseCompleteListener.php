<?php

namespace Vanguard\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;
use Log;

use Vanguard\ClassRoom;
use Vanguard\ClassRoomSectionTopic;
use Vanguard\ClassRoomEnrolledStudent;
use Vanguard\ClassroomTopicTracking;
use Vanguard\User;

use Vanguard\Notifications\CourseCompleted;

class CheckCourseCompleteListener
{


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {

        //dd($event->topic->section->classroom_id); 

        $classTopics = ClassRoomSectionTopic::where('classroom_id', $event->topic->section->classroom_id)->where('required', 1)->get();
        $classroom = ClassRoom::find($event->topic->section->classroom_id);
        $student = ClassRoomEnrolledStudent::where('classroom_id', $event->topic->section->classroom_id)->where('user_id', auth()->user()->id)->first();
        $admin_notification = User::where('role_id', 11)->orWhere('role_id', 10)->orWhere('role_id', 9)->get();
        //dd($event->topic->section->classroom_id);
        ////Log::info('Running Course Completion Check');

        if ($student) { //Check if student is enrolled in course if yes
            ////Log::info('Student Exists in couse complete the course. line 67');
            if ($student->completed) {

            } else {
                // Cycle through each class
                foreach ($classTopics as $row) {
                    $studentTrack = ClassroomTopicTracking::where('topic_id', $row->id)->where('user_id', auth()->user()->id)->first();

                    if (!$studentTrack) { //Check if student has started any topics.

                        break;
                    } else { //If student does have completions.
                        if (!$studentTrack->completed) { //check if the topic is completed

                            //if incomplete
                            //Log::info('Student has incomplete topics');
                            break;
                        } else { //if topic is complete

                            if ($classTopics->last()) { //Check if this is the last topic of the class that is required.
                                //Log::info('This is the last topic for the class checking completiong');

                                if ($classroom->hasGrade) { //Check if the classroom has required grades
                                    //Log::info('This class requires grading.');

                                    $average = $classroom->studentGrades->where('user_id', auth()->user()->id)->avg('grade');

                                    if ($average >= 80) { //Check if course average is above an 80%
                                        $student = ClassRoomEnrolledStudent::where('classroom_id', $event->topic->section->classroom_id)->where('user_id', auth()->user()->id)->first();

                                        if ($student) { //Check if student is enrolled in course if yes
                                            //Log::info('Student Exists in couse complete the course. line 67');
                                            $student->completed = Carbon::now()->toDateTimeString();
                                            $student->save();
                                            $link = "/classroom/certificate/$student->id";
                                        } else { //Check if student is enrolled in course if no
                                            //Log::info('Student does not exist in the course and we need to add them then complete the course line 69');
                                            $newStudent = new ClassRoomEnrolledStudent;
                                            $newStudent->user_id = auth()->user()->id;
                                            $newStudent->classroom_id = $event->topic->section->classroom_id;
                                            $newStudent->completed = Carbon::now()->toDateTimeString();
                                            $newStudent->save();
                                            $link = "/classroom/certificate/$newStudent->id";
                                        }

                                        $employee_name = auth()->user()->employee->first_name . ' ' . auth()->user()->employee->last_name;

                                        $course_name = $classroom->lable;

                                        User::find(auth()->user()->id)->notify(new CourseCompleted($employee_name, $course_name, $link));


                                        Log::info('Line 94');


                                        foreach ($admin_notification as $row) {
                                            User::find($row->id)->notify(new CourseCompleted($employee_name, $course_name, $link));
                                        }
                                    } else { // Check if course average is less than 80%
                                        


                                    }
                                } else {
                                    $student = ClassRoomEnrolledStudent::where('classroom_id', $event->topic->section->classroom_id)->where('user_id', auth()->user()->id)->first();

                                        if ($student) { //Check if student is enrolled in course if yes
                                            //Log::info('Student Exists in couse complete the course. line 67');
                                            $student->completed = Carbon::now()->toDateTimeString();
                                            $student->save();
                                            $link = "/classroom/certificate/$student->id";
                                        } else { //Check if student is enrolled in course if no
                                            //Log::info('Student does not exist in the course and we need to add them then complete the course line 113');
                                            $newStudent = new ClassRoomEnrolledStudent;
                                            $newStudent->user_id = auth()->user()->id;
                                            $newStudent->classroom_id = $event->topic->section->classroom_id;
                                            $newStudent->completed = Carbon::now()->toDateTimeString();
                                            $newStudent->save();
                                            $link = "/classroom/certificate/$newStudent->id";
                                        }

                                        $employee_name = auth()->user()->employee->first_name . ' ' . auth()->user()->employee->last_name;

                                        $course_name = $classroom->lable;

                                        User::find(auth()->user()->id)->notify(new CourseCompleted($employee_name, $course_name, $link));

                                        Log::info('Line 128');
                                        


                                        foreach ($admin_notification as $row) {
                                            User::find($row->id)->notify(new CourseCompleted($employee_name, $course_name, $link));
                                        }
                                }
                            }
                        }
                    } // End Check if student has started any topics.

                    // End Cycle of classes
                }
            }
        } else { //Check if student is enrolled in course if no
            // Cycle through each class
                foreach ($classTopics as $row) {
                    $studentTrack = ClassroomTopicTracking::where('topic_id', $row->id)->where('user_id', auth()->user()->id)->first();

                    if (!$studentTrack) { //Check if student has started any topics.

                        break;
                    } else { //If student does have completions.
                        if (!$studentTrack->completed) { //check if the topic is completed

                            //if incomplete
                            //Log::info('Student has incomplete topics');
                            break;
                        } else { //if topic is complete

                            if ($classTopics->last()) { //Check if this is the last topic of the class that is required.
                                //Log::info('This is the last topic for the class checking completiong');

                                if ($classroom->hasGrade) { //Check if the classroom has required grades
                                    //Log::info('This class requires grading.');

                                    $average = $classroom->studentGrades->where('user_id', auth()->user()->id)->avg('grade');

                                    if ($average >= 80) { //Check if course average is above an 80%
                                        $student = ClassRoomEnrolledStudent::where('classroom_id', $event->topic->section->classroom_id)->where('user_id', auth()->user()->id)->first();

                                        if ($student) { //Check if student is enrolled in course if yes
                                            //Log::info('Student Exists in couse complete the course. line 67');
                                            $student->completed = Carbon::now()->toDateTimeString();
                                            $student->save();
                                            $link = "/classroom/certificate/$student->id";
                                        } else { //Check if student is enrolled in course if no
                                            //Log::info('Student does not exist in the course and we need to add them then complete the course line 69');
                                            $newStudent = new ClassRoomEnrolledStudent;
                                            $newStudent->user_id = auth()->user()->id;
                                            $newStudent->classroom_id = $event->topic->section->classroom_id;
                                            $newStudent->completed = Carbon::now()->toDateTimeString();
                                            $newStudent->save();
                                            $link = "/classroom/certificate/$newStudent->id";
                                        }

                                        $employee_name = auth()->user()->employee->first_name . ' ' . auth()->user()->employee->last_name;

                                        $course_name = $classroom->lable;

                                        User::find(auth()->user()->id)->notify(new CourseCompleted($employee_name, $course_name, $link));


                                        
                                        Log::info('Line 193');

                                        foreach ($admin_notification as $row) {
                                            User::find($row->id)->notify(new CourseCompleted($employee_name, $course_name, $link));
                                        }
                                    } else { // Check if course average is less than 80%
                                        


                                    }
                                } else {
                                    $student = ClassRoomEnrolledStudent::where('classroom_id', $event->topic->section->classroom_id)->where('user_id', auth()->user()->id)->first();

                                        if ($student) { //Check if student is enrolled in course if yes
                                            //Log::info('Student Exists in couse complete the course. line 67');
                                            $student->completed = Carbon::now()->toDateTimeString();
                                            $student->save();
                                            $link = "/classroom/certificate/$student->id";
                                        } else { //Check if student is enrolled in course if no
                                            //Log::info('Student does not exist in the course and we need to add them then complete the course line 69');
                                            $newStudent = new ClassRoomEnrolledStudent;
                                            $newStudent->user_id = auth()->user()->id;
                                            $newStudent->classroom_id = $event->topic->section->classroom_id;
                                            $newStudent->completed = Carbon::now()->toDateTimeString();
                                            $newStudent->save();
                                            $link = "/classroom/certificate/$newStudent->id";
                                        }

                                        $employee_name = auth()->user()->employee->first_name . ' ' . auth()->user()->employee->last_name;

                                        $course_name = $classroom->lable;

                                        User::find(auth()->user()->id)->notify(new CourseCompleted($employee_name, $course_name, $link));
                                        Log::info('Line 226');
                                        foreach ($admin_notification as $row) {
                                            User::find($row->id)->notify(new CourseCompleted($employee_name, $course_name, $link));
                                        }
                                }
                            }
                        }
                    } // End Check if student has started any topics.

                    // End Cycle of classes
                }
        }
    }
}
