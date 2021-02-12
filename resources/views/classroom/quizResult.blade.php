@extends('layouts.clean')

@section('title', 'Classroom Assessment')

@push('css')
<style>
    body {
  height: 100%
}
</style>


@endpush

@section('content')


<div class="d-flex justify-content-center align-items-center" style="height:800px;">
    <div class="row">
        <div class="col-xl-12 mb-4">
            <h2> @if($percent > 80) Congratualtions you've passed. @else Sorry you did not achieve a passing score. @endif </h2>
            <h1> {{ round($percent, 2) }} %</h1>
            <h2>{{ $message }}</h2>
        </div>
    </div>
</div>




@endsection


@push('scripts')

@endpush