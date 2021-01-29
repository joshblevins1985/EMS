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
    <form action="/badrunsheets/{{$brs->id}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
@include('badrunsheets.partials.form')

{!! Form::close() !!}
</div>
@stop

@section('styles')

@stop
 
@section('scripts')

@stop