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
            <h2> {!! $quiz->label !!} </h2>
        </div>
        <div class="col-xl-12">
            <form action="/classroom/quiz/attempts/question/answer/{{$aid}}/{{$qid}}/{{$quiz->id}}" method="post">
                
            @csrf 
            
            <div class="form-group row m-b-10">
							
							<div class="col-md-9 mb-2">
							    @foreach($quiz->answers as $answer)
								<div class="radio radio-css">
									<input type="radio" name="answer" id="answer{{$answer->id}}" value="{{ $answer->id }}" />
									<label for="answer{{$answer->id}}">{!!$answer->answer!!}</label>
								</div>
							    @endforeach
							</div>
						</div>
						<button type="submit" class="btn btn-primary btn-block">Submit Answer</button>
						
						</form>
        </div>
    </div>
</div>




@endsection


@push('scripts')

@endpush