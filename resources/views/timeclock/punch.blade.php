@extends('layouts.clock')


@section('page-title', 'Time Punch')


@section('content')
@include('partials.messages')

@if(!$employee)
<div class="row-fluid">
    <h1>Unable to find employee please try again.</h1>
</div>
@else
<div class="row">

    <div class="col-sm-8">
        <!-- Card -->
        <div class="card text-white bg-primary">

            <!-- Card content -->
            <div class="card-body">
                <?php $schedule_id=""; ?>
                <div class="col-sm-12">
                    <h3>Todays Date is {{Carbon\carbon::now()->format('l jS \\of F Y H:i:s ')}} your
                        schedule is.</h3>

                    @if(!$daysched)
                    <h4>You are not scheduled for a shift today.</h4>
                    @else

                    <?php
                    $start = date_create($daysched->sin);
                    $start = date_format($start, 'M d, Y H:i');
                    $end = date_create($daysched->sout);
                    $end = date_format($end, 'M d, Y H:i');

                    ?>
                    <h4>You start your shift on {{$start}} and end on {{$end}} </h4>
                    @endif
                </div>

            </div>

        </div>
    </div>

    <div class="col-sm-4">
        <!-- Card -->
        <div class="card text-white bg-dark">

            <!-- Card content -->
            <div class="card-body">

                <div class="col-sm-12">
                    <h1>{{date('H:i')}}</h1>
                </div>
                
<div class="col-sm-12"><a href="/timeclock"><button class="btn btn-danger btn-rounded btn-block my-4 waves-effect z-depth-0"
                           >
                       Go Back to main screen
                    </button></a></div>
            </div>

        </div>
    </div>

