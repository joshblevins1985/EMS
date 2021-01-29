<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\RideWaiver;

class RiderController extends Controller
{
    public function ride()
    {
        return view('ridewaiver.index');
        
    }
    
    public function waiver(Request $request)
    {
       
        $insert = RideWaiver::create($request->all());
        
        return redirect()->route('home');
        
        
    }
}
