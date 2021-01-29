@extends('layouts.sidebar-fixed')

@section('title', 'Classroom Assessment')

@push('css')
<style>
    body {
  height: 100%
}
</style>


@endpush

@section('content')

@if($instructor)
<div class="d-flex justify-content-center align-items-center mb-5" style="height:200px;">
    <div class="col">
        <a href="/classroom/addQuestion/{{ $qid }}/{{ $cid }}  " class="btn btn-primary btn-block">Add New Question</a>
    </div>
</div>
@endif

@if($questions)
@foreach($questions as $row)
<div class="row mb-3">
    <div class="col-xl-12">
        <div class="card">
          <div class="card-body">
            <h2 class="card-title mb-2"><?php $index= $loop->index + 1;?> {{ $index }}.  {!! $row->label !!}</h2>
            @foreach($row->answers as $a)
            <div class="row mb-2">
                @if($a->is_correct)
                <span class="bg-success"><h3>{!! $a->answer !!}</h3></span>
                @else
                <h3>{!! $a->answer !!}</h3>
                @endif
            </div>
            @endforeach
            @if($instructor)
            <div class="d-flex justify-content-center align-items-center mb-5" style="height:200px;">
                <div class="col">
                    <a href="/classroom/addAnswer/{{ $row->id }}/{{ $qid}}" class="btn btn-primary btn-block">Add New Answer</a>
                </div>
            </div>
            @endif
          </div>
        </div>
    </div>
</div>
@endforeach
@else
<h1>No Question Availalbe For Quiz</h1>
@endif
@endsection


@push('scripts')
<script src="/assets/plugins/summernote/dist/summernote.min.js"></script>

@endpush
