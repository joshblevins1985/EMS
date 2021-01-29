@extends('layouts.app')


@section('page-title', 'Accounting Dashborad')


@section('content')
    <div class="row">
        <div class="col-sm-10">
            <div class="row-fluid">
                <!-- Card -->
                <div class="card" style="min-height: 450px;">

                    <!-- Card content -->
                    <div class="card-body">

                        <!-- Title -->
                        <h4 class="card-title"><a>Yesterdays Missed Time Punches</a></h4>

                        <table class="table table-hover">
                            <thead>
                            <th>Employee</th>
                            <th>Scheduled Shift</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @if(count($noclock))
                                @foreach($noclock as $row)
                                    @include('accounting.partials.attendance_row')
                                @endforeach
                            @else
                                <tr>
                                    <td colspan=5><h2>No Missed Time Punches Found</h2></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        
                        

                    </div>

                </div>
                <!-- Card -->
            </div>
            <div class="row-fluid">
                <!-- Card -->
                <div class="card" style="min-height: 450px;">

                    <!-- Card content -->
                    <div class="card-body">

                        <!-- Title -->
                        <h4 class="card-title"><a>Pay Periods</a></h4>
                        
                        
                        <table class="table table-hover">
                            <thead>
                            <th>Start</th>
                            <th>End</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @if(count($pay_period))
                                @foreach($pay_period as $row)
                                    @include('accounting.partials.pay_period_row')
                                @endforeach
                            @else
                                <tr>
                                    <td colspan=5><h2>No Missed Time Punches Found</h2></td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>

                </div>
                <!-- Card -->
            </div>
        </div>

        <div class="col-sm-2">
            <!-- Grid column -->


            <!--Panel-->
            <div class="card text-center"
            ">
            <div class="card-header success-color white-text">
                Reports
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <a data-toggle="modal" data-target="#searchModal">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Create Payroll Report

                        </li>
                    </a>
                    <li class="list-group-item">Deduction Report</li>


                </ul>
            </div>
            <div class="card-footer text-muted success-color white-text">
                <p class="mb-0">2 days ago</p>
            </div>
        </div>
        <!--/.Panel-->


    </div>


    <!-- Side Modal Top Right -->

    <!-- To change the direction of the modal animation change .right class -->
    <div class="modal fade right" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
        <div class="modal-dialog" role="document">


            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100" id="searchLabel">Create Payroll Report</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    {!! Form::open(['route' => 'employees.store', 'id' => 'employees-form']) !!}
                    @csrf


                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="startdate" name="startdate"
                               class="form-control datepicker">
                        <label for="startdate">Search by Date</label>
                    </div>

                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="enddate" name="enddate"
                               class="form-control datepicker">
                        <label for="enddate">Search by Date</label>
                    </div>

                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i> <span>Search</span>
                    </button>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
@stop


@section('styles')

@stop

@section('scripts')


@stop
