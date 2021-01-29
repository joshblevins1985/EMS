@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')
<div class="row">
    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#basicExampleModal3">Add New Observer</button>

    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#basicExampleModal">Add new observe date</button>

</div>

<div class="row-fluid">
    <div class="col-md-12 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Field Observers</div>

            <div class="panel-body">
                {!! $calendar->calendar() !!}
            </div>
        </div>
    </div>
</div>

<!--Modal for Changing Seal-->

<!-- Modal -->
<div class="modal fade" id="basicExampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Add New Observer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('observer.store'), 'method' => 'POST']) !!}
                @csrf

                <div class="md-form">
                    <input type="text" id="first_name" name="first_name" class="form-control" value="">
                    <label for="first_name">First Name</label>
                </div>

                <div class="md-form">
                    <input type="text" id="last_name" name="last_name" class="form-control" value="">
                    <label for="last_name">Last Name</label>
                </div>

                <div class="md-form">
                    <input type="text" id="address" name="address" class="form-control" value="">
                    <label for="address">Address</label>
                </div>
                <div class="md-form">
                    <input type="text" id="city" name="city" class="form-control" value="">
                    <label for="city">City</label>
                </div>
                <div class="md-form">
                    <input type="text" id="state" name="state" class="form-control" value="">
                    <label for="state">State</label>
                </div>
                <div class="md-form">
                    <input type="text" id="zip" name="zip" class="form-control" value="">
                    <label for="zip">Zip Code</label>
                </div>
                <div class="md-form">
                    <input placeholder="Selected date" type="text" id="dob" name="dob" class="form-control datepicker">
                    <label for="dob">DOB</label>
                </div>
                <div class="md-form">
                    <input type="text" id="phone" name="phone" class="form-control" value="">
                    <label for="phone">Phone Number</label>
                </div>
                <div class="md-form">
                    <input type="text" id="transport" name="transport" class="form-control" value="">
                    <label for="transport">Preference of Hospital</label>
                </div>
                <div class="md-form">
                    <input type="text" id="ec" name="ec" class="form-control" value="">
                    <label for="ec">Emergency Contact</label>
                </div>
                <select class="mdb-select md-form" id="type" name="type">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">EMT Student</option>
                    <option value="2">AEMT Student</option>
                    <option value="3">Paramedic Student</option>
                    <option value="4">Medical Student</option>
                    <option value="5">Job Shadow</option>
                    <option value="6">Media</option>
                </select>


                <button class="btn btn-info btn-block my-4" type="submit">Add New Observer</button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

<!--Modal for Changing Seal-->

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Observer Date</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('observerdates.store'), 'method' => 'POST']) !!}
                @csrf

                <select class="mdb-select md-form" id="observer" name="observer">
                    <option value="" disabled selected>Choose the observer</option>
                    @foreach($observers as $row)
                    <option value="{{$row->id}}">{{$row->last_name}}  {{$row->first_name}}</option>
                    @endforeach
                </select>
                
                <div class="md-form">
                    <input placeholder="Selected date" type="text" id="date" name="date" class="form-control datepicker">
                    <label for="date">Date</label>
                </div>

                <div class="md-form">
                    <input placeholder="Selected time" type="text" id="starttime" name="starttime" class="form-control timepicker">
                    <label for="starttime">Start Time</label>
                </div>

                <div class="md-form">
                    <input placeholder="Selected time" type="text" id="endtime" name="endtime" class="form-control timepicker">
                    <label for="starttime">End Time</label>
                </div>
                
                <select class="mdb-select md-form" id="preceptor" name="preceptor" searchable="Search here.." >
                    <option value="" disabled selected>Choose Employee</option>
                    @foreach($employees as $id => $employee_name)
                    <option value="{{$id}}" >{{$employee_name}}</option>
                    @endforeach
                </select>

                <button class="btn btn-info btn-block my-4" type="submit">Add New Date</button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
@stop

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
{!! $calendar->script() !!}
<script>
    $('#starttime').pickatime({
        // 12 or 24 hour
        twelvehour: false,
    });

    $('#endtime').pickatime({
        // 12 or 24 hour
        twelvehour: false,
    });
</script>
@stop
