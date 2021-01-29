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


class EmployeesExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
                        set_time_limit(-1);
ini_set('memory_limit','2G');
        $employees = Employee::with('EmployeeStatus', 'employeepositions')
            ->whereIn('primary_position', [3, 4, 5,7,8,9])
            ->where('status', 5)
            ->get();
        
    return $employees;
    }

    /**
    * @var Employees $employees
    */
    public function map($employees): array
    {
        return [
            $employees->last_name,
            $employees->first_name,
            $employees->email,
            $employees->eid,
            $employees->employeepostions->label
        ];
    }
    
    public function headings(): array
    {
        return [
            'Last Name',
            'First Name',
            'Email',
            'EID'
        ];
    }
    
    
}
