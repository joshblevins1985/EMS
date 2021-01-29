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
<div class="d-flex justify-content-center align-items-center" style="height:200px;">
    <div class="col">
        <a href="/classroom/quizQuestions/{{ $quiz->id }}/{{ $quiz->classroom_id }}" class="btn btn-primary btn-block">Edit Quiz</a>
    </div>
</div>
@endif

@if(count($quiz->attempts->where('user_id', auth()->user()->id)))
<div class="d-flex justify-content-center align-items-center" style="height:800px;">
    <div class="row">

  
       <div class="col-xl-12">
        <h1>Your Attempts For {{ $quiz->title }}</h1>
    <hr>
    </div>
    
    <div class="col-xl-12">
    <ul class="list-group">
        @foreach($quiz->attempts->where('user_id', auth()->user()->id) as $attempt)
    <li class="list-group-item @if($attempt->completed) @if($attempt->grade >= 83) bg-success @else bg-danger @endif @else bg-warning @endif mb-2">
        <div class="row">
            <div class="col-xl-2 mr-2">
                <a href="/question/{{$attempt->id}}/{{$quiz->id}}"></a>Date Started: {{ Carbon\Carbon::parse($attempt->created_at)->format('m-d-Y H:i') }}
            </div>
            <div class="col-xl-6">
                Date Completed: @if($attempt->completed) {{ Carbon\Carbon::parse($attempt->completed)->format('m-d-Y') }}  @else Incomplete @endif
            </div>
            <div class="col-xl-2 ml-2">
                Grade: @if($attempt->completed) {{ $attempt->grade }} % @else T.B.D @endif
            </div>
            <div class="col-xl-1 ml-2">
               @if(!$attempt->completed) <a href="question/{{$attempt->id}}/{{$quiz->id}}"><span class="badge badge-primary">Complete Now</span> </a>  @endif 
            </div>
        </div>
    </li>
    @endforeach
    </ul>
    </div>

    <div class="col-xl-12 mt-3">
        <a href="quizAttempt/{{$quiz->id}}" class="btn btn-lg btn-primary">
  <span class="d-flex align-items-center text-left">
    <i class="fal fa-clipboard-user fa-3x mr-3 text-black"></i>
    <span>
      <span class="d-block mb-n1"><b>Create New Attempt</b></span>
      <span class="f-s-12 f-w-600 text-white-transparent-7">You have Unlimited Attempts Left</span>
    </span>
  </span>
</a>
    </div>

    </div>
    
    
</div>

@else
<div class="d-flex justify-content-center align-items-center" style="height:800px;">
    <div class="row">
       <div class="col-xl-12">
        <h1>You have No Attempts for {{ $quiz->title }}</h1>
    <hr>
    </div>
    
    <div class="col-xl-12">
        <a href="quizAttempt/{{$quiz->id}}" class="btn btn-lg btn-primary">
  <span class="d-flex align-items-center text-left">
    <i class="fal fa-clipboard-user fa-3x mr-3 text-black"></i>
    <span>
      <span class="d-block mb-n1"><b>Create New Attempt</b></span>
      <span class="f-s-12 f-w-600 text-white-transparent-7">You have Unlimited Attempts Left</span>
    </span>
  </span>
</a>
    </div> 
    </div>
    
    
</div>
@endif




@endsection


@push('scripts')

@endpush