<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;



class NotificationsController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
     
    auth()->user()->unreadNotifications->where('id', $id)->markAsRead();
    
    return back();
       
    }
}
