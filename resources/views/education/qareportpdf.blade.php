<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Quality Assurance - PDF</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
    <div class="col-8">
        <h1>Quality Assurance Report</h1>
    </div>
    <div class="col-4">
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <td>Quality Assurance Report</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>{{date('m-d-Y', strtotime($start))}}</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>{{date('m-d-Y', strtotime($end))}}</td>
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
                   <th>Total Sufficient</th>
                    <th>Total Insufficient</th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($qa_count as $row)
                        <td>{{$row->count}}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

@foreach($qas as $row)
<div class="row">
    <div class="col-12">
        <h5>{{$row->first_name}} {{$row->last_name}} -- {{$row->eid}} -- Phone: {{ $row->phone_mobile ?? 'Unknown' }}</h5>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <table class="table table">
                            <tr>
                   <th width="5%">QA Date</th>
                   <th width="5%" >Run Date</th>
                   <th width="40%">Comments</th>
                    <th width="40%">Opportunities</th>
                    <th width="5%">Grade</th>
                    <th width="5%">Acknowledged</th>
                </tr>
            
            <tbody>
                @foreach($row->qa as $row)
                <tr>
                    <td>{{date('m-d-Y', strtotime($row->created_at))}}</td>
                   <td>{{date('m-d-Y', strtotime($row->date))}}</td>
                    <td>{!!$row->comments!!}</td>
                    <td>
                        @foreach($row->deficiencies as $row2)
                            <p>{{$row2->defficiency}}</p>
                        @endforeach
                        
                    </td>
                    <td @if($row->grade == 2) class="bg-danger" @endif>@if($row->grade == 1) Sufficient @elseif($row->grade == 2) Insufficient @else Unknown @endif </td>
                    <td>@if(is_null($row->acknowledged)) Pending
 @else Acknowledged
 @endif</td>
                    
                </tr>
                @endforeach
                

                
            </tbody>
        </table>
    </div>
</div>

@endforeach
</div>
</body>
</html>