@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />

@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Employee Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Financial Assistance Request</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Employee Education Financial Assistance Request</h1>
    <!-- end page-header -->

    <div id="app">
        <form-validation myaction="/financial_assistance">

       @include('financial_assistance.partials.step_form')

    </form-validation>
    </div>



@endsection



@push('scripts')
    <script src="/assets/plugins/d3/d3.min.js"></script>

    <script src="/assets/plugins/moment/moment.js"></script>
    <script src="/assets/plugins/parsleyjs/dist/parsley.js"></script>
    <script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
    <script src="/assets/js/demo/form-wizards-validation.demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="/assets/js/financial_assistance.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>


    <script>
        var handleDatepicker = function() {
	$('#start_date').datepicker({
        todayHighlight: true,
        startView: 2
    });
    $('#end_date').datepicker({
        todayHighlight: true,
        startView: 2
	});

};

var FormPlugins = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleDatepicker();
		}
	};
}();

$(document).ready(function() {
	FormPlugins.init();
});
    </script>





@endpush
