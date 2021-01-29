<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
    
    <style>
    thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>
</head>
<body>
<div class="container">
        <div class="row">
    <div class="col-7">
        <h2>Field Training Officer Payment Report</h2>
    </div>
    <div class="col-5">
        <table>
            <tbody>
            <tr>
                <td>Date</td>
                <td>{{date('M-d Y')}}</td>
            </tr>
            <tr>
                <td>Reported by:</td>
                <td>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>
            </tr>

            </tbody>
        </table>
    </div>
</div>
<hr>
    
    <div class="row">
    <table class="table">
        <thead>
            <tr>
                <th>Training Officer</th>
                <th> Employee ID</th>
                <th>Total Owed</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $row)
            <tr>
                <td>{{ $row->last_name }} {{ $row->first_name }}</td>
                <td>{{ $row->eid }}</td>
                <td>
                    <?php $total = 0 ?>
                @foreach($row->ftopaydates->where('payroll', 0) as $frow)
                    <?php
                    if($frow->trainee->primary_position == 3){
                        $total = $total + 10;
                    }
                    elseif($frow->trainee->primary_position == 4){
                        $total = $total + 15;
                    }
                    elseif($frow->trainee->primary_position == 5){
                        $total = $total + 20;
                    }
                    elseif($frow->trainee->primary_position == 11) {
                        $total = $total + 5;
                    }
                    ?>
                @endforeach
                
                {{number_format((float)$total, 2, '.', '')}}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div style="page-break-after: always; page-break-inside: avoid;"></div>
@foreach($employees as $row)
<div class="row">
    <div class="col-7">
        <h2>Field Training Officer Payment Report</h2>
    </div>
    <div class="col-5">
        <table>
            <tbody>
            <tr>
                <td>Date</td>
                <td>{{date('M-d Y')}}</td>
            </tr>
            <tr>
                <td>Reported by:</td>
                <td>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>
            </tr>
            <tr class="table-warning">
                <td class="font-weight-bold">FTO Employee:</td>
                <td class="font-weight-bold"> {{$row->first_name}} {{$row->last_name}} </td>
            </tr>
            <tr class="table-warning">
                <td class="font-weight-bold">FTO EID:</td>
                <td class="font-weight-bold"> {{$row->eid}} </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<hr>

<div class="row">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Date</th>
            <th>Employee Trained</th>
            <th>Total Hours</th>
            <th>Daily Stipend</th>
        </tr>
        </thead>
        <tbody>
        <?php $total = 0 ?>
        @foreach($row->ftopaydates->where('payroll', 0) as $frow)
        <tr>
            <td>{{ Carbon\Carbon::parse($frow->date)->format('m/d/Y') }}</td>
            <td>{{$frow->trainee->first_name or 'Unknown'}} {{$frow->trainee->last_name or ''}} -- {{$frow->trainee->eid or ''}}</td>
            <td>{{$frow->total_hours}}</td>
            <td>@if($frow->trainee->primary_position == 3) $10.00 @elseif($frow->trainee->primary_position == 4) $15.00 @elseif($frow->trainee->primary_position == 5) $20.00 @elseif($frow->trainee->primary_position == 11) $5.00 @endif</td>
        </tr>
        <?php
        if($frow->trainee->primary_position == 3){
            $total = $total + 10;
        }
        elseif($frow->trainee->primary_position == 4){
            $total = $total + 15;
        }
        elseif($frow->trainee->primary_position == 5){
            $total = $total + 20;
        }
        elseif($frow->trainee->primary_position == 11) {
            $total = $total + 5;
        }
        ?>
        @endforeach

        </tbody>
    </table>

</div>

<div class="row" style="margin-top: 300px;">
    <div class="col-8">
        <p>Electronically Signed by: Joshua Blevins -- 00395 {{date('m/d/Y H:i:s')}}</p>
        <p>Transfered to payroll:</p>
    </div>
    <div class="col-4"> <h1>Total Pay: {{number_format((float)$total, 2, '.', '')}}</h1></div>
</div>

<p style="page-break-before: always">
    @endforeach
</div>
</body>

<footer>

</footer>
