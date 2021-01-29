<html>
<head>
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
            <h1>Education Daily Report</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>Education Daily Report</td>
                </tr>
                <tr>
                    <td>Date Ran</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>

                <tr>
                    <td>Requested By:</td>
                    <td>System Generated</td>
                </tr>
                </tbody>
            </table>

        </div>
        <hr>
    </div>

    <div class="row mb-5">
        <div class="col-4 text-white">
            <div class="row-fluid mb-5 unique-color-dark">
                <!-- Title -->
                <h4 class="card-header-title mb-3">Pending PCR Fixes</h4>
                <!-- Subtitle -->
                <p class="card-header-subtitle mb-0"></p>
            </div>

        </div>
        <div class="col-4 text-white">
            <div class="row-fluid mb-5 unique-color-dark">
                <!-- Title -->
                <h4 class="card-header-title mb-3">Pending CPR PMT</h4>
                <!-- Subtitle -->
                <p class="card-header-subtitle mb-0"></p>
            </div>
        </div>
        <div class="col-4 text-white">
            <div class="row-fluid mb-5">
                <!-- Title -->
                <h4 class="card-header-title mb-3 unique-color-dark">Pending CPR Process</h4>
                <!-- Subtitle -->
                <p class="card-header-subtitle mb-0"></p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <!-- Card -->
            <div class="card">

                <!-- Card image -->
                <div class="view view-cascade gradient-card-header blue-gradient">

                    <!-- Title -->
                    <h2 class="card-header-title mb-3">TO - DO List</h2>
                    <!-- Subtitle -->
                    <p class="card-header-subtitle mb-0">Education Tasks To Be Completed</p>

                </div>

                <!-- Card content -->
                <div class="card-body card-body-cascade text-center">

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Task</th>
                            <th>Assigned To</th>
                            <th>Planned Completion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($todo)
                        @foreach($todo as $row)
                        <tr>
                            <td>{{$row->task}}</td>
                            <td>{{$row->employee->first_name or ''}}</td>
                            <td>{{ Carbon\Carbon::parse($row->expected_complete)->format('m-d-Y') }}</td>
                        </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>

                </div>

            </div>
            <!-- Card -->


        </div>
        <div class="col-6">
            <!-- Card -->
            <div class="card">

                <!-- Card image -->
                <div class="view view-cascade gradient-card-header blue-gradient">

                    <!-- Title -->
                    <h2 class="card-header-title mb-3">Upcoming Courses</h2>
                    <!-- Subtitle -->
                    <p class="card-header-subtitle mb-0"> CEU / CPR Classes </p>

                </div>

                <!-- Card content -->
                <div class="card-body card-body-cascade text-center">
                    @if(count($cpr))
                    <div class="list-group keep-together">
                        @foreach($cpr as $row)
                        <a class="list-group-item list-group-item-action flex-column align-items-start" href="#!">
                            <div class="d-flex w-100 justify-content-between">
                                <div class="row">
                                    <div class='col-12'>{{date('M-d-y H:i', strtotime($row->start_date))}} to
                                        {{date('M-d-y H:i', strtotime($row->end_date))}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        Location
                                    </div>
                                    <div class="col-6">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <address>
                                            <strong>{{$row->facility->name}}</strong><br>
                                            {{ $row->facility->house_number }} {{ $row->facility->street }}<br> {{
                                            $row->facility->city }} {{ $row->facility->state }} {{ $row->facility->zip
                                            }}
                                        </address>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <small>Instructor: {{$row->teacher->first_name or 'No Instructor Assigned'}} {{$row->teacher->last_name or 'South Shore Nursing and Rehab'}}</small>
                                        <br>
                                        <small>AC-{{date('y', strtotime($row->start_date))}}-{{$row->id}}</small>
                                    </div>
                                </div>

                        </a>
                    </div>
                    @endforeach
                    @else
                    No CPR Classes within 14 days.
                    @endif

                    @if(count($ceu))
                    <div class="list-group keep-together" >
                        @foreach($ceu as $row)
                        <a class="list-group-item list-group-item-action flex-column align-items-start" href="#!" style="page-break-inside: avoid;" >
                            <div class="d-flex w-100 justify-content-between" style="page-break-inside: avoid;">
                                <div class="row">
                                    <div class='col-12'>{{date('M-d-y H:i', strtotime($row->course_date))}}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        Location
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <address>
                                            <strong>{{$row->class_dates->course->title}}</strong> <br>
                                            {{$row->class_dates->location or 'Unknown Location' }}
                                        </address>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <small>Instructor: {{$row->instruct->first_name or 'No Instructor Assigned'}} {{$row->instruct->last_name or ''}}</small>
                                        <br>

                                    </div>
                                </div>

                        </a>
                    </div>
                    @endforeach
                    @else
                    No CEU Classes within 14 days.
                    @endif

                </div>

            </div>

        </div>
        <!-- Card -->

    </div>


</div>



</div>


</div>
</body>
<footer>

</footer>

</html>