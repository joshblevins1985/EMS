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
    <div class="card text-center">
        <div class="card-header primary-color white-text">
            <h2>Employees Attendance / Point Records </h2>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-8">
                    <!-- Material input -->
                    <form class="form-inline" role="search" method="GET" action="{{url('attend/list')}}">
                        @csrf
                        <div class="md-form mb-6 mr-sm-4">
                            <select class="mdb-select" id="name" name="name" searchable="Search here.." >
                                <option value="" disabled selected>Choose Employee</option>
                                @foreach($employees as $id => $employee_name)
                                    <option value="{{$id}}" >{{$employee_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md-form mb-4 mr-sm-2">
                            <input placeholder="Select date" type="text" id="date" name="date" class="form-control datepicker">
                            <label for="date">Search by Date</label>
                        </div>

                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                    </form>

                </div>

                <div class="col-1">

                    @permission('addattendance')
                    
                    <a class="btn btn-purple" href="/attendance/create">Add Single Entry</a>
                    
                    <a class="btn btn-deep-purple" data-toggle="modal" data-target="#basicExampleModal">Add Multiple Entries</a>
                    @endpermission
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Date</th>
                <th>Employee</th>
                <th>Occurance Type</th>
                <th>Status</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($attendance as $row)
                <tr>
                    <td>{{date('m-d-Y', strtotime($row->date))}}</td>
                    <td>{{$row->employee->first_name}} {{$row->employee->last_name}}</td>
                    <td>
                        @if(!$row->type)
                            Unknown
                        @else
                            {{$row->type->label}}
                        @endif
                    </td>
                    <td>
                        @if($row->status > 0)
                            Removed
                        @elseif($row->status == 0)
                            Added
                        @else
                            Unknown
                        @endif
                    </td>
                    <td>{{$row->note}}</td>
                    <td>
                        @permission('view.attend')
                        <div class="dropdown show d-inline-block">
                            <a class="btn btn-icon"
                               href="#" role="button" id="dropdownMenuLink"
                               data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                                <a href="#" class="dropdown-item text-gray-500">
                                    <i class="fas fa-eye mr-2"></i>
                                    View Attendance Record
                                </a>
                            </div>
                        </div>
                        @endpermission

                        @permission('edit.attend')
                        <a href="{{ route('attendance.edit', $row->id) }}"
                           class="btn btn-icon edit"
                           title="Edit Incident"
                           data-toggle="tooltip" data-placement="top">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endpermission

                        @permission('delete.attend')
                            <a href="{{$row->id}}/delete"
                               class="btn btn-icon bg-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        @endpermission
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $attendance->appends(request()->input())->links() }}

    </div>


    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Selecting Date for Entries</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="heigh: 400px;">
                    <form class="form-inline" role="search" method="GET" action="{{url('attend/multi')}}">
                    
                        {{csrf_field()}}

                        <div class="md-form">
                            <input placeholder="Date of Incident" type="text" id="date" name="date" class="form-control datepicker">
                            <label for="date">Date of Incident</label>
                        </div>

                        

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

@stop

@section('scripts')


@stop