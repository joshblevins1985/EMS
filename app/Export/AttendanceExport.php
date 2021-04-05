<?php

namespace Vanguard\Export;

use Vanguard\Attendance;
use Vanguard\schedule;
use Vanguard\Employee;
use Vanguard\AttendanceOccurance;
use Vanguard\EmployeeEncounters;

use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AttendanceExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
                set_time_limit(-1);
ini_set('memory_limit','2G');
        
        //get all employees
      $start = '2021-01-01';
        $end = '2021-03-31';
        
       $employees = Employee::where('status', 5)->orderBy('last_name')->get();

$employeesCount = Attendance::whereBetween('date', [$start, $end])
            ->whereIn('user_id', $employees->pluck('user_id')->toArray())
            ->select('user_id', DB::raw('count(*) as total'), 
            DB::raw('count(IF(occurance_type = 0,1,NULL)) hour'), 
            DB::raw('count(IF(occurance_type = 2,1,NULL)) t5'), 
            DB::raw('count(IF(occurance_type = 4,1,NULL)) t120'), 
            DB::raw('count(IF(occurance_type = 6,1,NULL)) b'), 
            DB::raw('count(IF(occurance_type = 7,1,NULL)) ncns'), 
            DB::raw('count(IF(occurance_type = 8,1,NULL)) co'), 
            DB::raw('count(IF(occurance_type = 9,1,NULL)) ntc'), 
            DB::raw('count(IF(occurance_type = 10,1,NULL)) lo'),
            DB::raw('count(IF(occurance_type = 18,1,NULL)) cofmla'),
            DB::raw('count(IF(occurance_type = 19,1,NULL)) lpdfmla'))
            ->where('status', 0)
            ->groupBy('user_id')
            ->get();
            
$complianceCount = EmployeeEncounters::whereBetween('doi', [$start, $end])
            ->whereIn('user_id', $employees->pluck('user_id')->toArray())
            ->select('user_id', DB::raw('count(IF(encounter_type >= 4,1,NULL)) compliance'))
            ->groupBy('user_id')
            ->get();
            
            
            

$employees->map(function ($employee) use ($employeesCount, $complianceCount) {
    $count = $employeesCount->where('user_id', $employee->user_id)->first();
    $ccount = $complianceCount->where('user_id', $employee->user_id)->first();

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
        $employee->cofmla = $count->cofmla * 3;
        $employee->lpdfmla = $count->lpdfmla;
        
    }
    
    if(!$ccount){
        $employee->compliance = 0;
    }else{
        $employee->compliance = $ccount->compliance * 7;
    }
    
    $employee->total = $employee->hour32 + $employee->late + $employee->late120 + $employee->blackout + $employee->nocall +$employee->calloff + $employee->ntc + $employee->lo + $employee->cofmla + $employee->lpdfmla + $employee->compliance;

    return $employee->where('total', '<' , '7');
});

    
    

        
    return $employees;
    }
    
    /**
    * @var Employees $employees
    */
    public function map($employees): array
    {
        return [
            $employees->eid,
            $employees->last_name.', '.$employees->first_name,
            $employees->total,
            
        ];
    }
    
    public function headings(): array
    {
        return [
            'EID',
            'Employee',
            'Total Points',
        ];
    }
    
    
}
