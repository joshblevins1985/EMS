<html>
<head>
    <title>Quality Assurance - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-vlOMx0hKjUCl4WzuhIhSNZSm2yQCaf0mOU1hEDK/iztH3gU4v5NMmJln9273A6Jz" crossorigin="anonymous">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/mdb.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/style.min.css') }}">

    <script src="https://kit.fontawesome.com/6c1803817f.js"></script>

<style>
    thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>
</head>
<body>
<div class="container">
    <div class="row mb-5">
        <div class="col-8">
            <h1>Scholarship Course Information</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>Scholarship Class Report</td>
                </tr>
                <tr>
                    <td>Date Ran</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>

                <tr>
                    <td>Requested By:</td>
                    <td>{{ auth()->user()->present()->nameOrEmail or 'System Generated' }}</td>
                </tr>
                </tbody>
            </table>

        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-2">
            <strong>School:</strong>
        </div>
        <div class="col-3">
            {{$scholarship->school_name}}
        </div>
        <div class="col-1">
            <strong>Start:</strong>
        </div>
        <div class="col-2">
            @if(!$scholarship->start_date) TBD @else {{ Carbon\Carbon::parse($scholarship->start_date)->format('m-d-Y') }} @endif
        </div>
        <div class="col-1">
            <strong>End:</strong>
        </div>
        <div class="col-2">@if(!$scholarship->end) TBD @else {{ Carbon\Carbon::parse($scholarship->end)->format('m-d-Y') }} @endif
        </div>
    </div>

    <div class="row">
        <div class="col-2">
            <strong>Address:</strong>
        </div>
        <div class="col-10">
            {{$scholarship->address or ''}}
        </div>

    </div>

    <div class="row mb-5">
        <div class="col-3">
            <strong>Student Cost:</strong>
        </div>
        <div class="col-3">
            @if(!$scholarship->cost) TBD @else $ {{round($scholarship->cost, 2)}} @endif
        </div>

        <div class="col-3">
            <strong>Total Cost:</strong>
        </div>
        <div class="col-3">
            <?php $tc = count($scholarship->applicants->where('status', 2)) * $scholarship->cost ?>
            @if(!$scholarship->cost) TBD @else $ {{round($tc, 2)}} @endif
        </div>

    </div>

    <div class="row">
        <div class="row ">
            <div class="col-12 text-center mb-5">
                <h1>Students</h1>
            </div>

            <div class="col-12">

            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Reading</th>
                <th>EMT</th>
                <th>Math</th>
                <th>NC Contract</th>
                <th>Academic Contract</th>
                <th>Book Agreement</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scholarship->applicants as $row)
            <tr @if($row->status == 3) class="bg-danger" @endif>
                <td>
                    <?php
                    if($row->reading < 8){
                        $e = 1;
                    }
                    elseif($row->emt < 63){
                        $e = 1;
                    }elseif($row->math < 96){
                        $e = 1;
                    }else{
                        $e = 0;
                    }

                    ?>

                    @if($e > 0)
                    <span class="badge badge-pill orange"><i class="fas fa-exclamation-triangle"></i></span>
                    @endif

                </td>
                <td>{{$row->student}}</td>
                <td>@if($row->reading > 0) @if($row->reading >= 8) <span class="badge badge-pill green">{{$row->reading}}</span>  @elseif($row->reading < 8) <span class="badge badge-pill red">{{$row->reading}}</span> @endif @else <span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span> @endif</td>
                <td>@if($row->emt > 0) @if($row->emt >= 63) <span class="badge badge-pill green">{{$row->emt}}</span> @elseif($row->emt < 63) <span class="badge badge-pill red">{{$row->emt}}</span> @endif @else <span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span> @endif</td>
                <td>@if($row->math > 0) @if($row->math >= 96) <span class="badge badge-pill green">{{$row->math}}</span> @elseif($row->math < 96) <span class="badge badge-pill red">{{$row->math}}</span> @endif @else <span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span> @endif</td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td>
                    @if($row->status == 1) Applied @elseif($row->status == 2) Accepted @elseif($row->status == 3) Denied @elseif($row->status == 4) Enrolled @elseif($row->status == 5) Testing @elseif($row->status == 6) Passed @elseif($row->status == 7) Failed @elseif($row->status == 8) Dropped @endif
                </td>
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