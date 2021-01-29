@extends('layouts.app')

@section('page-title', trans('Competencies'))
@section('page-heading', trans('Competencies'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Competencies')
</li>
@stop

@section('content')

@include('partials.toastr')

<div class="row">
    <ul class="nav nav-pills nav-fill">
      <li class="nav-item">
        <a class="nav-link" href="/emp/competency/completed">Complete All Competencies</a>
      </li>
      
    </ul>
</div>

@stop

@section('styles')

@stop

@section('scripts')
<script>
    $("#status").change(function () {
        $("#employee-form").submit();
    });
</script>
@stop