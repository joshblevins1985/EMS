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
    {!! Form::open(['route' => ['compliance.update', $encounter->id], 'id' => 'encounter-form']) !!}
    @method('PUT')
@include('compliance.partials.encounterfrom')

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