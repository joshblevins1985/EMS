@extends('layouts.app')

@section('page-title', trans('Attendance'))
@section('page-heading', trans('Attendance'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Attendance')
    </li>
@stop

@section('content')

    @include('partials.toastr')

                    {!! Form::open(['url' => route('attendance.update', $attendance->id), 'method' => 'POST']) !!}
                  
                    
                        {{csrf_field()}}
                        
                        @method('PUT')
                        
                        <div class="md-form">
                            <input placeholder="Date of Incident" type="text" data-value="{{date('Y-m-d',strtotime($attendance->date))}}" id="date" name="date" class="form-control datepicker">
                            <label for="date">Date of Incident</label>
                        </div>

                        
                            <select class="mdb-select" id="user_id" name="user_id" searchable="Search here.." >
                                <option value="" disabled selected>Choose Employee</option>
                                @foreach($employees as $id => $employee_name)
                                    <option value="{{$id}}" @if($attendance->user_id == $id) selected @endif >{{$employee_name}}</option>
                                @endforeach
                            </select>


                        <select class="mdb-select md-form" name="occurance_type">
                            <option value="" disabled selected>Select Occurance Type</option>
                            @foreach($occurances as $id => $occurance)
                                <option value="{{$id}}" @if($attendance->occurance_type == $id) selected @endif >{{$occurance}}</option>
                            @endforeach
                        </select>
                        
                        <div class="md-form">
                            <input type="text" id="note" name="note" value="{{$attendance->note}}" class="form-control">
                            <label for="note" >Note</label>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Update Attendance Violation</button>

                    {!! Form::close() !!}
   


@stop

@section('styles')
    <style>
        .btn-link{
            border:none;
            outline:none;
            background:none;
            cursor:pointer;
            color:#0000EE;
            padding:0;
            text-decoration:underline;
            font-family:inherit;
            font-size:inherit;
        }
    </style>
@stop

@section('scripts')

    <script>
        // Data Picker Initialization
        $('.datepicker').pickadate();
    </script>
@stop