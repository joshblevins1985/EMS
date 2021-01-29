@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />
    <style>
        .hiddenRow {
            padding: 0 !important;
        }
    </style>
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Employee Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Field Training Officer Dashboard</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Field Training Officer Dashboard</h1>
    <!-- end page-header -->

    <div class="row">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link btn-primary" href="/report/driverstatus">Employee Status Report</a>
            </li>
        </ul>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <!-- start panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Available Employees for Field Training</h3>
                    <div class="pull-right"> Total: {{ count($employees->where('employee_status', 2)) }}</div>
                </div>
                <div class="panel-body pr-1">
                    <div class="table-responsive ">
                        <table class="table table-hover">
                            <thead>
                            <th ></th>
                            <th>Employee</th>
                            <th>Level</th>
                            <th>Station</th>
                            <th>Hire Date</th>
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach($employees->where('employee_status', 2) as $row)
                                <tr>
                                    <td><a class="btn btn-primary" data-toggle="collapse" href="#emp{{ $row->id }}" role="button" aria-expanded="false" aria-controls="emp{{ $row->id }}"><i class="far fa-caret-square-down"></i></a></td>
                                    <td> <a href="/fto/dashboard/{{$row->user_id}}"> {{ $row->last_name or '' }} {{ $row->first_name or '' }} </a> </td>
                                    <td>{{ $row->employeepositions->label or '' }}</td>
                                    <td>{{ $row->station->station or '' }}</td>
                                    <td>{{ Carbon\Carbon::parse($row->doh)->format('m-d-Y') }}</td>
                                    <td>
                                        <a  data-toggle="modal" data-target="#ftoDateModal" href="#" data-userid="{{ $row->user_id }}" data-toggle="tooltip" data-placement="top" title="Add Training Date">
                                            <i class="far fa-calendar-plus text-primary" ></i>
                                        </a>
                                        @if($row->driver == 0)
                                        <a
                                                id="fieldCompleteNonDriver"

                                                data-userid="{{ $row->user_id }}"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Complete Field Training">
                                            <i class="far fa-stretcher text-success fieldCompleteNonDriver" data-userid="{{ $row->user_id }}"></i>


                                        </a> @else
                                        <a
                                                id="fieldComplete"

                                                data-userid="{{ $row->user_id }}"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Complete Field Training">
                                            <i class="far fa-stretcher text-success fieldComplete" data-userid="{{ $row->user_id }}"></i>


                                        </a>
                                        @endif

                                    </td>

                                <tr>
                                    <td colspan="6" class="hiddenRow">
                                        <div class="collapse multi-collapse" id="emp{{ $row->id }}">
                                            <div class="card card-body">
                                                <table class="table" id="trainingDates{{$row->user_id}}">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Total Hours</th>
                                                        <th>FTO</th>
                                                        <th>Type</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($row->fieldtraining as $ft)
                                                        <tr>
                                                            <td>{{ Carbon\Carbon::parse($ft->date)->format('m-d-Y') }}</td>
                                                            <td>{{ $ft->total_hours }}</td>
                                                            <td>{{ $ft->fto->first_name or '' }} {{ $ft->fto->last_name or 'unknown'}}</td>
                                                            <td> @if($ft->type == 1) Field @elseif($ft->type == 2) Drivers @endif </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- end panel -->

            <!-- start panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Available Employees for Drivers Training</h3>
                    <div class="pull-right"> Total: {{count($employees->where('employee_status', 3))}} </div>
                </div>
                <div class="panel-body pr-1">
                    <div class="table-responsive ">
                        <table class="table table-hover" id="driversTable">
                            <thead>
                            <th ></th>
                            <th>Employee</th>
                            <th>Level</th>
                            <th>Station</th>
                            <th>Hire Date</th>
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach($employees->where('employee_status', 3) as $row)
                                <tr>
                                    <td><a class="btn btn-primary" data-toggle="collapse" href="#emp{{ $row->id }}" role="button" aria-expanded="false" aria-controls="emp{{ $row->id }}"><i class="far fa-caret-square-down"></i></a></td>
                                    <td><a href="/fto/dashboard/{{$row->user_id}}"> {{ $row->last_name or '' }} {{ $row->first_name or '' }} </a></td>
                                    <td>{{ $row->employeepositions->label or '' }}</td>
                                    <td>{{ $row->station->station or '' }}</td>
                                    <td>{{ Carbon\Carbon::parse($row->doh)->format('m-d-Y') }}</td>
                                    <td>
                                        <a  data-toggle="modal" data-target="#ftoDateModal" href="#" data-userid="{{ $row->user_id }}" data-toggle="tooltip" data-placement="top" title="Add Training Date">
                                            <i class="far fa-calendar-plus text-primary" ></i>
                                        </a>

                                        @if($row->driver == 0)

                                        @else
                                        <a
                                        data-userid="{{ $row->user_id }}"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Complete Drivers Training">
                                            <i class="fad fa-steering-wheel driverComplete text-success" data-userid="{{ $row->user_id }}" ></i>

                                        </a> @endif

                                    </td>

                                <tr>
                                    <td colspan="6" class="hiddenRow">
                                        <div class="collapse multi-collapse" id="emp{{ $row->id }}">
                                            <div class="card card-body">
                                                <table class="table" id="trainingDates{{$row->user_id}}">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Total Hours</th>
                                                        <th>FTO</th>
                                                        <th>Type</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($row->fieldtraining as $ft)
                                                        <tr>
                                                            <td>{{ Carbon\Carbon::parse($ft->date)->format('m-d-Y') }}</td>
                                                            <td>{{ $ft->total_hours }}</td>
                                                            <td>{{ $ft->fto->first_name or '' }} {{ $ft->fto->last_name or 'unknown'}}</td>
                                                            <td> @if($ft->type == 1) Field @elseif($ft->type == 2) Drivers @endif </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- end panel -->

            <!-- start panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Employees Increasing There Level of Care</h3>
                    <div class="pull-right"> Total: {{count($employees->where('employee_status', 5))}} </div>
                </div>
                <div class="panel-body pr-1">
                    <div class="table-responsive ">
                        <table class="table table-hover" id="driversTable">
                            <thead>
                            <th ></th>
                            <th>Employee</th>
                            <th>Level</th>
                            <th>Station</th>
                            <th>Hire Date</th>
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach($employees->where('employee_status', 5) as $row)
                                <tr>
                                    <td><a class="btn btn-primary" data-toggle="collapse" href="#emp{{ $row->id }}" role="button" aria-expanded="false" aria-controls="emp{{ $row->id }}"><i class="far fa-caret-square-down"></i></a></td>
                                    <td><a href="/fto/dashboard/{{$row->user_id}}"> {{ $row->last_name or '' }} {{ $row->first_name or '' }} </a></td>
                                    <td>{{ $row->employeepositions->label or '' }}</td>
                                    <td>{{ $row->station->station or '' }}</td>
                                    <td>{{ Carbon\Carbon::parse($row->doh)->format('m-d-Y') }}</td>
                                    <td>
                                        <a  data-toggle="modal" data-target="#ftoDateModal" href="#" data-userid="{{ $row->user_id }}" data-toggle="tooltip" data-placement="top" title="Add Training Date">
                                            <i class="far fa-calendar-plus text-primary" ></i>
                                        </a>

                                        <a
                                                id="increaseComplete"

                                                data-userid="{{ $row->user_id }}"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Complete Field Training">
                                            <i class="fal fa-clipboard-list-check text-success Complete" data-userid="{{ $row->user_id }}"></i>


                                        </a>


                                    </td>

                                <tr>
                                    <td colspan="6" class="hiddenRow">
                                        <div class="collapse multi-collapse" id="emp{{ $row->id }}">
                                            <div class="card card-body">
                                                <table class="table" id="trainingDates{{$row->user_id}}">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Total Hours</th>
                                                        <th>FTO</th>
                                                        <th>Type</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($row->fieldtraining as $ft)
                                                        <tr>
                                                            <td>{{ Carbon\Carbon::parse($ft->date)->format('m-d-Y') }}</td>
                                                            <td>{{ $ft->total_hours }}</td>
                                                            <td>{{ $ft->fto->first_name or '' }} {{ $ft->fto->last_name or 'unknown'}}</td>
                                                            <td> @if($ft->type == 1) Field @elseif($ft->type == 2) Drivers @endif </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- end panel -->

            <!-- start panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h3 class="panel-title">Available Employees for Back to Driving Program</h3>
                    <div class="pull-right"> Total: {{count($employees->where('employee_status', 4))}} </div>
                </div>
                <div class="panel-body pr-1">
                    <div class="table-responsive ">
                        <table class="table table-hover">
                            <thead>
                            <th ></th>
                            <th>Employee</th>
                            <th>Level</th>
                            <th>Station</th>
                            <th>Hire Date</th>
                            <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach($employees->where('employee_status', 4) as $row)
                                <tr>
                                    <td><a class="btn btn-primary" data-toggle="collapse" href="#emp{{ $row->id }}" role="button" aria-expanded="false" aria-controls="emp{{ $row->id }}"><i class="far fa-caret-square-down"></i></a></td>
                                    <td><a href="/fto/dashboard/{{$row->user_id}}"> {{ $row->last_name or '' }} {{ $row->first_name or '' }} </a></td>
                                    <td>{{ $row->employeepositions->label or '' }}</td>
                                    <td>{{ $row->station->station or '' }}</td>
                                    <td>{{ Carbon\Carbon::parse($row->doh)->format('m-d-Y') }}</td>
                                    <td>
                                        <a  data-toggle="modal" data-target="#ftoDateModal" href="#" data-userid="{{ $row->user_id }}" data-toggle="tooltip" data-placement="top" title="Add Training Date">
                                            <i class="far fa-calendar-plus text-primary" ></i>
                                        </a>

                                        @if($row->driver == 0)
                                        @else
                                        <a
                                        data-userid="{{ $row->user_id }}"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Complete Drivers Training">
                                            <i class="fad fa-steering-wheel text-success"></i>
                                        </a>
                                        @endif

                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="6" class="hiddenRow">
                                        <div class="collapse multi-collapse" id="emp{{ $row->id }}">
                                            <div class="card card-body">
                                                <table class="table" id="trainingDates{{$row->user_id}}">
                                                    <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Total Hours</th>
                                                        <th>FTO</th>
                                                        <th>Type</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($row->fieldtraining as $ft)
                                                        <tr>
                                                            <td>{{ Carbon\Carbon::parse($ft->date)->format('m-d-Y') }}</td>
                                                            <td>{{ $ft->total_hours }}</td>
                                                            <td>{{ $ft->fto->first_name or '' }} {{ $ft->fto->last_name or 'unknown'}}</td>
                                                            <td> @if($ft->type == 1) Field @elseif($ft->type == 2) Drivers @endif </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!-- end panel -->
        </div>
        <div class="col-xl-6">
            <!-- start panel -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Employees I have trained</h3>

                </div>
                <div class="panel-body pr-1">
                    <div class="table-responsive ">
                        <table class="table" >
                            <thead>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>PMT Status</th>
                            </thead>
                            <tbody>
                            @foreach(Auth::user()->Employee->ftopaydates as $row)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($row->date)->format('m-d-Y') }}</td>
                                    <td>{{ $row->fto->first_name }} {{ $row->fto->last_name }}</td>
                                    <td>@if($row->payroll == 1) Paid @else Pending @endif</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
            <!-- end panel -->
        </div>
    </div>



