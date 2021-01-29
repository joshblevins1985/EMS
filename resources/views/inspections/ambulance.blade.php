@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet"/>
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        .hiddenRow {
            padding: 0 !important;
        }
    </style>
@endpush

@section('content')

    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Employee Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Vehicle Inspections</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Ambulance Inspection</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Ambulance Pre-Shift Inspection</h1>
    <!-- end page-header -->

    <div class="row">
        <form action="/inspection/ambulance" method="post">
            @csrf
            <div class="row">
        @foreach($ambulance_items as $item)
        <div class="col-xl-6">
            {{$item->string}}
        </div>
        <div class="col-xl-6 mb-2">
            @if($item->field_type == 1)
                <div class="switcher">
                    <input type="checkbox" name="{{$item->id}}" id="{{$item->id}}" checked="" value="1">
                    <label for="{{$item->id}}"></label>
                </div>
                @endif
        </div>
            @endforeach

            <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>





@endsection

@include('fto.partials.ftoDateModal')

@push('scripts')


@endpush
