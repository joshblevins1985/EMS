<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\ScholarshipApplication;
use Vanguard\ScholarshipOppurtunities;

class ScholarshipsController extends Controller
{
    public function application ()
    {
        $oppurtunities = ScholarshipOppurtunities::where('status', 1)->get();
        
        return view('scholarships.application', compact('oppurtunities'));
    }
    
    public function application_store (Request $request)
    {
        $address = $request->house_number.' '.$request->route;
        
        $store = new ScholarshipApplication;
        
        $store->first_name = $request->first_name;
        $store->middle_name = $request->middle_name;
        $store->last_name = $request->last_name;
        $store->student = $request->last_name.', '.$request->first_name;
        $store->phone = $request->phone;
        $store->email = $request->email;
        $store->oppurtunity_id = $request->oppurtunity_id;
        $store->address = $address;
        $store->city = $request->city;
        $store->state = $request->state;
        $store->zip = $request->postal_code;
        $store->goals = $request->goals;
        $store->employment = $request->employment;
        $store->activities = $request->activities;
        $store->plans = $request->plans;
        $store->student_essay = $request->student_essay;
        $store->status = 1;
        
        $store->save();
        
        return redirect()->route('home');
        
    }
}
