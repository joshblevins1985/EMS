@extends('layouts.coreui')

@section('page-title', __('Daily Dispatch Statistics'))
@section('page-heading', __('Daily Dispatch Statistics'))


@section('content')

    @include('reports.dailyDispatachStatsBody')

@stop

@push('css')

@endpush

@push('scripts')


@endpush
