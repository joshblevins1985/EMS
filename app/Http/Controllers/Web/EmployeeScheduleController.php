<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;

use Vanguard\schedule;

use Illuminate\Http\Request;
use DateTime;
use DateInterval;
use DatePeriod;

class EmployeeScheduleController extends Controller
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
        
        if(isset($request->repeat))
        {
           // dd($request->start_time);
            $start = new DateTime( $request->start_date_submit );
            $end = new DateTime( $request->end_date_submit);
            $interval = new DateInterval('P'.$request->tdays.'D');
            
            $period = new DatePeriod($start, $interval, $end);
            
            foreach($period as $row)
            {
                $sin = $row->format('Y-m-d').' '.$request->start_time;
                
                //dd($sin);
                
                $shift = '+'.$request->thours.'hours';
                
                //dd($shift);
                
                $sout = strtotime($sin . $shift );
                
                //dd($sout);
                
                $sout = date('Y-m-d H:i:s', $sout);
                
                
                $schedule = new schedule;
                
                $schedule->user_id = $request->user_id;
                $schedule->sin = $sin;
                $schedule->sout = $sout;
                $schedule->unit = $request->unit;
                
                $schedule->save();
                
                
                
            }
            return redirect()->back();
        }else{
            $sin = $row->format('Y-m-d').' '.$request->start_time;
                
                //dd($sin);
                
                $shift = '+'.$request->thours.'hours';
                
                //dd($shift);
                
                $sout = strtotime($sin . $shift );
                
                //dd($sout);
                
                $sout = date('Y-m-d H:i:s', $sout);
                
                
                $schedule = new schedule;
                
                $schedule->user_id = 450;
                $schedule->sin = $sin;
                $schedule->sout = $sout;
                $schedule->unit = $request->unit;
                
                $schedule->save();
        }
        
            
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