@endsection

@include('fto.partials.ftoDateModal')

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script>
        $('#ftoDateModal').on('show.bs.modal', function(e) {
            var userId = $(e.relatedTarget).data('userid');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            // AJAX request
            $.ajax({
                url: '/fto/modal/' + userId,
                type: 'get',
                data: {},
                success: function(response){
                    // Add response in Modal body
                    $('#ftoForm').html(response);

                    // Display Modal
                    $('#ftoDateModal').modal('show');
                }
            });

        });
    </script>

    <script>
        var handleDatepicker = function() {
            $('#datepicker-default').datepicker({
                todayHighlight: true
            });

        };

        var FormPlugins = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDatepicker();
                }
            };
        }();

        $(document).ready(function() {
            FormPlugins.init();
        });
    </script>

    <script>
        $('.fieldCompleteNonDriver').on('click', function () {
            var $el = $(this);

            console.log($el.data('userid'));

            var userId = $el.data('userid');

            console.log(userId);
            Swal.fire({
                    title: 'Are you sure?',
                    text: 'This employee is a non driver, by continuing you are clearing the employee for full duty. Emails will be sent to scheduling, administration, education, compliance, and human resources.' ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-success',
                    confirmButtonText: 'Yes Complete The Employee'

                }
            ).then(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                // AJAX request
                $.ajax({
                    url: '/fto/ndComplete/' + userId,
                    type: 'post',
                    data: {},
                    success: function(response){
                        // Add response in Modal body
                        swal("Completed!", "The employee has been cleared.", "success");

                    }
                });
            })
        });


    </script>

