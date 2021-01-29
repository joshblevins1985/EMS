@extends('layouts.sidebar-fixed')

@section('title', 'Classroom Assessment')

@push('css')
<link href="/assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
@endpush

@section('content')


<div class="d-flex justify-content-center align-items-center" style="height:800px;">
    <div class="row">
        <div class="col-xl-12 mb-4">

        </div>
        <div class="col-xl-12">
            <form action="/classroom/addQuestion" method="post">

            @csrf
            <input type="hidden" name="qid" value="{{ $qid }}">
            <input type="hidden" name="cid" value="{{ $cid }}">
            <div class="form-group row m-b-10">
            <textarea class="summernote" name="label"></textarea>
            </div>


						<button type="submit" class="btn btn-primary btn-block">Submit Question</button>

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
    		placeholder: 'Provide a brief description of the quiz here.',
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
