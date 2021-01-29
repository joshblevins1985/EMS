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
        <h1>Daily Completed Courses</h1>
    </div>
    <div class="col-4">
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <td>Daily Completed Courses</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>
                <tr>
                    <td>Requested By:</td>
                    <td>Auto Generated Email</td>
                </tr>
            </tbody>
        </table>
        
    </div> 
    <hr>
</div>
@foreach($class as $row)
@if(count($row->students))
<div class="row">
    <div class="col-12">
        <div class="row">
            <h3>{{$row->course->title}} -- {{$row->iid}}</h3>
        </div>
        
        <div class="row">
            <table class="table">
        <thead>
            <tr>
            <th>Employee</th>
            <th>Completed Date / Time</th>
            
            </tr>
        </thead>
        <tbody>
           
            @foreach($row->students as $student)
            
            <tr>
                <td> {{$student->student->last_name}},  {{$student->student->first_name}} </td>
                <td>{{date('m-d-Y H:i', strtotime($student->completed))}}</td>
            </tr>
            
            @endforeach
            


        </tbody>
        </table>
        </div>
        
        <hr>
    </div>

</div>
@endif
@endforeach



</div>
</body>
</html>