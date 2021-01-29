<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Pusher\Pusher;

class PusherNotificationController extends Controller
{
    public function sendNotification(){
        //Remember to change this with your cluster name.
        $options = array(
            'cluster' => 'us2',
            'encrypted' => true
        );

        //Remember to set your credentials below.
        $pusher = new Pusher(
            '3ac146c22cb6b2a219f9',
            '2db8aa38b746f1fbf1e7',
            '883963', $options
        );

        $message= "Hello Cloudways";

        //Send a message to notify channel with an event name of notify-event
        $pusher->trigger('repairComplete', 'repair-complete', $message);
    }
}
