<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Vanguard\timepunch;
use Vanguard\Companies;
use Vanguard\Employee;
use Vanguard\NarcoticBoxes;

use Illuminate\Http\Request;

class TimePunchControoler extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Get Users Company ID....
        $user= Auth::user();
        $company_id = $user->companies_id;
        $fname= $request->fname;
        $lname= $request->lname;
        
        
        //Get all time punches for company...
        $punches = timepunch::with('employee')
                ->whereHas('employee', function($q) use($company_id, $fname, $lname){
                    $q->where('company_id', $company_id);
                    $q->where('first_name', 'like', '%'.$fname.'%');
                    $q->where('last_name', 'like', '%'.$lname.'%');
                })
                
                ->where('time_in', 'like', $request->indate_submit.'%')
                ->where('time_out', 'like', $request->outdate_submit.'%' )
                ->whereRaw("time_in >= '$request->sdate_submit' AND time_in <= '$request->edate_submit'")
                ->paginate(25);
                
        //Return list of all time punches.
                
       return view('timepunches.index', compact('punches'));
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
        //
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
        
        $employees = Employee::where('status', '>=', '1')->get()
                    ->keyBy('user_id')
                    ->map(function ($employee){
                        return"{$employee->last_name}, {$employee->first_name}";
                    });
                    
        $punch = timepunch::find($id);
                    
                    return view('timepunches.edit', compact('employees', 'punch'));
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
        
        
       
        
        $punch->employee_id = $request->user_id;
        $punch->time_in = $request->time_in;
        if ($request->time_in != $punch->getOriginal('time_in')) {
          // A change to the price has occurred.
          $time_ine = 'E';
          $punch->how_in = $time_ine;
        }
        $punch->time_out = $request->time_out;
        if ($request->time_out != $punch->getOriginal('time_out')) {
          // A change to the price has occurred.
          $time_oute = 'E';
          $punch->how_out = $time_oute;
        }
        
        $punch->save();
        
        return redirect()->route('timepunches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $punches = timepunch::with('employee')
                ->where('id', $id)
                ->first();
                        
        $timepunch = timepunch::find($id);
        $timepunch->delete();

        app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log('Deleted time punch for '.$punches->employee->first_name.' '.$punches->employee->last_name.' date deleted  '.$punches->time_in.'.');

        return redirect('/timepunches')->with('success', 'Deleted Time Punch');
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