<script>
        $('.fieldComplete').on('click', function () {
            var $el = $(this);

            console.log($(this).data('userid'));

            var userId = $(this).data('userid');
            var tr = $(this).closest("tr");
            var newtr = tr.clone();

            tr.remove();

            console.log(tr);
            $('#driversTable > tbody:last-child').append(newtr);

            Swal.fire({
                    title: 'Are you sure?',
                    text: 'This employee is set to be a driver, by continuing you are clearing the employee to start drivers training. Emails will be sent to scheduling, administration, education, compliance, and human resources.' ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-success',
                    confirmButtonText: 'Yes Complete The Employee'

                }
            ).then(function() {



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                // AJAX request
                $.ajax({
                    url: '/fto/fieldComplete/' + userId,
                    type: 'post',
                    data: {},
                    success: function(response){
                        // Add response in Modal body
                        swal.fire("Completed!", "The employee has been cleared for drivers training.", "success");



                    }
                });
            })
        });


    </script>

<script>
        $('.driverComplete').on('click', function () {
            var $el = $(this);

            console.log($(this).data('userid'));

            var userId = $(this).data('userid');
            var tr = $(this).closest("tr");
            var newtr = tr.clone();

            tr.remove();




            Swal.fire({
                    title: 'Are you sure?',
                    text: 'This employee is set to be a driver, by continuing you are clearing the employee to run independently on their own. Emails will be sent to scheduling, administration, education, compliance, and human resources.' ,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn-success',
                    confirmButtonText: 'Yes Complete The Employee'

                }
            ).then(function() {



                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                // AJAX request
                $.ajax({
                    url: '/fto/driverComplete/' + userId,
                    type: 'post',
                    data: {},
                    success: function(response){
                        // Add response in Modal body
                        swal.fire("Completed!", "The employee has been cleared for drivers training.", "success");



                    }
                });
            })
        });


    </script>

@endpush
