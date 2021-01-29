<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Education Daily</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-vlOMx0hKjUCl4WzuhIhSNZSm2yQCaf0mOU1hEDK/iztH3gU4v5NMmJln9273A6Jz" crossorigin="anonymous">
    <link media="all" type="text/css" rel="stylesheet" href="https://peasi.app/public/assets/css/mdb.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://peasi.app/public/assets/css/style.min.css">





</head>
<body>
<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-8">
            <h1>Crawford County Variance Report</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>Variance Report</td>
                </tr>
                <tr>
                    <td>Date Ran</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
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
       <table class="table table-striped">
           <thead>
                <tr>
                    <th>Run Date</th>
                    <th>Incident Type</th>
                    <th>Incident Address</th>
                    <th>Reason</th>
                    <th>Description</th>
                    <th>Crew</th>
                </tr>
           </thead>
           <tbody>
           @foreach($incidents as $row)
                <tr>
                    <td>{{ Carbon\Carbon::parse($row->call_time)->format('m-d-y H:i') }}</td>
                    <td>{{ $row->call_type->description }}</td>
                    <td>{{ $row->street_number }} {{ $row->street }} {{ $row->city }} {{ $row->state }} {{ $row->zip }}</td>
                    <td></td>
                    <td></td>
                    <td>
                        @foreach($row->crew as $crew)

                            <div class="row">
                                <div class="col-xl-12">
                                   {{$crew->employee->first_name or ''}} {{$crew->employee->last_name or ''}} -- @if($crew->level ==1) EMT @elseif($crew->level == 2) AEMT @elseif($crew->level == 3) MEDIC @endif  @if($crew->assignment == 1) (Driver) @elseif($crew->assignment == 2) (Attendant) @elseif($crew->assignment == 3) (Assistant) @elseif($crew->assignment == 4) (Student) @endif
                                </div>
                            </div>

                            @endforeach
                    </td>
                </tr>
               @endforeach
           </tbody>
       </table>
   </div>


</div>



</div>


</div>
</body>
<footer>

</footer>

</html>
