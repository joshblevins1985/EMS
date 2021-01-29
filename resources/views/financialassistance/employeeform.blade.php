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

{!! Form::open(['route' => 'financial.store', 'id' => 'badrunsheets-form']) !!}    
@include('financialassistance.partials.create')

{!! Form::close() !!}



@stop

@section('styles')

@stop

@section('scripts')


@stop