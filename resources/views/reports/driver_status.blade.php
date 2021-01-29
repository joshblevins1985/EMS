<html>
<head>
    <title>Weekly Employee Report - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link media="all" type="text/css" rel="stylesheet" href="https://peasi.app/public/assets/css/mdb.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://peasi.app/public/assets/css/style.min.css">

</head>
<body>
<div class="container">
    <div class="row mb-5">
        <div class="col-8">
            <h1>Weekly Employee Status Report</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>Weekly Employee Status Report</td>
                </tr>
                <tr>
                    <td>Date Ran</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>

                <tr>
                    <td>Requested By:</td>
                    <td>System Generated</td>

                </tr>

                </tbody>
            </table>

        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-3">
            Cleared Drivers
        </div>
        <div class="col-1">
            {{count($nd)}}
        </div>
        <div class="col-3">
            FTO Employees
        </div>
        <div class="col-1">
            {{count($e->where('employee_status', 2))}}
        </div>
        <div class="col-3">
            Drivers Orientation
        </div>
        <div class="col-1">
            {{count($e->where('employee_status', 3))}}
        </div>

    </div>

    <div class="row">
        <h1>Newly Cleared Drivers</h1>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Station</th>

            </tr>
            </thead>
            <tbody>
            @if(count($nd) > 0)
            @foreach($nd as $row)
            <tr>
                <td>{{$row->employees->last_name}}, {{$row->employees->first_name}}</td>
                <td>{{$row->employees->station->station}}</td>

            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="2" > No Drivers Cleared in the last 7 days.</td>
            </tr>
            @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <h1>Field Orientation Employees</h1>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Date of Hire</th>
                <th>Station</th>
                <th>Employee Type</th>
            </tr>
            </thead>
            <tbody>

            @foreach($e->where('employee_status', 2) as $row)
            <tr>
                <td>{{$row->last_name}}, {{$row->first_name}}</td>
                <td>{{ Carbon\Carbon::parse($row->doh)->format('m-d-Y') }}</td>
                <td>{{$row->station->station}}</td>
                <td>{{$row->employeepositions->label}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="row">
        <h1>Driver Orientation Employees</h1>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Station</th>
            </tr>
            </thead>
            <tbody>
            @foreach($e->where('employee_status', 3) as $row)
            <tr>
                <td>{{$row->last_name}}, {{$row->first_name}}</td>
                <td>{{$row->station->station}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>



</div>
</body>
<footer>

</footer>

</html>