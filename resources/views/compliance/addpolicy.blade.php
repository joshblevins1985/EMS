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

<div class="row-fluid" style="height: 100%; overflow:visible;">
    {!! Form::open(['route' => 'policies.store', 'method' => 'POST'], 'id' => 'badrunsheets-form']) !!}    
 
   
@include('compliance.partials.policyform')

{!! Form::close() !!}
</div>

@stop

@section('styles')

@stop

@section('scripts')
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@stop