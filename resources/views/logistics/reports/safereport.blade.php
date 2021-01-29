@extends('layouts.app')

@section('page-title', trans('Narcotic Box'))
@section('page-heading', trans('Narcotic Box Info'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

    @include('partials.toastr')

<div class="row">
    <div class="col-sm-12 col-lg-8">
        <h1>Main Safe Report</h1>
        <a href="{{ URL::to('/logistic/safereportpdf') }}">Export PDF</a>
    </div>
    <div class="col-sm-12 col-lg-4">
        <table>
            <tr>
                <td>Date:</td>
                <td>{{date('m-d-Y H:i:s', strtotime('now'))}}</td>
            </tr>
            <tr>
                <td>Reported By:</td>
                <td>{{ auth()->user()->present()->nameOrEmail }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="row">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Vial ID</th>
                <th>Medication</th>
                <th>NDC #</th>
                <th>Lot #</th>
                <th>Expiration</th>
            </tr>
            @foreach($medssafe as $row)
            <tr>
                <td>{{sprintf('%08d', $row->id )}}</td>
                <td>{{$row->medications->trade_name}}</td>
                <td>{{$row->ndc_number}}</td>
                <td>{{$row->lot_number}}</td>
                <td>{{date('m-d-Y', strtotime($row->expiration)) }}</td>
            </tr>
            @endforeach
        </thead>
    </table>
</div>
@stop

@section('styles')

@stop

@section('scripts')

@stop