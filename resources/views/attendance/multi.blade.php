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


    <div class="row">
        
        <div class="col-lg-12">
            <form class="form-inline" action="{{ route('attendance.store') }}" method="POST" >
                {{csrf_field()}}

                <div class="md-form">
                    <input placeholder="Date of Incident" type="text" id="date" name="date" data-value="{{date('Y-m-d',strtotime($work_date))}}" class="form-control datepicker">
                    <label for="date">Date of Incident</label>
                </div>
                
                <select class="mdb-select md-form" id="combobox" name="user_id" searchable="Search here.." >
                    <option value="" disabled selected>Choose Employee</option>
                    @foreach($employees as $id => $employee_name)
                        <option value="{{$id}}" >{{$employee_name}}</option>
                    @endforeach
                </select>


                <select class="mdb-select md-form" id="combobox" name="occurance_type">
                    <option value="" disabled selected>Select Occurance Type</option>
                    @foreach($occurances as $id => $occurance)
                        <option value="{{$id}}">{{$occurance}}</option>
                    @endforeach
                </select>
                
                <div class="md-form">
                            <input type="text" id="note" name="note" value="{{$attendance->note or ''}}" class="form-control">
                            <label for="note" >Note</label>
                        </div>

                <button type="submit" class="btn btn-primary">Add New Attendance Violation</button>
            </form>
        </div>
    </div>

    <div class="row">
        <table class="table table">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Occurance Type</th>
                <th>Notes</th>
            </tr>
            </thead>
            <tbody>
                @foreach($attendance as $row)
            <tr>
                <td>{{$row->employee->last_name}} {{$row->employee->first_name}}</td>
                <td>{{$row->type->label}}</td>
                <td></td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Vial of Medication</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form  action="{{ route('attendance.store') }}" method="POST" >
                        {{csrf_field()}}

                        <div class="md-form">
                            <input placeholder="Date of Incident" type="text" id="date" name="date" class="form-control datepicker">
                            <label for="date">Date of Incident</label>
                        </div>


                        <select class="browser-default custom-select" id="combobox" name="user_id" searchable="Search here.." >
                            <option value="" disabled selected>Choose Employee</option>
                            @foreach($employees as $id => $employee_name)
                                <option value="{{$id}}" >{{$employee_name}}</option>
                            @endforeach
                        </select>


                        <select class="browser-default custom-select" id="combobox" name="occurance_type">
                            <option value="" disabled selected>Select Occurance Type</option>
                            @foreach($occurances as $id => $occurance)
                                <option value="{{$id}}">{{$occurance}}</option>
                            @endforeach
                        </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="submit" class="btn btn-primary">Add New Attendance Violation</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

@stop

@section('styles')
    <style>
        .btn-link {
            border: none;
            outline: none;
            background: none;
            cursor: pointer;
            color: #0000EE;
            padding: 0;
            text-decoration: underline;
            font-family: inherit;
            font-size: inherit;
        }
    </style>

@stop

@section('scripts')

    <script>
        // Data Picker Initialization
        $('.datepicker').pickadate();
    </script>



@stop