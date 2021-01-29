<?php

namespace Vanguard\Console\Commands;

use Illuminate\Console\Command;
use Vanguard\Employee;
use Vanguard\Attendance;
use Vanguard\AttendanceNotification;


use DB;


class AttendancePointNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance.pointnotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies Compliance and creates an incident for follow up.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $now = date('Y-m-d', strtotime('now'));
        
                $quarter = DB::table('quarters')
        ->where(function ($query) use ($now) {
    $query->where('start', '<=', $now);
    $query->where('end', '>=', $now);
    })->first();
    
    $employees = Employee::where('status', 5)->orderBy('last_name')->get();
    $employeesCount = Attendance::whereBetween('date', [$quarter->start, $quarter->end])
            ->whereIn('user_id', $employees->pluck('user_id')->toArray())
            ->select('user_id', DB::raw('count(*) as total'), DB::raw('count(IF(occurance_type = 0,1,NULL)) hour'), DB::raw('count(IF(occurance_type = 2,1,NULL)) t5'), DB::raw('count(IF(occurance_type = 4,1,NULL)) t120'), DB::raw('count(IF(occurance_type = 6,1,NULL)) b'), DB::raw('count(IF(occurance_type = 7,1,NULL)) ncns'), DB::raw('count(IF(occurance_type = 8,1,NULL)) co'), DB::raw('count(IF(occurance_type = 9,1,NULL)) ntc'), DB::raw('count(IF(occurance_type = 10,1,NULL)) lo'))
            ->where('status', 0)
            ->groupBy('user_id')
            ->get();
            
    $employees->map(function ($employee) use ($employeesCount) {
    $count = $employeesCount->where('user_id', $employee->user_id)->first();
   

    if (!$count ) {
        $employee->hour32 = 0;
        $employee->late = 0 ;
        $employee->late120 = 0;
        $employee->blackout = 0;
        $employee->nocall = 0;
        $employee->calloff = 0;
        $employee->ntc = 0;
        $employee->lo = 0;
        
    } else {
        $employee->hour32 = $count->hour * 0;
        $employee->late = $count->t5 ;
        $employee->late120 = $count->t120 * 3;
        $employee->blackout = $count->b * 7;
        $employee->nocall = $count->ncns * 7;
        $employee->calloff = $count->co * 3;
        $employee->ntc = $count->ntc * 2;
        $employee->lo = $count->lo * 1;
        
    }
    
    
    $employee->total = $employee->hour32 + $employee->late + $employee->late120 + $employee->blackout + $employee->nocall +$employee->calloff + $employee->ntc + $employee->lo + $employee->compliance;

    return $employee;
});

foreach ($employees as $row)
{
    if($row->total >= 3 && $row->total < 6 ){
        
        $an = AttendanceNotification::where('user_id', $row->user_id)->whereBetween('created_at', [$quarter->start, $quarter->end])->where('level', 1)->first();
        
        if($an){
            
        }else{
            $n = new AttendanceNotification;
            $n->user_id = $row->user_id;
            $n->message = 'Employee has accrued 3-6 attendance points.';
            $n->level = 1;
            $n->save(); 
        }
    }elseif($row->total >= 6 && $row->total < 9){
        $an = AttendanceNotification::where('user_id', $row->user_id)->whereBetween('created_at', [$quarter->start, $quarter->end])->where('level', 2)->first();
        
        if($an){
            
        }else{
            $n = new AttendanceNotification;
            $n->user_id = $row->user_id;
            $n->message = 'Employee has accrued 6-9 attendance points.';
            $n->level = 2;
            $n->save(); 
        }
        
    }elseif($row->total >= 9 && $row->total < 12){
        $an = AttendanceNotification::where('user_id', $row->user_id)->whereBetween('created_at', [$quarter->start, $quarter->end])->where('level', 3)->first();
        
        if($an){
            
        }else{
            $n = new AttendanceNotification;
            $n->user_id = $row->user_id;
            $n->message = 'Employee has accrued 9-12 attendance points.';
            $n->level = 3;
            $n->save(); 
        }
    }
}
    }
}
