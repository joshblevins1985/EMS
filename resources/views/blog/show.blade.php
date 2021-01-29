@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet"/>
    <link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet"/>
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"/>
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Employee Blog</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">{{$training_blog->title}}</h1>

    <div class="row">
        <div class="col-xl-12 mb-2">
            Date: {{ Carbon\Carbon::parse($training_blog->date_to_send)->format('m-d-Y') }}
        </div>
        <div class="col-xl-12 mb-2">
            Author: {{ $training_blog->author }}
        </div>
        <div class="col-xl-12 mb-2">
            {!! $training_blog->content !!}
        </div>

        @if($training_blog)
            <div class="col-xl-12 mb-2">
                <a href="{{asset($training_blog->file)}}"> View Attachment </a>
            </div>
        @endif

    </div>


@endsection



@push('scripts')


@endpush
