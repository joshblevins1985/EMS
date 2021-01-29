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
    <div class="card-header danger-color white-text">
        <h2>Classes Instructed</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-11">
                <form class="form-inline" role="search" method="GET" action="#">
                    @csrf
                    <div class="md-form mb-4 mr-sm-2">
                        <input type="text" class="form-control" id="name" name="name">
                        <label for="name">Search by Last Name</label>
                    </div>

                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="date" name="date" class="form-control datepicker">
                        <label for="date">Search by Date</label>
                    </div>
                    
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </form>
            </div>
            <div class="col-1">
                <a class="btn-floating btn-sm blue-gradient" href="classes/create"><i class="fa fa-plus"></i></a>
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
                <th>Class ID</th>
                <th>Course</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Total Enrolled</th>
                <th>Total Completed</th>
                <th>Class Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>

            @if(count($classes))
            @foreach($classes as $row)
            @include('classes.partials.row')
            @endforeach
            @else
            <tr><td colspan=5><h2>No Classes Found</h2></td></tr>
            @endif


            </tbody>
        </table>
    </div>
    {{$classes->links()}}
</div>
<!--/.Panel-->
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