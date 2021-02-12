@extends('layouts.clean')

@section('title', 'Classroom Assessment')

@push('css')
<link href="/assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
@endpush

@section('content')

<a href="/classroom/quizQuestions/{{ $q->id or ''}}/ {{ $q->classroom_id or ''}}" class="btn btn-primary btn-block">Back to Questions</a>
<div class="d-flex justify-content-center align-items-center" style="height:800px;">
    <div class="row">
        <div class="col-xl-12 mb-4">

        </div>
        <div class="col-xl-12">
            <form action="/classroom/addAnswer" method="post">

            @csrf
            <input type="hidden" name="qid" value="{{ $qid }}">
            <h2>{!! $question->label or 'No Question' !!}</h2>
            <div class="form-group row m-b-10">
            <textarea class="summernote" name="label"></textarea>
            </div>
			<div class="form-group row m-b-10">
							<label class="col-md-3 col-form-label">Is Correct</label>
							<div class="col-md-9">
								<div class="radio radio-css radio-inline">
									<input type="radio" name="is_correct" id="inlineCssRadio1" value="1" checked />
									<label for="inlineCssRadio1">Yes</label>
								</div>
								<div class="radio radio-css radio-inline">
									<input type="radio" name="is_correct" id="inlineCssRadio2" value="0" checked/>
									<label for="inlineCssRadio2">No</label>
								</div>
							</div>
						</div>

						<button type="submit" class="btn btn-primary btn-block">Submit Answer</button>

						</form>
        </div>
    </div>
</div>
</div>




@endsection


@push('scripts')
<script src="/assets/plugins/summernote/dist/summernote.min.js"></script>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
<script>
    var handleSummernote = function() {
    	$('.summernote').summernote({
    		placeholder: 'Provide a answer for the question.',
    		height: $(window).height() - $('.summernote').offset().top - 80
    	});
    };

    var FormSummernote = function () {
    	"use strict";
    	return {
    		//main function
    		init: function () {
    			handleSummernote();
    		}
    	};
    }();

    $(document).ready(function() {
    	FormSummernote.init();
    });
</script>
@endpush
