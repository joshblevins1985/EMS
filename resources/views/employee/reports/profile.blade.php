<html>
<head>
    <title>Employee Application - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-6">
            <img src="{{ url('/assets/img/peasi.png') }}" alt="logo" style="width: 100%; height: 150px; "/>
        </div>
        <div class="col-6 text-center">
            <h1>Employee Profile</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6 text-center">
            @permission('view.photo')
            <!-- Card image -->
            <img src="{{asset('storage/employee_photos/'.$employee->eid.'.png')}}"
                 onerror="this.src='/storage/employee_photos/nouser.png'" alt="" style="height:450px; ">
            @endpermission
        </div>
        <div class="col-6">
            <table class="table table-striped">
                <tr>
                    <th>Full Name</th>
                    <td>{{$employee->last_name}}, {{$employee->first_name}}</td>
                </tr>
                <tr>
                    <th>Employee ID</th>
                    <td>{{$employee->eid ?? 'Unknown'}}</td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td>{{\Carbon\Carbon::parse($employee->dob)->format('m/d/Y')}}
                        - {{Carbon::parse($employee->dob)->age}}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td>{{$employee->employeepositions->label ?? 'Unknown'}}</td>
                </tr>
                <tr>
                    <th>Primary Station</th>
                    <td>{{$employee->station->station ?? 'Unknown'}}</td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td> {{ '('.substr($employee->phone_mobile, 0, 3).') '.substr($employee->phone_mobile, 3, 3).'-'.substr($employee->phone_mobile,6)  }}
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td> {{$employee->email}} </td>
                </tr>
                @foreach($employee->certificates->where('status', '<', '3')->whereIn('type', array(1,2,5,6,7,8,14,15,16)) as $row)
                    <tr>
                        <th> {{$row->types->type}} - {{$row->types->states->label}}</th>
                        <?php
                        $date = Carbon\Carbon::parse($row->expiration_date);
                        $now = Carbon\Carbon::now();

                        $diff = $date->diffInDays($now);
                        ?>
                        <td> Valid - {{$diff}} days remaing</td>
                    </tr>
                @endforeach

                <tr>
                    <th>FEMA</th>
                    <td>Qualified - {{\Carbon\Carbon::now()->format('m/d/Y')}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="col-12 text-center">
                <h2 class="text-center">Required Trainings</h2>
            </div>

            <div class="col-12">
                <div class="col-12">

                    <table class="table table-sm">
                        @foreach($courses as $row)
                            <tr>
                                <th>{{$row->short_name}}</th>
                                <td>
                                    @if($row->instructed)
                                        @foreach($row->instructed as $class)

                                                <?php
                                                $enrollment = Vanguard\EnrolledStudent::where('class_id', $class->id)->where('user_id', $employee->user_id)->where('status', 1)->get();
                                                ?>
                                                @if ($enrollment)
                                                    @foreach($enrollment as $erow)
                                                        <p>{{Carbon\Carbon::parse($erow->completed)->format('m/d/Y')}}</p>
                                                    @endforeach
                                                @else
                                                    Incomplete
                                                @endif


                                        @endforeach
                                    @else
                                        Incomplete
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="col-12 text-center">
                <h2 class="text-center">Required Competency</h2>
            </div>

            <div class="col-12">
                <div class="col-12">

                    <table class="table table-sm">
                        @foreach($employee->competencies as $row)
                            <tr>
                                <th>{{$row->competency->label}}</th>
                                <td>
                                    @if($row->completed)
                                    <p>{{Carbon\Carbon::parse($row->completed)->format('m/d/Y')}}</p>
                                    @else

                                    @endif

                                </td>
                            </tr>
                        @endforeach
                    </table>

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="col-12 text-center">
                <h2 class="text-center">Required Documents</h2>
            </div>

            <div class="col-12">
                <div class="col-12">

                    <table class="table">

                    </table>

                </div>
            </div>
        </div>

    </div>
    <div style="page-break-after: always; page-break-inside: avoid;"></div>
    <div class="row">
        @foreach($employee->certificates->where('status', '<', 3) as $row)
            <div class="col-4" style="border-style: solid; page-break-inside: avoid;">

                <div class="row">
                    <img src="{{asset('storage/certificates/'.$row->file)}}"
                         alt="" style="height: 275px; width: 100%">
                </div>
                <div class="row">
                    <table class="table">
                        <tr>
                            <th>{{$row->types->type}} - {{$row->types->states->label ?? ''}}</th>
                            <th>Expires: {{Carbon\Carbon::parse($row->expiration_date)->format('m/d/Y')}}</th>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach
    </div>

</div>

</body>

</html>