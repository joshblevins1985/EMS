<html>
<head>
    <title>Quality Assurance - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
          <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <style>
        tr {
            page-break-inside: avoid
        }
    </style>
</head>
<body>
<div class="container">

    @foreach($stations as $station)

                        <div class="row">
            <div class="col-12">
                <h1 class="text-center">Portmouth Emergency Ambulance Service Inc Training Department</h1>
                <h4 class="text-center">2820 Gallia Street Portsmouth Ohio 45662 (740)351-2667</h4>
                <h6 class="text-center">ODPS #1327 -- Director of Education Joshua Blevins</h6>
                <h6 class="text-center">Course Roster</h6>
            </div>
        </div>
        
        <div class="row">
            <div class="col-8">Course:<span>{{$class->label or 'Unknown Course'}}</span></div>
            <div class="col-4">Date: {{ Carbon\Carbon::parse($class->created_at)->format('m-d-Y') }}</div>
        </div>
        <div class="row">
            <div class="col-2">
                <span class="font-weight-bold">Start:</span> &nbsp&nbsp <u></u>
            </div>
            <div class="col-2">
                <span class="font-weight-bold">End:</span> &nbsp&nbsp <u></u>
            </div>
            <div class="col-2">
                <span class="font-weight-bold">Total</span>________
            </div>
            
            <div class="col-1">
                <span class="font-weight-bold">Instructor</span>
            </div>
            
            <div class="col-2">
                @foreach($class->instructors as $instructor)
                <u>{{$instructor->first_name ?? 'Unknown Instructor'}}  {{ $instructor->last_name ?? '' }}</u>
                @endforeach
            </div>
            
            <div class="col-1">
                <span class="font-weight-bold">Guest</span>
            </div>
            
            <div class="col-2">
                ___________________________
            </div>
    
        </div>

        
        

<div class="row">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th>Date</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Email</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Completed</th>
            <th>Signature</th>
        </tr>
        </thead>
        <?php
        $students = Vanguard\ClassRoomEnrolledStudent::
        where('classroom_id', $class->id)
        ->get();
        ?>
        <tbody>
        @foreach($students as $row)
        <tr>
            <td>{{ Carbon\Carbon::parse($row->completed)->format('m-d-Y') }}</td>
            <td>{{$row->employee->last_name or 'Unknown'}}</td>
            <td>{{$row->employee->first_name or ''}}</td>
            <td>{{$row->employee->email or ''}}</td>
            <td>{{$row->created_at or ''}}</td>
            <td>{{$row->completed or ''}}</td>
            <td>@if($row->completed) {{ Carbon\Carbon::parse($row->completed)->format('m-d-Y') }} @else Incomplete @endif </td>
            <td>@if($row->completed) <span style="font-family: 'Roboto', sans-serif;" >{{$row->student->first_name or 'Unknown'}} {{$row->student->last_name or
                'Unknown'}} </span> {{Carbon\Carbon::parse($row->completed)->format('m-d-Y H:i') }} @else  @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div style="page-break-inside: avoid;">
   
</div>
@endforeach


</div>

</body>
</html>