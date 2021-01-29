@extends('layouts.app')

@section('page-title', trans('Driving Assessments'))
@section('page-heading', trans('Driving Assessments'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Driving Assessments')
</li>
@stop

@section('content')

@include('partials.toastr')

<!--Panel-->
<div class="card text-center">
    <div class="card-header elegant-color white-text">
        <h2>Facility List</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-11">
                <form class="form-inline" role="search" method="GET" action="#">
                    @csrf
                    <div class="md-form ">
                        <input type="text" class="form-control" id="name" name="name">
                        <label for="name">Search by Facility Name</label>
                    </div>

                    
                    
                    <button class="btn btn-primary" type="submit"><i class="fa fa-search" aria-hidden="true"></i>
</button>
                </form>
            </div>
            <div class="col-1">
                <a class="btn-floating btn-sm blue-gradient" href="facilities/create"><i class="fa fa-plus"></i></a>
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
                <th>Date</th>
                <th>Employee</th>
                <th>Score</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            
            @if(count($facilities))
            <tr>@foreach($facilities as $row)</tr> 
            @include('facilities.partials.row')
            @endforeach
            @else
            <tr><td colspan=5><h2>No Facilities Found</h2></td></tr>
            @endif


            </tbody>
        </table>
    </div>
    
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