<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Vanguard\Station;
use Vanguard\Employee;
use Vanguard\EmployeeEncounters;
use Vanguard\QaQi;
use Vanguard\Attendance;
use Vanguard\DrivingAssessments;

use Auth;
use PDF;
use DB;
use Carbon;

class ManagerController extends Controller
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
     
     $station = Station::where('manager', '804')->orWhere('regional_manager', '804')->get()->toArray();
     
     //$sarray= json_decode($station, true);
    // $sarray= array_column($station, 'id');
    // dd(collect($station)->pluck('id')->implode(','));
     $sarray = collect($station)->pluck('id')->implode(',');
     //$sarray = json_encode($sarray);
     
     //dd($sarray);
 
     
     $qa = QaQi::whereHas('employee', function ($query) use ($sarray) {
                $query->whereIn('primary_station', [$sarray] );
            })->where('created_at', '>=', Carbon::now()->subMonth())->paginate('5', ['*'], 'qa');
            
    $employee = Employee::with('employeepositions')->find(Auth::User()->id);
        
        $encounters = EmployeeEncounters::whereHas('employee', function ($query) use ($sarray) {
                $query->whereIn('primary_station', [$sarray]);
            })->where('status', '<', 4)->paginate('5', ['*'], 'encounters' );
        
        
        
        $now = date('Y-m-d', strtotime('now'));
        
        $quarter = DB::table('quarters')
        ->where(function ($query) use ($now) {
        $query->where('start', '<=', $now);
        $query->where('end', '>=', $now);
        })->first();
        
        $attendance = Attendance::whereHas('employee', function ($query) use ($sarray) {
                $query->whereIn('primary_station', [$sarray]);
            })
            ->where('user_id', Auth::User()->id)->whereBetween('date', array($quarter->start, $quarter->end))->paginate('5',['*'], 'attendance');
        
        $percent= count($attendance) / 7 * 100;
        
        $signatures = DrivingAssessments::with('employee')->where('performance_rating', '<', 80)->get();

     return view('manager.index', compact('station', 'employee', 'encounters', 'qa', 'attendance', 'signatures'));   
    }
}
