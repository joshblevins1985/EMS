@extends('layouts.sidebar-fixed')

@section('title', 'Classroom')

@push('css')
<link href="/assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet" />

@endpush

@section('content')

<form action="/classroom/addQuiz" method="post">

    {{csrf_field()}}

    <input type="hidden" name="classroom_id" value="{{ $section->classroom_id }}">
    <input type="hidden"  name="section_id" value="{{ $section->id }}">
    <input type="text" class="form-control mb-2" name="label" placeholder="Title of Video">
    <input type="text" class="form-control mb-2" name="link" placeholder="Insert You Tube Link Here">
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



    <button type="submit" class="btn btn-primary">Add New You Tube Video</button>

{!! Form::close() !!}

@endsection



@include('classroom.partials.modalQuiz')
@include('classroom.partials.modalYouTube')



@push('scripts')
<script src="/assets/plugins/summernote/dist/summernote.min.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
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
