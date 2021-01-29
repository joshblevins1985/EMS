<?php

namespace Vanguard\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Vanguard\ClassRoomQuizAttempt;

class QuizComplete
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if($event->score >= 80){
            $attempt = ClassRoomQuizAttempt::where('user_id', Auth()->user()->id)->where('quiz_id', $event->quiz_id)->orderBy('grade', 'desc')->first();
            //Check if new score is the highest score...
            if($event->score > $attempt->score){

            }

        }else{

        }
    }
}
