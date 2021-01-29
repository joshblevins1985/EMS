<?php

namespace Vanguard\Export;

use DB;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Vanguard\Employee;

class CamraReviewExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        set_time_limit(-1);
        ini_set('memory_limit','2G');

        //get all employees
       $employees = Employee::
           whereIn('primary_position', [3,4,5,7,8,9,17,21,34,35,37])
           ->whereIn('status', [2,3,4,5,10])
           ->where('driver', '>', 0)
           ->orderBy('last_name')->get();
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
            ($employees->driverEvalLast ? $employees->driverEvalLast->created_at : 'Not Reviewed'),

        ];
    }

    public function headings(): array
    {
        return [
            'EID',
            'Employee',
            'Last Review',
        ];
    }


}
