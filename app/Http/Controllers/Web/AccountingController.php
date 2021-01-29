<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Attendance;
use Vanguard\schedule;
use Vanguard\Employee;
use Vanguard\PayPeriod;
use Vanguard\timepunch;
use Vanguard\EmployeeInsurance;

class AccountingController extends Controller
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
        $date = date('Y-m-d');
        $date = strtotime($date);
        $date = strtotime('- 1 day', $date);
        $date = date('Y-m-d', $date);
        
        $noclock = schedule::with('Employee')
        ->leftJoin('time_punch', function($join)
        {
            $join->on('schedule.id', '=', 'time_punch.schedule_id');
        })
        ->where('sin', 'like', $date.'%')
        ->whereNull('status' )
        ->whereNull('time_punch.time_in')->get([
            'schedule.id',
            'schedule.sin',
            'schedule.user_id'
            
            ]);
        
        $pay_period = PayPeriod::orderBy('start', 'dec')->get();
        
        return view('accounting.index', compact('noclock', 'pay_period'));
    }
    
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function payrollreport(Request $request)
    {
        //get payperiod start and end...
        
        $bindings= [
            'start' => $request->start_date,
            'end' => $request->end_date
            ];
        $start= $request->start_date;
        $end = $request->end_date;
        
        //get all active employees with their time punches and pay rates...
        
        $employees = Employee::with(['timepunch', 'PayRate', 'Insurances'])
                        
                        ->whereHas('timepunch', function($q) use($start, $end){

                                $q->whereBetween('time_in',[$start, $end]);
                               
                            })
                            ->whereHas('PayRate', function($q) use($start, $end){

                                $q->where('status', '1');
                               
                            })
                            ->whereHas('Insurances', function($q) use($start, $end) {

                                $q->where('start', '<=', $start);
                               
                            })
                        ->where ('status', '=', '1')
                        ->orderBy('last_name')
                        ->get();
                        
      
                        
                       
                        
        //return all data to payroll report.
        
        return view('accounting.reports.payroll_report', compact('employees', 'start', 'end'));
    }
    
         /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function attendancereport(Request $request)
    {

        
        return view('accounting.reports.payroll_report');
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search_payroll()
    {
        
        return view('accounting.search');
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
