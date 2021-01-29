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

 {!! Form::open(['url' => route('timepunches.update', $punch->id), 'method' => 'POST']) !!}

           @method('PUT')
    @csrf

            <select class="mdb-select" id="user_id" name="user_id" >
        <option value="" disabled selected>Choose Employee</option>
        @foreach($employees as $id => $employee_name)
        <option value="{{$id}}" >{{$employee_name}}</option>
        @endforeach
    </select>
            <label for="time_in">Time In</label>
            <input type="datetime-local" id="time_in" name="time_in" value="{{$punch->time_in}}">
            
            <label for="time_out">Time Out</label>
            <input type="datetime-local" id="time_out" name="time_out" value="{{$punch->time_out}}">
            
            
            {{ Form::hidden('schedule_id', 0) }}
                
            

            <button type="submit" class="btn btn-success btn-rounded btn-block">Clock In</button>

            {!! Form::close() !!}
@stop

@section('styles')

@stop

@section('scripts')

<script>
    $('.timepicker').pickatime({
    // 12 or 24 hour
    twelvehour: false
});
</script>
<script>
// Data Picker Initialization
    $('.datepicker').pickadate();
</script>
@stop