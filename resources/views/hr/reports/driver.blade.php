<html>
<head>
	<title>Quality Assurance - PDF</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
    <div class="col-8">
        <h1>Driver Report - {{$status}}</h1>
    </div>
    <div class="col-4">
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <td>Driver Report</td>
                </tr>
                <tr>
                    <td>Date Ran</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>
                
                <tr>
                    <td>Requested By:</td>
                    <td>{{ auth()->user()->present()->nameOrEmail }}</td>
                </tr>
            </tbody>
        </table>
        
    </div> 
    <hr>
</div>

<div class="row">
    <div class="col-12">
        <table class = "table table">
            <thead>
                <tr>
                   <th width="5%">EID</th>
                    <th width="15%">Last Name</th> 
                    <th width="15%">First Name</th>
                    <th width="5%"> Status </th>
                    <th width="10%">Reassessment</th>
                    <th width="40%">Non-Driver Reason</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $row)
                <tr>
                    <td>{{$row->eid}}</td>
                    <td>{{$row->last_name}}</td>
                    <td>{{$row->first_name}}</td>
                    <td>@if($row->driver == 0) ND @elseif($row->driver == 1) D @elseif($row->driver == 2) 30-1 @elseif($row->driver == 3) 30-2 @elseif($row->driver == 4) 30-3  @elseif($row->driver == 5) BTD  @else UNK @endif</td>
                    <td>{{$row->dod}}</td>
                    <td>@if($row->nd_reason == 1) Insurance @elseif($row->nd_reason == 2) Accident @elseif($row->nd_reason == 3) Administration @elseif($row->nd_reason == 4) Not Applicable @elseif($row->nd_reason == 5) Age < 20 @elseif($row->nd_reason == 6) License < 2  @else Unknown @endif @if($row->driver_note) -- {{$row->driver_note}} @endif</td>
                </tr>
              @endforeach
            </tbody>
        </table>
    </div>
</div>

</div>
</body>
</html>