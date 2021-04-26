@extends('layouts.reports')

@section('page-title', __('Daily Dispatch Statistics'))
@section('page-heading', __('Daily Dispatch Statistics'))


@section('content')

    <div class="row">
        <div class="col-8 text-center">
            <img src="{{ public_path('assets/light/img/logo.png') }}" alt="Medic Dispatch" height="50"> <span style="font-weight: bold; font-style: italic; font-size: 20pt;" > Medic | Dispatch</span>
        </div>
        <div class="col-4">
            <table class="table">
                <thead>
                <tr>
                    <th>Report</th>
                    <td>{{$title}}</td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>{{\Carbon\Carbon::now()->format('m-d-Y H:i')}}</td>
                </tr>
                <tr>
                    <th>Requested By:</th>
                    <td>System Generated</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('reports.shiftUhuBody')


@stop

@push('css')
    <style>
        .progress {
            position: relative;
        }

        .progress span {
            position: absolute;
            display: block;
            width: 100%;
            color: black;
        }

    </style>
@endpush

@push('scripts')


@endpush
