<?php

namespace Vanguard\Export;

use Carbon\Carbon;
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

class N95Export implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        set_time_limit(-1);
        ini_set('memory_limit','2G');



        $employees = Employee::whereHas('fitTest')->whereIn('primary_position', [3,4,5,7,8,9,17,21,34,35,37])->whereIn('status', [2,3,4,5,10])->orderBy('last_name')->get();



        return $employees;
    }

    /**
     * @var Employees $employees
     */
    public function map($employees): array
    {
        if($employees->fitTest->created_at){ $created = Carbon::parse($employees->fitTest->created_at)->format('Y-m-d');}
        return [
            $employees->eid,
            $employees->last_name.', '.$employees->first_name,
            $created,
            $employees->fitTest->mask->brand,
            $employees->fitTest->mask->type,
            $employees->fitTest->mask->niosh_number,
            $employees->fitTest->test->first_name .', '. $employees->fitTest->test->last_name

        ];
    }

    public function headings(): array
    {
        return [
            'EID',
            'Employee',
            'Mask Brand',
            'Type',
            'Approval',
            'Tester'
        ];
    }


}
