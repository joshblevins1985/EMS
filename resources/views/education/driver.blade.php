@extends('layouts.app')

@section('page-title', trans('Driver Evaluation By Employee'))
@section('page-heading', trans('Driver Evaluation By Employee'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Driver Evaluation By Employee')
    </li>
@stop

@section('content')

@include('partials.messages')
<div class="row">
    <div class="col-lg-12">
        @if($da) <button type="button" class="btn btn-primary btn-lg btn-block">There is {{count($da)}} reports that need printed and sent.</button>@endif
    </div>
        
</div>

<div class="row">
    @include('education.partials.noeval_driver')
    
    @include('education.partials.eval_driver')
</div>

@stop

@section('styles')

@stop
@section('scripts')



@stop