</div>
<div class="row">

    <div class="col-sm-3">
        <div class="row-fluid">
            <!-- Card -->
            <div class="card">

                <!-- Card content -->
                <div class="card-body">
                    <img class="card-img-top" src="/storage/app/employee_photos/{{$employee->eid}}.png" alt="Contact HR to send in photo" style="width:100%;height:400px;">
                    

                </div>

            </div>
            <!-- Card -->
        </div>
        <div class="row-fluid">

            <!-- Card -->
            <div class="card text-white bg-dark">


                <!-- Card content -->
                <div class="card-body">

                    <h2 class="text-center">
                        {{$employee->first_name.' ' .$employee->middle_name.' '. $employee->last_name}}
                    </h2>


                    <div class="row text-center">
                        <div class="col-6"><h3>{{$employee->station->station or ''}}</h3></div>
                        <div class="col-6"><h3>{{$employee->employeepositions->label or ''}}</h3></div>
                    </div>
                    <div class="row text-center">
                        <div class="col-6">Mobile Number</div>
                        <div class="col-6"> {{$employee->phone_mobile}}</div>
                    </div>
                    <div class="row text-center">
                        <div class="col-6">Work Email</div>
                        <div class="col-6"> {{$employee->email}}</div>
                    </div>

                </div>

            </div>
            <!-- Card -->


        </div>


    </div>
    <div class="col-sm-6 align-self-center">


        <div class="row-fluid">
            <!-- Card -->
            <div class="card text-white bg-dark">

                <!-- Card content -->
                <div class="card-body">

                    <div class="col-sm-12 ">

                        <h2>Current Pay Period</h2>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <h3>Start Date</h3>
                        </div>

                        <div class="col-sm-3">
                           <h3>{{$payperiod->start}}</h3> 
                        </div>
                        <div class="col-sm-3">
                            <h3>Last Date</h3>
                        </div>

                        <div class="col-sm-3">
                           <h3>{{$payperiod->end}}</h3> 
                        </div>
                    </div>
                    <?php
                    $wk1tot = 0;
                    $wk2tot = 0;

                    $wk1st = 0;
                    $wk2st = 0;
                    $wk1ot = 0;
                    $wk2ot = 0;
                    $ppst = 0;
                    $ppot = 0;
                    ?>
                    @if(count($punches))
                    <?php

                    $ppstart = $payperiod->start;
                    $wk1end = strtotime($ppstart . '+ 6 days');

                    $ppend = $payperiod->end;
                    $wk2start = strtotime($ppend . '- 6 days');

                    $ppstart = strtotime($ppstart);
                    $ppend = strtotime($ppend);


                    ?>
                    @foreach($punches as $add)
                    <?php
                    if ($add->time_out === NULL){

                    }else {
                        $time_in = strtotime($add->time_in);
                        $time_out = strtotime($add->time_out);
                        if ($time_in >= $ppstart && $time_in <= $wk1end) {

                            $shifthours = $time_out - $time_in;

                            $wk1tot = $wk1tot + $shifthours / (60 * 60);

                            if ($wk1tot > 40) {
                                $wk1st = 40;
                                $wk1ot = $wk1tot - 40;
                            } elseif ($wk1tot <= 0) {
                                $wk1ot = 0;
                                $wk1st = $wk1tot;
                            } else {
                                $wk1ot = 0;
                                $wk1st = $wk1tot;
                            }

                        } elseif ($time_in >= $wk2start && $time_in <= $ppend) {

                            if ($add->time_out === NULL) {
                                $shifthours = 0;
                            } else {
                                $shifthours = $time_out - $time_in;

                                $wk2tot = $wk2tot + $shifthours / (60 * 60);


                                if ($wk2tot > 40) {
                                    $wk2st = 40;
                                    $wk2ot = $wk2tot - 40;
                                } elseif ($wk2tot <= 0) {
                                    $wk2ot = 0;
                                    $wk2st = $wk1tot;
                                } else {
                                    $wk2ot = 0;
                                    $wk2st = $wk2tot;
                                }
                            }

                        }
                    }


                    ?>
                    @endforeach

                    <?php
                    $ppst = $wk1st + $wk2st;
                    $ppot = $wk1ot + $wk2ot;
                    ?>
                    @endif


                    <div class="row">
                        <div class="col-sm-2">
                            <h5>Straight Wk 1</h5>
                        </div>

                        <div class="col-sm-4">
                            {{number_format((float)$wk1st,2,'.','')}}
                        </div>
                        <div class="col-sm-2">
                            <h5>Over Time Wk 1</h5>
                        </div>

                        <div class="col-sm-4">
                            {{number_format((float)$wk1ot,2,'.','')}}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <h5>Straight Wk 2</h5>
                        </div>

                        <div class="col-sm-4">
                            {{number_format((float)$wk2st,2,'.','')}}
                        </div>
                        <div class="col-sm-2">
                            <h5>Over Time Wk 2</h5>
                        </div>

                        <div class="col-sm-4">
                            {{number_format((float)$wk2ot,2,'.','')}}
                        </div>

                    </div>
                    
                    <div class="row">
                        <div class="col-sm-2">
                            <h5>Straight Time</h5>
                        </div>

                        <div class="col-sm-4">
                            <h3>{{number_format((float)$ppst,2,'.','')}}</h3>
                        </div>
                        <div class="col-sm-2">
                            <h5>Over Time</h5>
                        </div>

                        <div class="col-sm-4">
                           <h3>{{number_format((float)$ppot,2,'.','')}}</h3> 
                        </div>

                    </div>

                </div>
                <!-- Card -->

            </div>
        </div>
        @if(!$lpunch)
        <div class="row-fluid">
            {!! Form::open(['route' => 'timeclock.store', 'id' => 'badrunsheets-form']) !!}

            @csrf

            {{ Form::hidden('employee_id', $employee->user_id) }}
            {{ Form::hidden('time_in', date('Y-m-d H:i:s')) }}
            {{ Form::hidden('how_in', 'TC') }}
            
            @if(!$daysched)
                    {{ Form::hidden('schedule_id', 0) }}
                    @else

                    {{ Form::hidden('schedule_id', $daysched->id) }}
                    @endif
            

            <button type="submit" class="btn btn-success btn-rounded btn-block">Clock In</button>

            {!! Form::close() !!}

        </div>
        @else
        @if($lpunch->time_out === NULL)

        @else
        <div class="row-fluid">
            {!! Form::open(['route' => 'timeclock.store', 'id' => 'timeclock-form']) !!}

            @csrf

            {{ Form::hidden('employee_id', $employee->user_id) }}
            {{ Form::hidden('time_in', date('Y-m-d H:i:s')) }}
            {{ Form::hidden('how_in', 'TC') }}
            @if(!$daysched)
                    {{ Form::hidden('schedule_id', 0) }}
                    @else

                    {{ Form::hidden('schedule_id', '$daysched->id') }}
                    @endif

            <button type="submit" class="btn btn-success btn-rounded btn-block">Clock In</button>

            {!! Form::close() !!}

        </div>
        @endif
        @endif

        <div class="row-fluid">

            <!-- Card -->
            <div class="card">

                <!-- Card content -->
                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                        <tr>

                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Total Time</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($punches))
                        @foreach($punches as $row)
                        <?php
                        if ($row->how_in !== 'TC') {
                            $rowcolor = 'table-dark';
                        } elseif ($row->how_out == 'E' or $row->how_out == 'M') {
                            $rowcolor = 'table-dark';
                        }
                        ?>
                        <tr class="">
                            <?php $start = date_create($row->time_in);
                            $end = date_create($row->time_out)
                            ?>

                            <td>{{date_format($start, "m-d-Y H:i")}}</td>

                            @if($row->time_out === NULL)
                            <td>
                                {!! Form::open(['url' => route('timeclock.update', $row->id), 'method' => 'POST']) !!}
                                @method('PUT')
                                @csrf
                                {{ Form::hidden('employee_id', $employee->user_id) }}
                                {{ Form::hidden('time_out', date('Y-m-d H:i:s')) }}
                                {{ Form::hidden('how_out', 'TC') }}


                                <button type="submit"
                                        class="btn btn-outline-dark btn-rounded waves-effect">
                                    Clock Out
                                </button>

                                {!! Form::close() !!}
                            </td>
                            @else
                            <td>{{date_format($end, "m-d-Y H:i")}}</td>
                            @endif

                            @if($row->time_out === NULL)
                            <td>Calculation Pending</td>
                            @else
                            <?php
                            $interval = $start->diff($end);


                            ?>
                            <td>{{$interval->format('%h Hours %i minutes')}}</td>
                            @endif

                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="3">No Punches Found</td>
                        </tr>
                        @endif


                        </tbody>
                    </table>

                </div>

            </div>
            <!-- Card -->

        </div>

    </div>

    <div class="col-sm-3">

        <div class="row-fluid">
            <div class="card">

                <!-- Card image -->
                <img class="card-img-top" src="{{ url('public/assets/img/ems.jpg') }}"
                     alt="{{ settings('app_name') }}">

                <!-- Card content -->
                <div class="card-body">

                    <div class="list-group">
                        <a href="#" class="list-group-item active waves-effect">
                            Notifications for {{$employee->first_name}}
                        </a>
                        <a href="#" class="list-group-item list-group-item-action waves-effect">Road Closure
                            State Route
                            784 3800 Block.</a>
                        <a href="#" class="list-group-item list-group-item-action waves-effect">Mandatory
                            Training for
                            all employees assigned.</a>

                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
@endif

@stop


@section('scripts')


@stop