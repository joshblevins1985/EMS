<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\CovidPatientExposure;
use Vanguard\Employee;
use Vanguard\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Vanguard\CovidExposure;

class CovidController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:menu.compliance');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exposures = CovidExposure::get();
        $employees = Employee::get();

        return view('covid.index', compact('exposures', 'employees'));
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
        $dot = date('Y-m-d', strtotime($request->transport_date));
        $dob = date('Y-m-d', strtotime($request->dob));

        $patient = New CovidPatientExposure;
        $patient->transport_date = $dot;
        $patient->patient_name = $request->patient_name;
        $patient->date_of_birth = $dob;
        $patient->pick_up = $request->pick_up;
        $patient->drop_off = $request->drop_off;
        $patient->save();

        foreach($request->employee_id as $eid)
        {
            $row = new CovidExposure;

            $row->employee_id = $eid;
            $row->pid = $patient->id;
            $row->save();
        }



        return back()->with('success', 'You have added a new exposure');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exposure = CovidExposure::findorfail($id);

        return view('covid.viewEmployee', compact('exposure'));
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
