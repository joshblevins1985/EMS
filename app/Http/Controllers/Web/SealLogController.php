<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\SealLog;
use Vanguard\NarcoticBoxes;
use Auth;

class SealLogController extends Controller
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
        //validate required fields
            $this->validate($request, [
                'reason' => 'required',
                'new_seal' => 'required',
                'new_tamper_seal' => 'required'
                
            ]);
        
        $seal_log = new SealLog;
        
        $seal_log->seal = $request->seal;
        $seal_log->tamper_seal = $request->tamper_seal;
        
        $seal_log->new_seal = $request->new_seal;
        $seal_log->new_tamper_seal = $request->new_tamper_seal;
        
        $seal_log->box = $request->box;
        $seal_log->reason = $request->reason;
        $seal_log->employee = Auth::User()->id;
        
        $seal_log->save();
        
        $box = NarcoticBoxes::find($request->box);
        $box->seal = $request->new_seal;
        $box->tamper_seal = $request->new_tamper_seal;
        $box->save();
        
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
