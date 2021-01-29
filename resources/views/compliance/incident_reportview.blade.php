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
<a href="{{ URL::to('/incidentreport/pdf/'.$ir->id) }}">Export PDF</a>
<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="row justify-content-center">
            <h1>Portsmouth Emergency Ambulance Service Inc</h1>
            <p><h3>2796 Gallia Street Portsmouth, Ohio 45562</h3></p>

        </div>
        <div class="row justify-content-center "><h5>Phone: (740)351-3122  <image src="{{ url('public/assets/img/solrpt.jpg') }}"> Fax:(740)354-7100</h5></div>

        <div class="row border-bottom border-dark" style=" padding: 10px;">

                <span class=" font-weight-bold ">Employee  Report/Addendum

                </span>

        </div>
        <div class="row border-bottom border-dark report" style=" padding: 10px;">
            <div class="col-md-3">
                <span class="font-weight-bold report">Employee: {{$ir->employee->first_name}} {{$ir->employee->last_name}} EID: {{$ir->employee->eid}}</span>
            </div>
            <div class="col-md-3">
                <span class="font-weight-bold report">Job Title: {{$ir->employee->employeepositions->label}} </span>
            </div>
            <div class="col-md-3">
                <span class="font-weight-bold report">Date of Report: {{date('m-d-Y H:i', strtotime($ir->created_at))}}</span>
            </div>
            <div class="col-md-3">
                <span class="font-weight-bold report">Report ID: IR-{{date('y', strtotime($ir->created_at))}}-{{sprintf('%05d', $ir->id )}}</span>
            </div>

        </div>

        <div class="row border-bottom border-dark report" style="min-height: 350px; padding: 10px;">
            <div class="col-md-12">
                <span class="font-weight-bold ">Employee Statement:</span>
            </div>
            <div class="col-md-12">
                {!!$ir->report!!}
            </div>
        </div>
        
        <div class="row border-bottom border-dark report">
            <div class="col-md-12">
                <span class="font-weight-italic">By signing this form, you attest that this is your true and accurate recall of the events. </span>
            </div>
        </div>
        <div class="row report" style=" padding: 10px;">
            <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                Employee Signature: Electronically Signed by: {{$ir->employee->first_name}} {{$ir->employee->last_name}} EID: {{$ir->employee->eid}}
            </div>
            <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
               Date: {{date('m-d-Y H:i', strtotime($ir->created_at))}} 
            </div>
        </div>
        <div class="row " style=" padding: 10px;">
            <div class="col-8" style="margin-top: 5px; margin-bottom: 5px">
                Management Signature:__________________________________________________
            </div>
            <div class="col-4" style="margin-top: 5px; margin-bottom: 5px">
                Date:_______________________
            </div>
        </div>
        

    </div>



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