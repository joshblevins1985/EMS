@extends('layouts.default')

@section('title', 'Bucyrus Run Log')

@push('css')
<link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<style>
    .pac-container {

    position: relative;
    z-index: 9999999
}
.toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20px; background-color: black; }
.toggle.ios .toggle-handle {  border-radius: 20px; background-color: black; }
</style>
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="/dashboard">home</a></li>
    <li class="breadcrumb-item"><a href="/bucyrus">Bucyrus</a></li>
    <li class="breadcrumb-item"><a href="/bucyrus/create">Add New Incident</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">Add New Incident</h1>
<!-- end page-header -->





@endsection

@push('scripts')
<script src="/assets/js/demo/dashboard-v3.js"></script>
<script src="/assets/plugins/parsleyjs/dist/parsley.js"></script>
<script src="/assets/plugins/smartwizard/dist/js/jquery.smartWizard.js"></script>
<script src="/assets/js/demo/form-wizards-validation.demo.js"></script>
<script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<script>$.fn.selectpicker.Constructor.BootstrapVersion = '4';</script>
<script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>



@endpush
