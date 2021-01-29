@extends('layouts.app')

@section('page-title', trans('Edit Policy'))
@section('page-heading', trans('Edit Policy'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')


<div class="row-fluid" style="height: 100%; overflow:visible;">
    {!! Form::open(['route' => ['policies.update', $policy->id], 'id' => 'encounter-form']) !!}
    @method('PUT')
    
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