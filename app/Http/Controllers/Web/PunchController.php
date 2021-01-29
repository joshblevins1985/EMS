<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Vanguard\timepunch;
use Vanguard\Companies;
use Vanguard\Employee;
use Vanguard\payperiods;
use Vanguard\schedule;
use Vanguard\Attendance;
use Vanguard\NarcoticBoxes;

use Illuminate\Http\Request;

use DB;


class PunchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('timeclock.index');
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
        timepunch::create(request()->all());

        $td= date('Y-m-d');
        
        $schedule = schedule::select('sin as start')
            ->whereRaw("user_id = '$request->employee_id' and sin like '$td%'")->first();
        
        
        if(!$schedule){
          return back()->with('success', 'You have been clocked in. Have a safe and good day.');  
        }else{
        $sti= $schedule->start;
        $cit = strtotime($request->time_in);
        $sti = strtotime($sti);
        $sti5= strtotime('+ 5 minute', $sti);
        $sti120= strtotime('+ 120 minute', $sti);
        $td= date('Y-m-d');
        if( $cit > $sti5 && $cit < $sti120){
            $attendance = new Attendance;
            $attendance->user_id = $request->employee_id;
            $attendance->occurance_type = '2';
            $attendance-> $td; 
            $attendance-> AUTO;
            $attendance->schedule_id = $request->schedule_id;
            
            $attendance-> save();
            
           return back()->with('success','You have been marked late for this shift. If you feel this is in error contact the compliance department at compliance@peasi.net. Have a safe and good day.'); 
        }if($cit > $sti120){
            $attendance = new Attendance;
            $attendance->user_id = $request->employee_id;
            $attendance->occurance_type = '4';
            $attendance-> $td; 
            $attendance-> AUTO;
            $attendance->schedule_id = $request->schedule_id;
            
            $attendance-> save();
            
           return back()->with('success','You have been marked late for this shift. If you feel this is in error contact the compliance department at compliance@peasi.net. Have a safe and good day.'); 
        }
        else{
            return back()->with('success', 'You have been clocked in. Have a safe and good day.');
        }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function punch(Request $request)
    {
        //get todays date...
        $td = date('Y-m-d');
        
        //dd($request->eid);

        // Find employee attempting to log in...
        $employee = Employee::
            Where('rfid', $request->eid)
        ->orWhere('eid', $request->eid)->first();
        // Do stuff when user exists.

        if(!$employee){
            return view('timeclock.punch', compact('employee'));
        }else {

            $daysched = schedule::
            whereRaw("user_id = '$employee->user_id' and sin like '$td%'")->first();
            // Do stuff when schedule exists.

            $payperiod = payperiods::whereRaw("start <= '$td' AND end >= '$td'")->first();

            // get start of payperiod
            $start = $payperiod->start;
            $end = date('Y-m-d',strtotime($payperiod->end . "+1 days"));

            //get all time punches for this payperiod.

            $punches = timepunch::
            //whereRaw("time_in >= '$start' AND time_in <= '$payperiod->end'")
            whereBetween('time_in', array($start, $end))
                ->where('employee_id', $employee->user_id)->orderBy('time_in', 'dec')->get();

            $lpunch = timepunch::
            whereRaw("time_in >= '$start' AND time_in <= '$end'")
                ->where('employee_id', $employee->user_id)->latest()->first();

            return view('timeclock.punch', compact('employee', 'daysched', 'payperiod', 'punches', 'lpunch'));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {

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
        $punch= timepunch::find($id);

        $punch->update($request->all());
        
        
        return back();
        
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
    
    public function verifyBox(Request $request)
    {
        if($request->rfid){
            $rfid = $request->rfid;
            $box = NarcoticBoxes::where('rfid', $rfid)->first();
            if($box){

                $data = Array(

                        'message' => "The scanned box is listed as box $box->box_number.",
                        'status' => 1,
                        'link' => '/narcoticlog/create?rfid='.$rfid

                );

                $data = json_encode($data);

                return  $data;
            }else{
                $data = Array(

                        'message' => "The scanned box does not exist please try again, please verify that you have scanned the narcotic box.",
                        'status' => 0,
                        'link' => ''

                );

                $data = json_encode($data);

                return $data;
            }

        }

        }
}
