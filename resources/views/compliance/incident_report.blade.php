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
    <h1>Employee Incident Report</h1>
</div>
@if($encounter)
<div class"row">
    <div class="col-lg-12">
        
        <h3>Please review the following report and provide a response below.</h3>
    </div>
    
    <div class="col-lg-12">
        {!!$encounter->incident_report!!}
    </div>
    
</div>
@endif

<div class="row-fluid" style="height: 100%; overflow:visible;">
    {!! Form::open(['url' => route('incidentreports.store'), 'method' => 'POST']) !!}
    @if($encounter)
   <input type="hidden" name="incident" value="{{$encounter->id}}">
   @endif
   <div class="col-lg-12">
       <div class="md-form">
        <input placeholder="Date of Incident" type="text" id="doi" name="doi" @if($encounter) data-value="{{date('Y-m-d',strtotime($encounter->doi))}}" @endif value="{{ old('doi') }}" class="form-control datepicker">
        <label for="doi">Date of Incident</label>
    </div>
    <div class="col-lg-12">
       <div class="md-form">
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}">
                        <label for="name">Location of the Incident</label>
                    </div>
   </div>
   <div class="col-lg-12">
    <div class="form-group">
        <label for="incident_report">Provide the details of the incident.</label>
        <textarea class="form-control rounded-0" id="incident_report" name="incident_report" rows="10"value="">{{ old('incident_report') }}</textarea>
    </div>
    
    <div class="col-lg-12">
        I {{ auth()->user()->present()->name }} attest that the above is a true and accurate description of the events being reported. By typing my name below I am electronically signing this incident report.
    </div>
    
<div class="col-lg-6">
       <div class="md-form">
                        <input type="text" class="form-control" id="first_name" name="first_name">
                        <label for="first_name">First Name</label>
                    </div>
    </div>
    <div class="col-lg-6">
       <div class="md-form">
                        <input type="text" class="form-control" id="last_name" name="last_name">
                        <label for="last_name">Last Name</label>
                    </div>
</div>

<button class="btn btn-info btn-block my-4" type="submit">Add Incident Report</button>

{!! Form::close() !!}
</div>

@stop

@section('styles')

@stop

@section('scripts')
<script>
    $(document).ready(function() {
  $('#incident_report').summernote();
});
</script>
@stop