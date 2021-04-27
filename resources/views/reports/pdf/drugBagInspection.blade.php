@extends('layouts.report')

@section('page-title', __('Missing Drug Bag Inspections'))
@section('page-heading', __('Missing Drug Bag Inspections'))


@section('content')

    <div class="row">
        <div class="col-7 text-center">
            <div class="row">
                <img src="{{ public_path('assets/light/img/logo.png') }}" alt="Medic Dispatch" height="50"><span style="font-weight: bold; font-style: italic; font-size: 20pt;" > Medidex|Solutions</span>
            </div>
             <div class="row">
                 <table class="table">
                     <tr>
                         <td>Old Seal</td>
                         <td>{{$inspection->items['baginfo']['oldSeal']}}</td>
                         <td>New Seal</td>
                         <td>{{$inspection->items['baginfo']['newSeal']}}</td>
                     </tr>
                 </table>
             </div>
        </div>
        <div class="col-5">
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
                    <th>Drug Bag Id</th>
                    <td>{{$inspection->bag->bag_number ?? '' }}</td>
                </tr>
                <tr>
                    <th>Requested By:</th>
                    <td>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</td>
                </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('reports.drugBagInspectionBody')


@stop

@push('css')

@endpush

@push('scripts')


@endpush
