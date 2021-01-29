@extends('layouts.empty')

@section('title', 'Scholarship Application')

@push('css')
<link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
<link href="/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css" rel="stylesheet" />


<style>
    .selector-for-some-widget {
        box-sizing: content-box;
    }
</style>
@endpush

@section('content')



<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">Employment Application</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">New Employee Application</h1>
<!-- end page-header -->

@if (session('error'))

<div class="alert alert-danger" role="alert" id="error-alert">
  <h4 class="alert-heading">There has been an error.</h4>
  <p id="error"></p>
  <hr>
  <p class="mb-0">If you are unable to resolve this error please contact our Education department at 740-351-2667.</p>
</div>

@endif
<!-- begin wizard-form -->
<form action="/scholarship/application/store" method="POST" name="form-wizard" id="application" class="form-control-with-bg">
    <!-- begin wizard -->
    <div id="wizard">

        <!-- begin wizard-step -->
        <ul>
            <li>
                <a href="#step-1">
                    <span class="number">1</span>
                    <span class="info">
							Personal Info
							<small>Name, Address, Phone, Email, Drivers License </small>
						</span>
                </a>
            </li>
            <li>
                <a href="#step-2">
                    <span class="number">2</span>
                    <span class="info">
							Future Goals
							<small>What are your future goals?</small>
						</span>
                </a>
            </li>
            <li>
                <a href="#step-3">
                    <span class="number">3</span>
                    <span class="info">
							Employment
							<small>Employment history.</small>
						</span>
                </a>
            </li>
            <li>
                <a href="#step-4">
                    <span class="number">4</span>
                    <span class="info">
							Extra-Curricular Activities
							<small>Clubs, organizations, band, church, ect.</small>
						</span>
                </a>
            </li>
            <li>
                <a href="#step-5">
                    <span class="number">5</span>
                    <span class="info">
							Future plans
							<small></small>
						</span>
                </a>
            </li>
            <li>
                <a href="#step-6">
                    <span class="number">6</span>
                    <span class="info">
							Essay
							<small>EMT essay</small>
						</span>
                </a>
                <a href="#step-7">
                    <span class="number">7</span>
                    <span class="info">
							Next Steps
							<small></small>
						</span>
                </a>
            </li>
        </ul>
        <!-- end wizard-step -->
        <!-- begin wizard-content -->
        <div>

            <!-- begin step-1 -->
            <div id="step-1">

                <!-- begin fieldset -->
                <fieldset id="step-0">
                    <!-- begin row -->
                    <div class="row">
                        @include('scholarships.partials.step1')
                    </div>
                    <!-- end row -->
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-1 -->
            <!-- begin step-2 -->
            <div id="step-2">
                <!-- begin fieldset -->
                <fieldset>
                    <!-- begin row -->
                    <div class="row">
                        @include('scholarships.partials.step2')
                    </div>
                    <!-- end row -->
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-2 -->
            <!-- begin step-3 -->
            <div id="step-3">
                <!-- begin fieldset -->
                <fieldset>
                    @include('scholarships.partials.step3')
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-3 -->
            <!-- begin step-4 -->
            <div id="step-4">
                <!-- begin fieldset -->
                <fieldset>
                    @include('scholarships.partials.step4')
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-4 -->
            <!-- begin step-5 -->
            <div id="step-5">
                <!-- begin fieldset -->
                <fieldset>
                    @include('scholarships.partials.step5')
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-5 -->
            <!-- begin step-6 -->
            <div id="step-6">
                <!-- begin fieldset -->
                <fieldset>
                    @include('scholarships.partials.step6')
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-6 -->
            <!-- begin step-7 -->
            <div id="step-7">
                <!-- begin fieldset -->
                <fieldset>
                    @include('scholarships.partials.step7')
                </fieldset>
                <!-- end fieldset -->
            </div>
            <!-- end step-7 -->
        </div>
        <!-- end wizard-content -->
    </div>
    <!-- end wizard -->
</form>
<!-- end wizard-form -->

@endsection


@push('scripts')

<script src="/assets/plugins/parsleyjs/dist/parsley.js"></script>
<script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
<script src="/assets/js/demo/form-wizards-validation.demo.js"></script>
<script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script>$.fn.selectpicker.Constructor.BootstrapVersion = '4';</script>
<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<script src="/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>

<script>
    var handleFormWysihtml5 = function () {
	"use strict";
	$('#wysihtml5').wysihtml5();
};

var FormWysihtml5 = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleFormWysihtml5();
		}
	};
}();

$(document).ready(function() {
	FormWysihtml5.init();
});
</script>



<script>
    $("#completed").datepicker( {
    format: " YYYY", // Notice the Extra space at the beginning
    viewMode: "years",
    minViewMode: "years"
});
</script>
@endpush
