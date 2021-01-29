@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet"/>
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        .hiddenRow {
            padding: 0 !important;
        }
    </style>
@endpush

@section('content')
    <?php
    $ftoTotalHours = 0;
    $driverTotalHours = 0;
    $driverTotalMiles = 0;
    $ftoHoursPercentNewEmployee = 0;
    $driverHoursPercentNewDriver = 0;

    foreach ($employee->fieldtraining as $row) {
        //count fto hours//
        if ($row->type == 1) {
            $ftoTotalHours = $ftoTotalHours + $row->total_hours;
        } // count driver hours//
        elseif ($row->type == 2) {
            $driverTotalHours = $driverTotalHours + $row->total_hours;
        }

        $ftoHoursPercentNewEmployee = $ftoTotalHours / 48 * 100;

        if ($ftoHoursPercentNewEmployee > 100) {
            $ftoHoursPercentNewEmployee = 100;
        }

        if($employee->driver == 1){
        $driverHoursPercentNewDriver = $driverTotalHours / 16 * 100;

        if ($driverHoursPercentNewDriver > 100) {
            $driverHoursPercentNewDriver = 100;
        }
        }else{
            $driverHoursPercentNewDriver = 100;
        }

    }

    $completedFtoTasks = 0;
    $incompleteFtoTasks = 0;

    foreach ($employeeFtoTasks as $row) {
        if (isset($row->fto_signed)) {
            ++$completedFtoTasks;
        }
    }
    $totalFtoTasks = count($ftoTasks);
    if (count($ftoTasks)) {
        $FtoTaskPercentage = $completedFtoTasks / $totalFtoTasks * 100;
    } else {
        $FtoTaskPercentage = 0;
    }



    $totalPercentComplete = $ftoHoursPercentNewEmployee + $driverHoursPercentNewDriver + $FtoTaskPercentage;

    $totalPercentComplete = $totalPercentComplete / 3;


    ?>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Employee Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Field Training Officer Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Employee Field Training</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Field Training Officer Dashboard</h1>
    <!-- end page-header -->
    <div class="row">
        <div class="col-xl-12 text-center">
            <h2>Orientation Profile
                for {{ $employee->employeepositions->label or 'Unknown Level' }} {{ $employee->first_name or 'Unknown' }} {{ $employee->last_name }}  </h2>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated @if($totalPercentComplete <= 25) bg-danger  @elseif($totalPercentComplete >25 && $totalPercentComplete <= 50) bg-warning @elseif($totalPercentComplete > 50 && $totalPercentComplete <= 75) bg-primary @elseif($totalPercentComplete > 75 && $totalPercentComplete <= 99)  bg-info @else bg-success @endif"
                     role="progressbar" aria-valuenow="{{ $totalPercentComplete }}" aria-valuemin="0"
                     aria-valuemax="100" style="width: {{ $totalPercentComplete }}%"></div>
            </div>
        </div>

    </div>
    @if(count($employeeFtoTasks))
        Employee Field Tasks have been added.
    @else
        <a href="/fto/tasksAdd/{{ $employee->user_id }}" class="btn btn-primary btn-block m-10">Add Field Training
            Tasks</a>
    @endif
    <div class="row">

        <div class="col-lg-12">
            <div class="accordian m-5" id="ftoHours">
                <div class="card">
                    <div class="card-header" id="ftoHoursHeading">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapseftoHours" aria-expanded="true" aria-controls="collapseftoHours">
                            Field Training Hours

                        </button>
                        <div class="pull-right">
                            Total Hours Completed {{ $ftoTotalHours }}
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated @if($ftoHoursPercentNewEmployee <= 25) bg-danger  @elseif($ftoHoursPercentNewEmployee >25 && $ftoHoursPercentNewEmployee <= 50) bg-warning @elseif($ftoHoursPercentNewEmployee > 50 && $ftoHoursPercentNewEmployee <= 75) bg-primary @elseif($ftoHoursPercentNewEmployee > 75 && $ftoHoursPercentNewEmployee <= 99)  bg-info @else bg-success @endif"
                                 role="progressbar" aria-valuenow="{{ $ftoHoursPercentNewEmployee }}" aria-valuemin="0"
                                 aria-valuemax="100" style="width: {{ $ftoHoursPercentNewEmployee }}%"></div>
                        </div>
                    </div>

                    <div id="collapseftoHours" class="collapse" aria-labeledby="ftoHoursHeading"
                         data-parent="#ftoHours">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <th></th>
                                <th>Date</th>
                                <th>Field Training Officer</th>
                                <th>Total Hours</th>
                                <th>Approved</th>
                                </thead>
                                <tbody>
                                @foreach($employee->fieldtraining->where('type', 1) as $row)
                                    <tr>
                                        <td></td>
                                        <td>{{ Carbon\Carbon::parse($row->date)->format('m-d-Y') }}</td>
                                        <td>{{ $row->fto->first_name or '' }} {{ $row->fto->last_name or 'unknown'}}</td>
                                        <td>{{ $row->total_hours }}</td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="accordian m-5" id="driverHours">
                <div class="card">
                    <div class="card-header" id="driverHoursHeading">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapsedriverHours" aria-expanded="true"
                                aria-controls="collapsedriverHours">
                            Drivers Training Hours
                        </button>
                        <div class="pull-right">
                            Total Hours Completed {{ $driverTotalHours }}
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated @if($driverHoursPercentNewDriver <= 25) bg-danger  @elseif($driverHoursPercentNewDriver >25 && $driverHoursPercentNewDriver <= 50) bg-warning @elseif($driverHoursPercentNewDriver > 50 && $driverHoursPercentNewDriver <= 75) bg-primary @elseif($driverHoursPercentNewDriver > 75 && $driverHoursPercentNewDriver <= 99)  bg-info @else bg-success @endif"
                                 role="progressbar" aria-valuenow="{{ $driverHoursPercentNewDriver }}" aria-valuemin="0"
                                 aria-valuemax="100" style="width: {{ $driverHoursPercentNewDriver}}%"></div>
                        </div>
                    </div>

                    <div id="collapsedriverHours" class="collapse" aria-labeledby="driverHoursHeading"
                         data-parent="#driverHours">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                <th></th>
                                <th>Date</th>
                                <th>EVOC Instructor</th>
                                <th>Total Hours</th>
                                <th>CheckSheet</th>
                                <th>Reviewed</th>
                                </thead>
                                <tbody>
                                @foreach($employee->fieldtraining->where('type', 2) as $row)
                                    <tr>
                                        <td></td>
                                        <td>{{ Carbon\Carbon::parse($row->date)->format('m-d-Y') }}</td>
                                        <td>{{ $row->fto->first_name or '' }} {{ $row->fto->last_name or 'unknown'}}</td>
                                        <td>{{ $row->total_hours }}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="accordian m-5" id="ftoTasks">
                <div class="card">
                    <div class="card-header" id="ftoTasksHeading">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapseftoTasks" aria-expanded="true" aria-controls="collapseftoTasks">
                            Field Training Tasks
                        </button>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated @if($FtoTaskPercentage <= 25) bg-danger  @elseif($FtoTaskPercentage >25 && $FtoTaskPercentage <= 50) bg-warning @elseif($FtoTaskPercentage > 50 && $FtoTaskPercentage <= 75) bg-primary @elseif($FtoTaskPercentage > 75 && $FtoTaskPercentage <= 99)  bg-info @else bg-success @endif"
                                 role="progressbar"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                 style="width: {{ $FtoTaskPercentage }}%"></div>
                        </div>
                    </div>

                    <div id="collapseftoTasks" class="collapse" aria-labeledby="ftoTasksHeading"
                         data-parent="#ftoTasks">

                        <div class="card-body">

                            @if(count($employeeFtoTasks))
                                <a href="/fto/completeAllTasks/{{ $employee->user_id }}" class="btn btn-primary btn-block m-10">Complete All FTO Tasks</a>
                            @else
                                <a href="/fto/tasksAdd/{{ $employee->user_id }}" class="btn btn-success btn-block m-10">Add Field Training
                                    Tasks</a>
                            @endif
                            <div class="card m-3">
                                <div class="card-header"><h1 class="text-center">Daily Operations Objectives</h1></div>
                                <hr style="height:2px; border:none; color:slategrey; background-color:slategrey; width:60%; margin: 0 auto;">
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Goal</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($ftoTasks->where('category', 1) as $task)
                                            @include('fto.partials.fieldTrainingTableBody')
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                </div>
                            </div>
                            @if(count($ftoTasks->where('category', 2)))
                                <div class="card m-3">
                                    <div class="card-header"><h1 class="text-center">Documentation</h1></div>
                                    <hr style="height:2px; border:none; color:slategrey; background-color:slategrey; width:60%; margin: 0 auto;">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Task</th>
                                                    <th>Goal</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ftoTasks->where('category', 2) as $task)
                                                    @include('fto.partials.fieldTrainingTableBody')
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            @if(count($ftoTasks->where('category', 3)))
                                <div class="card m-3">
                                    <div class="card-header"><h1 class="text-center">Vehicle Operations</h1></div>
                                    <hr style="height:2px; border:none; color:slategrey; background-color:slategrey; width:60%; margin: 0 auto;">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Task</th>
                                                    <th>Goal</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ftoTasks->where('category', 3) as $task)
                                                    @include('fto.partials.fieldTrainingTableBody')
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if(count($ftoTasks->where('category', 4)))
                                <div class="card m-3">
                                    <div class="card-header"><h1 class="text-center">Radio Operations</h1></div>
                                    <hr style="height:2px; border:none; color:slategrey; background-color:slategrey; width:60%; margin: 0 auto;">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Task</th>
                                                    <th>Goal</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ftoTasks->where('category', 4) as $task)
                                                    @include('fto.partials.fieldTrainingTableBody')
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if(count($ftoTasks->where('category', 5)))
                                <div class="card m-3">
                                    <div class="card-header"><h1 class="text-center">Equipment Operations</h1></div>
                                    <hr style="height:2px; border:none; color:slategrey; background-color:slategrey; width:60%; margin: 0 auto;">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Task</th>
                                                    <th>Goal</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ftoTasks->where('category', 5) as $task)
                                                    @include('fto.partials.fieldTrainingTableBody')
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if(count($ftoTasks->where('category', 6)))
                                <div class="card m-3">
                                    <div class="card-header"><h1 class="text-center">Patient Care</h1></div>
                                    <hr style="height:2px; border:none; color:slategrey; background-color:slategrey; width:60%; margin: 0 auto;">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Task</th>
                                                    <th>Goal</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ftoTasks->where('category', 6) as $task)
                                                    @include('fto.partials.fieldTrainingTableBody')
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if(count($ftoTasks->where('category', 7)))
                                <div class="card m-3">
                                    <div class="card-header"><h1 class="text-center">Medication Review</h1></div>
                                    <hr style="height:2px; border:none; color:slategrey; background-color:slategrey; width:60%; margin: 0 auto;">
                                    <div class="card-body">

                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                <tr>
                                                    <th>Task</th>
                                                    <th>Goal</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($ftoTasks->where('category', 7) as $task)
                                                    @include('fto.partials.fieldTrainingTableBody')
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if(count($competencies))
                                <div class="card m-3">
                                    <div class="card-header"><h1 class="text-center">Employee Competencies</h1></div>
                                    <hr style="height:2px; border:none; color:slategrey; background-color:slategrey; width:60%; margin: 0 auto;">
                                    <div class="card-body">

                                        <ul class="list-group">
                                            @foreach($competencies as $row)
                                                <a href="/competency/create/{{ $row->id }}">
                                                    <li class="list-group-item">{{ $row->competency->label }}</li>
                                                </a>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="accordian m-5" id="driverTasks">
                <div class="card">
                    <div class="card-header" id="driverTasksHeading">
                        <button class="btn btn-link" type="button" data-toggle="collapse"
                                data-target="#collapsedriverTasks" aria-expanded="true"
                                aria-controls="collapsedriverTasks">
                            Drivers Training Tasks
                        </button>
                        <div class="pull-right">
                            <a data-toggle="modal" data-target="#addDriverCheckModal" data-userid="{{ $employee->user_id }}" data-toggle="tooltip" data-placement="top" title="Add Driving Check List"> <i class="fad fa-plus-circle fa-2x text-success"></i> </a>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                 aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
                        </div>
                    </div>

                    <div id="collapsedriverTasks" class="collapse" aria-labeledby="driverTasksHeading"
                         data-parent="#driverTasks">
                        <div class="card-body">
                            <div class="accordion" id="accordionDriver">
                                @if($employee->DriverTrainingLogs)
                                @foreach($employee->DriverTrainingLogs as $row)
                                <div class="card">
                                <div class="card-header" id="headingOne">
                                  <h2 class="mb-0">
                                      <div class="row">
                                          <div class="col-xl-4">
                                              <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $row->id }}" aria-expanded="true" aria-controls="collapse{{ $row->id }}">
                                              {{ Carbon\Carbon::parse($row->ftoDate->date)->format('m-d-Y') }} -- @if($row->type == 1) Non-Emergency Daily @elseif($row->type == 2) Emergency Driving @endif
                                            </button>
                                          </div>
                                          <div class="col-xl-1">

                                          </div>
                                          <div class="col-xl-3">
                                              @if(!$row->miles_driven)
                                              <form action="/fto/updateDriverCheckMiles" method="post" class="form-inline">
                                                  @csrf
                                                    <input type="hidden" name="form_id" value="{{ $row->id }}">
                                                    <input class="form-control" name="miles_driven" value="" placeholder="Total Miles Driven">

                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </form>
                                                @else
                                                Total Miles: {{ $row->miles_driven }}
                                                @endif
                                          </div>
                                          <div class="col-xl-2 pull-right">
                                              <button class="btn btn-success">
                                                    Mark all Successfull
                                            </button>
                                          </div>
                                      </div>

                                  </h2>
                                </div>

                                <div id="collapse{{ $row->id }}" class="collapse" aria-labelledby="heading{{ $row->id }}" data-parent="#accordionDriver">
                                  <div class="card-body">
                                      @include('fto.partials.driverTask')
                                  </div>
                                </div>
                              </div>
                                @endforeach
                                @else
                                None
                                @endif


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection

