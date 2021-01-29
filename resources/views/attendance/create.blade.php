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

   
                    <form  action="{{ route('attendance.store') }}" method="POST" >
                        {{csrf_field()}}

                        <div class="md-form">
                            <input placeholder="Date of Incident" type="text" id="date" name="date" class="form-control datepicker">
                            <label for="date">Date of Incident</label>
                        </div>

                        
                            <select class="mdb-select" id="user_id" name="user_id" searchable="Search here.." >
                                <option value="" disabled selected>Choose Employee</option>
                                @foreach($employees as $id => $employee_name)
                                    <option value="{{$id}}" >{{$employee_name}}</option>
                                @endforeach
                            </select>


                        <select class="mdb-select md-form" name="occurance_type">
                            <option value="" disabled selected>Select Occurance Type</option>
                            @foreach($occurances as $id => $occurance)
                                <option value="{{$id}}">{{$occurance}}</option>
                            @endforeach
                        </select>
                        
                        <div class="md-form">
                            <input type="text" id="note" name="note" value="{{$attendance->note or ''}}" class="form-control">
                            <label for="note" >Note</label>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Add New Attendance Violation</button>

                    </form>
   


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