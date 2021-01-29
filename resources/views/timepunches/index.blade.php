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
    <div class="card-header primary-color white-text">
        <h2>Employee Time Sheets </h2>            
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-11">
                <form class="form-inline" role="search" method="GET" action="{{url('timeclock.list')}}">
                    @csrf
                    <div class="md-form mb-4 mr-sm-2">
                        <input type="text" class="form-control" id="fname" name="fname">
                        <label for="fname">Search by First Name</label>
                    </div>
                    <div class="md-form mb-4 mr-sm-2">
                        <input type="text" class="form-control" id="lname" name="lname">
                        <label for="lname">Search by Last Name</label>
                    </div>

                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="indate" name="indate" value="" class="form-control datepicker">
                        <label for="date">Search by Start In Date</label>
                    </div>
                    
                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="outdate" name="outdate" value="" class="form-control datepicker">
                        <label for="date">Search by Start Out Date</label>
                    </div>
                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="sdate" name="sdate" value="" class="form-control datepicker">
                        <label for="date">Start Date</label>
                    </div>
                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="edate" name="edate" value="" class="form-control datepicker">
                        <label for="date">Search by End Date</label>
                    </div>
                    
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </form>
            </div>
            <div class="col-1">
                <a class="btn-floating btn-sm blue-gradient" href="badrunsheets/create"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>


<!--/.Panel-->

<!--Panel-->
<div class="card text-center">

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>In Date/Time</th>
                    <th>Out Date / Time</th>
                    <th>Total Hours</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @if(count($punches))
                @foreach($punches as $row)
                @include('timepunches.partials.row')
                @endforeach
                @else
                <tr><td colspan=5><h2>No Time Punches Found</h2></td></tr>
                @endif


            </tbody>
        </table>
    </div>
    {{ $punches->links() }}
</div>
<!--/.Panel-->
@stop

@section('styles')

@stop

@section('scripts')

<script>
// Data Picker Initialization
    $('.datepicker').pickadate();
</script>
@stop