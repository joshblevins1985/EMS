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
    @foreach($companies as $company)
        <div class="row">
            <div class="col-3">
                <img src="{{ public_path('/assets/img/peasi_lg.png') }}" alt="PEASI LOGO" style="width: 100%">
            </div>
            <div class="col-6">
                <h3 class="text-center">{{$company->name}}</h3>
                <h6 class="text-center">Drug Free Work Place Training</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-6"><h3>Report Start Date:<span>04-01-2020</span></h3></div>
            <div class="col-6"><h3>Report End Date: 03-29-21</h3></div>
        </div>



        <div class="row">
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Employee</th>
                    <th>Completed Date</th>
                    <th>Signature</th>
                </tr>
                <?php
                $employees = \Vanguard\Employee::whereHas('enrolledcourses', function ($q){
                    $q->where('class_id','=' , 13);
                    $q->whereNotNull('completed');
                    $q->whereBetween('completed', ['2019-04-1', '2020-03-29']);

                })->where('company_id', $company->id)->get();
                ?>
                </thead>

                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{$employee->last_name ?? ''}} {{$employee->first_name ?? ''}}</td>
                        <td>
                            @foreach($employee->enrolledcourses->where('class_id', 13) as $course)
                            {{Carbon\Carbon::parse($course->completed)->format('m-d-Y')}}
                            @endforeach
                        </td>
                        <td> {{$employee->last_name ?? ''}} {{$employee->first_name ?? ''}} Electronically signed: {{Carbon\Carbon::parse($course->completed)->format('m-d-Y H:i')}} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div style="page-break-after: always; page-break-inside: avoid;" ></div>
    @endforeach
</div>

</body>
</html>