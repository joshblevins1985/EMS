@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('app.dashboard')
</li>
@stop

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6 ">
                @include('manager.partials.employee')
            </div>

            <div class="col-lg-6 ">
                @include('manager.partials.attendance')
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('manager.partials.signatures')
            </div>
        </div>

    </div>

    <div class="col-lg-4 col-sm-12">
        <div class="col-lg-12">
            @if(!count($encounters))

            @else
            @include('manager.partials.encounters')
            @endif
            @if(!count($qa))
            @else
            @include('manager.partials.qa')
            @endif
        </div>
    </div>
</div>

@stop

@section('scripts')

@stop