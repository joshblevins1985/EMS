@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.messages')


<div class="row-fluid">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Date of Incident</th>
                <th>PCR #</th>
                <th>Employee</th>
                <th>Error Noted</th>
            </tr>
        </thead>
        <tbody>
            @include('qa.partials.rserow')
        </tbody>
        </table>
    {{ $rse->links() }}
</div>

@stop

@section('styles')

@stop
@section('scripts')


@stop