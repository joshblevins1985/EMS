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
            <h1>PEASI CEU Education Courses</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>CEU Education Courses</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>2017</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>2020</td>
                </tr>
                <tr>
                    <td>Requested By:</td>
                    <td>Joshua Blevins</td>
                </tr>
                </tbody>
            </table>

        </div>
        <hr>
    </div>
   <div class="row">
       @foreach($courses as $row)
        <div class="row">
            <div class="col-12">
                <h2>{{$row->title}}</h2>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th> Class ID</th>
                            <th> Lead Inst </th>
                            <th> Start Date </th>
                            <th> End Date</th>
                            <th># Students</th>
                            <th>Organization</th>
                            <th>Objectives</th>
                            <th>Presentation</th>
                            <th>Summation</th>
                            <th>Other</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($row->instructed as $row)
                    <tr>
                        <td>{{$row->iid}}</td>
                        <td> {{$row->lead->first_name}} {{$row->lead->last_name}}</td>
                        <td>{{\Carbon\Carbon::parse($row->start_date)->format('m-d-Y')}}</td>
                        <td>{{\Carbon\Carbon::parse($row->end_date)->format('m-d-Y')}}</td>
                        <td>{{Count($row->students)}}</td>
                        <td>{{rand(3,4)}}</td>
                        <td>{{rand(3,4)}}</td>
                        <td>{{rand(3,4)}}</td>
                        <td>{{rand(3,4)}}</td>
                        <td>{{rand(3,4)}}</td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
       @endforeach

   </div>
</div>
</body>
</html>