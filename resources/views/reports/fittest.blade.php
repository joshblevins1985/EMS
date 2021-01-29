<html>
<head>
    <title>Fit Test Report - PDF</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        tr {
            page-break-inside: avoid
        }
    </style>
</head>
<body>
<div class="container-fluid">
    @foreach($stations as $station)
        <div class="row">
            <div class="col-3">
                <img src="{{ public_path('/assets/img/peasi_lg.png') }}" alt="PEASI LOGO" style="width: 100%">
            </div>
            <div class="col-6">
                <h3 class="text-center">Portsmouth Emergency Ambulance Service Inc</h3>
                <h4 class="text-center">2820 Gallia Street Portsmouth Ohio 45662 (740)351-3122</h4>
                <stong>Respiratory Mask Fit Testing</stong>
            </div>
        </div>

        <div class="row">
            <div class="col-6"><h3>Station:<span>{{$station->station}}</span></h3></div>
            <div class="col-6"><h3>Report Date: {{ Carbon\Carbon::now()->format('m-d-Y') }}</h3></div>
        </div>
        <?php
        $employees = \Vanguard\Employee::
        where('primary_station', $station->id)
            ->whereIn('primary_position', [3, 4, 5, 7, 8, 9, 11, 17, 21, 34, 35, 37])
            ->whereIn('status', [2, 3, 4, 5, 10])
            ->orderBy('last_name')
            ->get();
        $completedEmployees = \Vanguard\Employee::whereHas('fitTest')
            ->where('primary_station', $station->id)
            ->whereIn('primary_position', [3, 4, 5, 7, 8, 9,11, 17, 21, 34, 35, 37])
            ->whereIn('status', [2, 3, 4, 5, 10])
            ->orderBy('last_name')->get();

        $failedEmployees = \Vanguard\Employee::whereHas('fitTest', function ($q) {
            $q->where('dentures', 1);
            $q->orWhere('facial_hair', 1);
            $q->orWhere('glasses', 1);
            $q->orWhere('physical_exam', 1);
            $q->orWhere('limitatiions_other', 1);
        })
            ->where('primary_station', $station->id)
            ->whereIn('primary_position', [3, 4, 5, 7, 8, 9, 11, 17, 21, 34, 35, 37])
            ->whereIn('status', [2, 3, 4, 5, 10])
            ->orderBy('last_name')->get();

        ?>
        <div class="row">
            <div class="col-4"><h3>Completed Employees:<span>{{count($completedEmployees)}}</span></h3></div>
            <div class="col-6"><h3>Failed Tests: {{ count($failedEmployees) }}</h3></div>
            <div class="col-6"><h3>Pending Completion: </h3></div>
        </div>

        <div class="row">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Fit Date</th>
                    <th>Employee</th>
                    <th>Test Type</th>
                    <th>Mask</th>
                    <th>Type</th>
                    <th>NIOSH Number</th>
                    <th>Limitations</th>
                    <th>Tester</th>
                </tr>
                </thead>

                <tbody>


                    @foreach($employees as $row)

                        @if($row->fitQuan)
                        <tr
                                @if($row->fitQuan->dentures) class="bg-danger"
                                @endif @if($row->fitQuan->facial_hair)
                                class="bg-danger" @endif @if($row->fitQuan->physical_exam)
                                class="bg-danger" @endif @if($row->fitQuan->glasses)
                                class="bg-danger"
                                @endif @if($row->fitQuan->limitatiions_other) class="bg-danger" @endif
                        >
                            <td > {{\Carbon\Carbon::parse($row->fitQuan->created_at)->format('m-d-Y')}} </td>
                            <td>{{$row->last_name ?? ''}}, {{$row->first_name ?? ''}} - {{$row->employeepositions->label ?? ''}}</td>
                            <td>
                                @if($row->fitQuan->test_type == 1)
                                    Seal Check
                                @elseif($row->fitQuan->test_type == 2)
                                    Quantitative
                                @elseif($row->fitQuan->test_type == 3)
                                    Qualitative
                                @endif
                            </td>
                            <td> {{$row->fitQuan->mask->brand}} </td>
                            <td> {{$row->fitQuan->mask->type}}  </td>
                            <td> {{$row->fitQuan->mask->niosh_number}}  </td>
                            <td> @if($row->fitQuan->dentures) Dentures @endif @if($row->fitQuan->facial_hair)
                                    Facial Hair @endif @if($row->fitQuan->physical_exam)
                                    Physical @endif @if($row->fitQuan->glasses)
                                    Glasses @endif @if($row->fitQuan->limitatiions_other) Other @endif </td>
                            <td>{{substr($row->fitQuan->test->first_name, 0, 1)}}
                                .{{$row->fitQuan->test->last_name ?? ''}} </td>
                        </tr>
                        @else
                            <tr class="bg-warning">
                                <td > No</td>
                                <td>{{$row->last_name ?? ''}}, {{$row->first_name ?? ''}} - {{$row->employeepositions->label ?? ''}}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endif


                    @endforeach

                </tbody>
            </table>
        </div>
        <div style="page-break-after: always; page-break-inside: avoid;"></div>
    @endforeach
</div>

</body>
</html>