<html>
<head>
	<title>Employee Application - PDF</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="http://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


</head>
<body>
<div class="container">
    <div class="row">
        <h2>Applicants Demographic Data</h2>
    </div>
    <div class="row">
        <div class="col-5 ">
            
        </div>
        <div class="col-3 border-bottom mr-2">
            {{ Carbon\Carbon::parse($employees->created_at)->format('M d, Y') }}
        </div>
        <div class="col-3 border-bottom mr-2">
            TBD
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-5 mr-2">
            
        </div>
        <div class="col-3 mr-2">
            <strong>Date Completed</strong>
        </div>
        <div class="col-3 mr-2">
            <strong>Interview Date</strong>
        </div>
    </div>
    
    
    <div class="row">
        <div class="col-5 ">
            
        </div>
        <div class="col-3 border-bottom mr-2">
            {{$employees->station->station}} 
        </div>
        <div class="col-3 border-bottom mr-2">
            {{$employees->employeepositions->label}}
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-5 mr-2">
            
        </div>
        <div class="col-3 mr-2">
            <strong>Station</strong>
        </div>
        <div class="col-3 mr-2">
            <strong>Position</strong>
        </div>
    </div>
    
    <div class="row">
        <div class="col-4 border-bottom mr-2">
            {{$employees->first_name}}
        </div>
        <div class="col-3 border-bottom mr-2">
            {{$employees->middle_name}}
        </div>
        <div class="col-4 border-bottom mr-2">
            {{$employees->last_name}}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-4 mr-2">
            <strong>First Name</strong>
        </div>
        <div class="col-3 mr-2">
            <strong>Middle Name</strong>
        </div>
        <div class="col-4 mr-2">
            <strong>Last Name</strong>
        </div>
    </div>
    
    <div class="row">
        <div class="col-2 border-bottom mr-2">
            {{ Carbon\Carbon::parse($employees->dob)->format('m/d/Y') }}
        </div>
        <div class="col-1 border-bottom mr-2">
            <?php
            $dateOfBirth = $employees->dob;
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            ?>
            {{$diff->format('%y')}}
        </div>
        <div class="col-3 border-bottom mr-2">
            {{ '('.substr($employees->phone_mobile, 0, 3).') '.substr($employees->phone_mobile, 3, 3).'-'.substr($employees->phone_mobile,6)  }}
        </div>
        <div class="col-5 border-bottom mr-2">
            {{$employees->personal_email}}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-2 mr-2">
            <strong>Date of Birth</strong>
        </div>
        <div class="col-1 mr-2">
            <strong>Age</strong>
        </div>
        <div class="col-3 mr-2">
            <strong>Phone</strong>
        </div>
        <div class="col-5 mr-2">
            <strong>Email</strong>
        </div>
    </div>
    
    <div class="row">
        <div class="col-5 border-bottom mr-2">
            {{$employees->street_number}} {{$employees->route}}
        </div>
        <div class="col-2 border-bottom mr-2">
            {{$employees->locality}}
        </div>
        <div class="col-3 border-bottom mr-2">
            {{$employees->state}}
        </div>
        <div class="col-1 border-bottom mr-2">
            {{$employees->postal_code}}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-5 mr-2">
            <strong>Address</strong>
        </div>
        <div class="col-2 mr-2">
            <strong>City</strong>
        </div>
        <div class="col-3 mr-2">
            <strong>State</strong>
        </div>
        <div class="col-1 mr-2">
            <strong>Zip</strong>
        </div>
    </div>
    
    <div class="row">
        <div class="col-4 border-bottom mr-2">
            {{$employees->drivers_license}}
        </div>
        <div class="col-4 border-bottom mr-2">
            {{$employees->driver_license_state}}
        </div>
        <div class="col-3 border-bottom mr-2">
            {{ Carbon\Carbon::parse($employees->drivers_license_expiration)->format('m/d/Y') }}
        </div>
    </div>
    
    <div class="row mb-5">
        <div class="col-4 mr-2">
            <strong>Drivers License </strong>
        </div>
        <div class="col-4 mr-2">
            <strong>State</strong>
        </div>
        <div class="col-3 mr-2">
            <strong>Expiration</strong>
        </div>
        
    </div>
    
    <div class="row">
        <h2 class="text-center">Applicant Certifications</h2>
    </div>
    
    <div class = "row">
        
        
        <div class="col-lg-12">
            @if($employees->statecertifications)
            @foreach($employees->statecertifications as $row)
            <?php
            $cert = Vanguard\ApplicationCertification::find($row);
            ?>
            
            <!-- Grid column -->
              <div class="col-4">
            
                <!--Panel-->
                <div class="card card-body">
                  <h4 class="card-title">@if($row->state == 1)Ohio @elseif($row->state == 2) Kentucky @elseif($row->state == 3) WV @endif</h4>
                  <p class="card-text"> Expiration: {{ Carbon\Carbon::parse($row->expiration)->format('m-d-Y') }}</p>
                </div>
                <!--/.Panel-->
            
              </div>
              <!-- Grid column -->
        @endforeach
            @endif
            
        </div>
        </div>
        

    
    <div class="row">
        <h2 class="text-center">Applicant Questionnaire</h2>
    </div>
    
    
    <div class="row mb-2">
        <div class="col-8">How many years driving a personal vehicle do you have?</div>
        <div class="col-3 border-bottom text-center">{{$employees->interview->year_pdrive or 'Not Applicable'}}</div>
    </div>
    
    <div class="row mb-2">
        <div class="col-8">How many years driving a commercial vehicle do you have?</div>
        <div class="col-3 border-bottom text-center">{{$employees->interview->year_cdrive or 'Not Applicable'}}</div>
    </div>
    
    <div class="row mb-2">
        <div class="col-8">How many years driving a emergency vehicle do you have?</div>
        <div class="col-3 border-bottom text-center">{{$employees->interview->year_edrive or 'Not Applicable'}}</div>
    </div>
    
    <div class="row mb-2">
        <div class="col-8">Have you ever worked for in EMS before?</div>
        <div class="col-3 border-bottom text-center">{{$employees->interview->emswork or 'Not Applicable'}}</div>
    </div>
    
    <div class="row mb-2">
        <div class="col-8">If yes how many years have you served in EMS?</div>
        <div class="col-3 border-bottom text-center">{{$employees->interview->ems_years or 'Not Applicable'}}</div>
    </div>
    
    <div style = "display:block; clear:both; page-break-after:always;"></div>
    
    <div class="row">
        <h2>Applicants Employment History</h2>
    </div>
    
     <div class="row">
        <div class="col-4 border-bottom mr-2">
            {{$employees->first_name}}
        </div>
        <div class="col-3 border-bottom mr-2">
            {{$employees->middle_name}}
        </div>
        <div class="col-4 border-bottom mr-2">
            {{$employees->last_name}}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-4 mr-2">
            <strong>First Name</strong>
        </div>
        <div class="col-3 mr-2">
            <strong>Middle Name</strong>
        </div>
        <div class="col-4 mr-2">
            <strong>Last Name</strong>
        </div>
    </div>
    
    <div class="row">
        <table class="table table-striped">
            
            <thead>
                <tr>
                <th>Start</th>
                <th>End</th>
                <th>Name</th>
                <th>Address</th>
                <th>Wage</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees->work as $row)
                <tr>
                <td>{{$row->start}}</td>
                <td>{{$row->end}}</td>
                <td>{{$row->name}}</td>
                <td>{{$row->address}}</td>
                <td>{{$row->wage}}</td>
                </tr>
                <tr>
                <td colspan="5">Reason Left: {{$row->leave}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    
    <div style = "display:block; clear:both; page-break-after:always;"></div>
    
    <div class="row">
        <h2>Applicants Education History</h2>
    </div>
    
     <div class="row">
        <div class="col-4 border-bottom mr-2">
            {{$employees->first_name}}
        </div>
        <div class="col-3 border-bottom mr-2">
            {{$employees->middle_name}}
        </div>
        <div class="col-4 border-bottom mr-2">
            {{$employees->last_name}}
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-4 mr-2">
            <strong>First Name</strong>
        </div>
        <div class="col-3 mr-2">
            <strong>Middle Name</strong>
        </div>
        <div class="col-4 mr-2">
            <strong>Last Name</strong>
        </div>
    </div>
    
    <div class="row">
        <table class="table table-striped">
            
            <thead>
                <tr>
                <th>Completed</th>
                <th>School</th>
                <th>State</th>
                <th>Degree</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees->school as $row)
                <tr>
                <td>{{$row->completed}}</td>
                <td>{{$row->school}}</td>
                <td>{{$row->state}}</td>
                <td>{{$row->degree}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
    
</body>

</html>