<html>
<head>
	<title>Quality Assurance - PDF</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


</head>
<body>
<div class="container">
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-12">
            <span class="text-center"><h4><strong>Portsmouth Emergency Ambulance Service INC. Training Department</strong></h4></span>
        </div>
        
    </div>
    <div class="row">
        <div class="col-3">
            <span class="text-center"><h6><strong>training@peasi.net</strong></h6></span>
        </div>
        <div class="col-6">
            <span class="text-center"><h6><strong>(740) 351-2667 Director of Education: Joshua Blevins</strong></h6></span>
        </div>
        <div class="col-3">
            <span class="text-center"><h6><strong>ODPS# 1327</strong></h6></span>
        </div>
        <hr>
        </div>
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-12">
            <span class="text-center"><h6><strong>Certification of Completed Continuing Education</strong></h6></span>
        </div>
    </div>
    
    <div class="row" style="margin-bottom: 25px;">
        <div class="col-12">
            {{$hx->first_name}} {{$hx->last_name}} 
        </div>
    </div>
    <div class="row">
           <div class="col-12">
            Certification Level: {{$hx->employeepositions->label or 'Uknown' }}
            </div> 
        </div>
        @foreach($hx->statecertifications as $row)
        <div class="row">
            <div class="col-4">
            @if($row->state == 1)
            Ohio
            @elseif($row->state == 2)
            Kentucky
            @elseif($row->state == 3)
            West Virginia
            @endif
            </div>
            <div class="col-4">
                {{$row->certtype->label or 'Unknown'}}
            </div>
            <div class="col-4">
                {{$row->certification_number}}
            </div>
        </div>
        
        @endforeach
    
    <div class="row" style="margin-bottom: 25px; margin-top: 25px;">
        <div class="col-12">
            I certifify that the below list of EMS Continuing Education hours have been completed by the above listed Emergency Medical Services Provider.
        </div>
        
    </div>
    
    <div class="row" style="margin-bottom: 25px;">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Instructor</th>
                    <th>Date Completed</th>
                    <th>Total Hours</th>
                </tr>
            </thead>
            <tbody>
                @foreach($hx->enrolledcourses->where('status', 1) as $row)
                <tr>
                    <td>{{$row->instructed->course->title or 'Unknown' }}</td>
                    <td>{{$row->instructed->lead->first_name or 'Unknown'}} {{$row->instructed->lead->last_name or ''}}</td>
                    <td>{{ Carbon\Carbon::parse($row->completed)->format('m-d-Y') }}</td>
                    <td>{{$row->instructed->course->hours or 'Unknown' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="row">
        <div class="col-12" style="margin-bottom: 15px;">
            Thank You
        </div>
        
        
    </div>
    <div class="row">
        <div class="col-12" style="margin-bottom: 15px;">
            <img src="{{ url('public/assets/img/signature.png') }}" height="100" >
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            Joshua P. Blevins EMT-P EMS-I </br>
            Director of Education
        </div>
    </div>
</div>
</body>

</html>