@include('fto.partials.ftoDateModal')
@include('fto.partials.DriverCheckModal')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $('#ftoApprovalModal').on('show.bs.modal', function (e) {
            var userId = $(e.relatedTarget).data('userid');
            var skillId = $(e.relatedTarget).data('skillid');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            // AJAX request
            $.ajax({
                url: '/fto/approvalModal/' + userId,
                type: 'get',
                data: {},
                success: function (response) {
                    // Add response in Modal body
                    $('#ftoApprovalForm').html(response);

                    // Display Modal
                    $('#ftoApprovalModal').modal('show');
                }
            });

        });
    </script>

    <script>
        $('#addDriverCheckModal').on('show.bs.modal', function (e) {
            var userId = $(e.relatedTarget).data('userid');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            // AJAX request
            $.ajax({
                url: '/fto/addDriverCheck/' + userId,
                type: 'get',
                data: {},
                success: function (response) {
                    // Add response in Modal body
                    $('#driverCheckOffAdd').html(response);

                    // Display Modal
                    $('#addDriverCheckModal').modal('show');
                }
            });

        });
    </script>

    <script>
        $('#gradeDriverCheck').on('show.bs.modal', function (e) {
            var userId = $(e.relatedTarget).data('userid');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            // AJAX request
            $.ajax({
                url: '/fto/gradeDriverCheck/' + userId,
                type: 'get',
                data: {},
                success: function (response) {
                    // Add response in Modal body
                    $('#driverCheckOffAdd').html(response);

                    // Display Modal
                    $('#addDriverCheckModal').modal('show');
                }
            });

        });
    </script>

@endpush
