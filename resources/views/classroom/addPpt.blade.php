@extends('layouts.sidebar-fixed')

@section('title', 'Classroom')

@push('css')
<link href="/assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />

@endpush

@section('content')

<form action="/classroom/addPpt" method="post" enctype="multipart/form-data">

    {{csrf_field()}}
    <div class="custom-file mb-2">
        <input type="file" class="custom-file-input" name="file" id="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
      </div>
    <input type="hidden" name="classroom_id" value="{{ $section->classroom_id }}">
    <input type="hidden"  name="section_id" value="{{ $section->id }}">
    <input type="text" class="form-control mb-2" name="label" placeholder="Title of File">

    <input type="text" class="form-control mb-2" id="datepicker-default" name="due_date" placeholder="Select Due Date"  />
    <div class="form-group row m-b-10">
							<label class="col-md-3 col-form-label">Required</label>
							<div class="col-md-9">
								<div class="radio radio-css radio-inline">
									<input type="radio" name="required" id="inlineCssRadio1" value="1" checked />
									<label for="inlineCssRadio1">Yes</label>
								</div>
								<div class="radio radio-css radio-inline">
									<input type="radio" name="required" id="inlineCssRadio2" value="0" />
									<label for="inlineCssRadio2">No</label>
								</div>
							</div>
						</div>

    <textarea class="summernote" name="content"></textarea>



    <button type="submit" class="btn btn-primary">Add New PDF File</button>

{!! Form::close() !!}

@endsection



@include('classroom.partials.modalQuiz')
@include('classroom.partials.modalYouTube')



@push('scripts')
<script src="/assets/plugins/summernote/dist/summernote.min.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
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
    		height: $(window).height() - $('.summernote').offset().top - 600
    	});
    };

    var handleDatepicker = function() {
    	$('#datepicker-default').datepicker({
    		todayHighlight: true
    	});
    };

    var FormSummernote = function () {
    	"use strict";
    	return {
    		//main function
    		init: function () {
    			handleSummernote();
    			handleDatepicker();
    		}
    	};
    }();

    $(document).ready(function() {
    	FormSummernote.init();
    });
</script>

@endpush
