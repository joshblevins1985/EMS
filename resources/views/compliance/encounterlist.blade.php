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
<!--Panel-->
<div class="card text-center">
    <div class="card-header elegant-color white-text">
        <h2>Employee Encounter List</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-11">
                <form class="form-inline" role="search" method="GET" action="#">
                    @csrf
                    <select class="mdb-select" id="name" name="name" searchable="Search here.." >
                                <option value="" disabled selected>Choose Employee</option>
                                @foreach($employees as $id => $employee_name)
                                    <option value="{{$id}}" >{{$employee_name}}</option>
                                @endforeach
                            </select>

                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="date" name="date" class="form-control datepicker">
                        <label for="date">Search by Date</label>
                    </div>
                    
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </form>
            </div>
            <div class="col-1">
                <a class="btn-floating btn-sm blue-gradient" href="/compliance/create"><i class="fa fa-plus"></i></a>
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
                <th>Encounter Type</th>
                <th>Department</th>
                <th>Incident Description</th>
                <th>Attachments</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @include('compliance.partials.encounterrow')
        </tbody>
    </table>
    {{$encounters->links()}}
</div>
<div>
    <p>&nbsp</p>
    <p>&nbsp</p>
</div>


@stop

@section('styles')

@stop

@section('scripts')

@stop