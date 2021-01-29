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

<!-- Card -->
<div class="card card-cascade narrower">

  <!-- Card image -->
  <div class="view view-cascade gradient-card-header purple-gradient">

    <!-- Title -->
    <h2 class="card-header-title">{{$audit->employee->first_name}} {{$audit->employee->last_name}}</h2>
    <!-- Subtitle -->
    <h5 class="mb-0 pb-3 pt-2">Occurance Type: {{$audit->audits->label}}</h5>
    
    <div class="row">
        <div class="col-3">Date and Time: {{date('m/d/Y H:i', strtotime($audit->created_at))}}</div>
        <div class="col-3">Narc Box Number: {{$audit->box->box_number}}</div>
        <div class="col-3">Narc Log Id: NL-{{$audit->log->id}}</div>
        <div class="col-3">Audit Status: @if($audit->status == 0) Open @elseif($audit->status == 1)Closed@else Unknown @endif</div>
    </div>


  </div>

  <!-- Card content -->
  <div class="card-body card-body-cascade text-center">
      
      <div class="row">
          Incident Description: {{$audit->incident}}
      </div>

   {!! Form::open(['route' => ['narcoticaudit.update', $audit->id], 'id' => 'encounter-form']) !!}
    @method('PUT')   
@include('logistics.partials.auditform')

{!! Form::close() !!}

  </div>

</div>
<!-- Card -->

@stop

@section('styles')

@stop

@section('scripts')
<script>
    document.getElementById("medication-form").onkeypress = function(e) {
  var key = e.charCode || e.keyCode || 0;     
  if (key == 13) {
    e.preventDefault();
  }
}

</script>
@stop