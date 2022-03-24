<?php

namespace Vanguard\Http\Controllers\Web;
use Vanguard\Companies;
use Vanguard\Http\Controllers\Controller;
use Vanguard\BadRunSheet;
use Vanguard\Station;
use Vanguard\DriverHistoryTracking;
use Vanguard\Employee;
use Vanguard\RequiredCompetencies;
use Vanguard\Protocols;

use DB;
use PDF;
use DateTime;
use DatePeriod;
use DateInterval;

use Illuminate\Http\Request;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_daily()
    {
        $station = Station::with(['Employees', 'Employees.BadRunSheets' => function ($q){
            $q->where('status', 5);
        }])->get();
        
        $brs = DB::table('badrunsheets')
    ->leftJoin('employees', 'employees.user_id', '=', 'badrunsheets.employee')
    ->leftJoin('stations', 'employees.primary_station', 'stations.id')
    ->where('badrunsheets.status', '<', 5)
    ->groupBy('employees.primary_station')
    ->selectRaw('
        count(*) as count,
        sum(badrunsheets.status = 1) as uploaded,
        sum(badrunsheets.status = 2) as notified,
        sum(badrunsheets.status = 3) as acknowledged,
        sum(badrunsheets.status = 4) as billing,
        stations.station as station
    ')->orderBy('stations.station')
    ->get();
        
        
        return view('reports.admin_daily', compact('brs', 'station'));
    }
    
    public function driver_status()
    {
        
        
        $to = date('Y-m-d', strtotime('+1 days'));
        $from = date('Y-m-d', strtotime('-8 days'));
        
        $nd = DriverHistoryTracking::whereBetween('created_at', [$from, $to])->where('new_value', 99)->whereHas('employees', function ($q) {$q->where('driver', 1);})->groupBy('employee')->get();
        $e = Employee::where('status', 5)->get();
        
        view()->share('nd', $nd);
        view()->share('e', $e);
        
        $pdf = PDF::loadView('reports.driver_status')->setPaper('a4')->setOption('margin-left', 5)->setOption('margin-right', 5)->setOption('margin-bottom', 20)->setOption('margin-top', 20)->setOrientation('landscape');
        
        return $pdf->download('incidentreport.pdf');
        
        //return view('reports.driver_status', compact('nd', 'e'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function required_competencies ()
    {
        $rc = RequiredCompetencies::get();
        
        $station = Station::where('status', 0)->orderBy('station')->get();
        
        return view('reports.required_competencies', compact('rc', 'station'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function incidentByStation ()
    {
        $station = Station::find(21);
        
        $type = Protocols::get();
        
        return view('reports.incident_type_by_station', compact('station', 'type'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function station_competency ($station, $competency, $level)
    {
        $rc = RequiredCompetencies::find($competency);
        
        $today = time();
        
        $start = strtotime('-'.$rc->renew.'months', $today);
                        
        $today = date('Y-m-d', $today);
        
        $start = date('Y-m-d', $start);
        
        $completed = Employee::whereHas('competencies', function ($q) use($competency, $start, $today){$q->where('competency_id', $competency); $q->whereBetween('completed', [$start, $today]);})->where('primary_station', $station)->where('primary_position', $level)->where('status', 5)->orderBy('last_name')->get();
        
        $incomplete = Employee::whereDoesntHave('competencies', function ($q) use($competency, $start, $today){$q->where('competency_id', $competency); $q->whereBetween('completed', [$start, $today]);})->where('primary_station', $station)->where('primary_position', $level)->where('status', 5)->orderBy('last_name')->get();
        
        
        $station = Station::find($station);

        //dd($completed);

        return view('reports.station_competency', compact('rc', 'completed', 'incomplete', 'station'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function attrition ()
    {
        $start = "2019-11-08";
        
        $end = "2019-11-14";
                    
                    function getDatesFromRange($start, $end, $format = 'Y-m-d') {
                    $array = array();
                    $interval = new DateInterval('P1M');
                
                    $realEnd = new DateTime($end);
                    $realEnd->add($interval);
                
                    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
                    
                    foreach($period as $date) { 
                        $array[] = $date->format($format); 
                    }
                
                    return $array;
                }
        
        //dd(getDatesFromRange($start, $end));
        
        
        $station = Station::where('status', 0)->get();
        
        
        $employee = Employee::groupBy('primary_position')->get(array(
            //DB::raw('sum(if(primary_position = 11, 1,0)) as wc'),
            DB::raw('primary_position'),
            DB::raw('count(*) as count_all'),
            DB::raw('sum(if(status = 5, 1,0)) count_active'),
            DB::raw("sum(if(status = 8 AND updated_at BETWEEN '$start' AND '$end', 1,0)) count_term"),
            )) ;
            
        $employees = Employee::groupBy('primary_position')->get(array(
            //DB::raw('sum(if(primary_position = 11, 1,0)) as wc'),
            DB::raw('primary_position'),
            DB::raw('count(*) as count'),
           // DB::raw('sum(if(primary_position = 3, 1,0)) as emt')
            )) ;
            
           // dd($employee);
        //Employee::select(SELECT count(*) FROM employees WHERE primary_position = 11 AND status = 5);
        
        view()->share('employee', $employee);
        view()->share('employees', $employees);
        view()->share('station', $station);
        
        $pdf = PDF::loadView('reports.turnover')->setPaper('a4')->setOrientation('landscape');
        
    return $pdf->download('turn_over.pdf');

        return view('reports.turnover', compact('employee', 'employees', 'station', 'start', 'end'));
    }

    public function competencyReport()
    {

        $employees = Employee::where('status', 5)->whereIn('primary_position', [3,4,5,8])->orderBy('last_name')->get();

        view()->share('employees', $employees);


        $pdf = PDF::loadView('reports.competencies')->setPaper('a4');

        //return $pdf->download('competencyReport.pdf');

        return view('reports.competencies', compact('employees'));
    }

    public function fitTestReportByStation (){
        $stations = Station::where('status', 0)->get();

        view()->share('stations', $stations);


        $pdf = PDF::loadView('reports.fittest')->setPaper('a4')->setOrientation('landscape');;

        return $pdf->download('n95report.pdf');

        //return view('reports.fittest', compact('stations'));
    }

    public function fitTestFormPrint (){
        $stations = Station::where('status', 0)->get();

        view()->share('stations', $stations);


        $pdf = PDF::loadView('reports.n95FormByStation')->setPaper('a4');;

        return $pdf->download('n95Forms.pdf');

        // return view('reports.n95FormByStation', compact('stations'));
    }

    public function fitTestFormPrintQ (){
        $stations = Station::where('status', 0)->get();

        view()->share('stations', $stations);


        $pdf = PDF::loadView('reports.n95qFormByStation')->setPaper('a4');;

        //return $pdf->download('n95Forms.pdf');

         return view('reports.n95FormByStation', compact('stations'));
    }

    public function dfwAnnual ()
    {
        $companies = Companies::get();

        view()->share('companies', $companies);


        $pdf = PDF::loadView('reports.drugFreeTrainingAnnual')->setPaper('a4');;

        return $pdf->download('dfwAnnual.pdf');

        //return view('reports.drugFreeTrainingAnnual', compact('companies'));
    }
}
