<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Vanguard\StateCertifications;


use Illuminate\Http\Request;

class EmployeeStateCertificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
     * * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        
        
        return view('employee.state');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $s = new StateCertifications;
        
        $s->state = $request->state;
        $s->certification_level = $request->cert_level;
        $s->expiration = $request->expiration_submit;
        $s->status = 1 ;
        $s->certification_number = $request->cert_num;
        $s->user_id = $request->employee;
        
        $s->save();
        
        return redirect()->back();
        
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
