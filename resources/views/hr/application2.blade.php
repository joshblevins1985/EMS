@extends('layouts.empty')

@section('title', 'Employment Application')

@push('css')
<link href="/assets/plugins/smartwizard/dist/css/smart_wizard.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" />
<link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />

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
  <p class="mb-0">If you are unable to resolve this error please contact our Human Resources department at 740-351-2617.</p>
</div>

@endif
<!-- begin wizard-form -->
<form action="/application/store" method="POST" name="form-wizard" id="application" class="form-control-with-bg">
    @include('hr.partials.step1')
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



<script>

    $(document).ready(function() {
        var counter = 0;

        $("#addrow").on("click", function() {
            var newRow = $("<tr>");
            var cols = "";

            cols += '<td><select name="sc[state][]" id="state'+ counter +'" class="selectpicker" data-width="fit" data-style="btn-dark" data-parsley-group="step-2" data-parsley-required="true" title="Choose Issuing State"><option value="1">Ohio</option><option value="2">Kentucky</option><option value="3">West Virgina</option></select></td>';
            cols += '<td><select name="sc[certification_level][]" id="certification'+ counter +'" class="selectpicker" data-width="fit" data-style="btn-dark" data-parsley-group="step-2" data-parsley-required="true" title="Choose Certification Type">@foreach($cert_level as $row)<option value="{{$row->id}}">{{$row->label}}</option>@endforeach</select></td>';
            cols += '<td><div class="md-form"><input type="text" class="form-control" name="sc[cert_number][]" data-parsley-group="step-2" data-parsley-required="true" placeholder="Certification Number"></div></td>';
            cols += '<td><div class="input-group date md-form" data-provide="datepicker"><input type="text" name="sc[expiration][]" placeholder="Expiration" data-parsley-group="step-2" data-parsley-required="true" class="form-control"><div class="input-group-addon"><span ><i class="fa fa-calendar-times"></i></span></div></div></td>'
            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
            newRow.append(cols);
            $("#certification_table").append(newRow);
            $('#state'+counter).selectpicker();
            $('#certification'+counter).selectpicker();
            counter++;
        });



        $("#certification_table").on("click", ".ibtnDel", function(event) {
            $(this).closest("tr").remove();
            counter -= 1
        });


    });


$(document).ready(function() {
    var counter = 0;

    $("#addrow2").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><select name="abc[certification_type][]" id="certification_type'+ counter +'" class="selectpicker" data-width="fit" data-style="btn-dark" data-parsley-group="step-3" data-parsley-required="true" title="Choose Issuing State">@foreach($certification as $id => $certification) <option value="{{$id}}" >{{$certification}}</option> @endforeach </select></td>';
        cols += '<td><div class="md-form"><input type="text" class="form-control" name="abc[cert_number][]" data-parsley-group="step-3" data-parsley-required="true" placeholder="Certification Number"></div></td>';
        cols += '<td><div class="input-group date md-form" data-provide="datepicker"><input type="text" name="abc[expiration][]" placeholder="Expiration" data-parsley-group="step-3" data-parsley-required="true" class="form-control"><div class="input-group-addon"><span ><i class="fa fa-calendar-times"></i></span></div></div></td>'
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
        newRow.append(cols);
        $("#abc_table").append(newRow);
        $('#certification_type'+counter).selectpicker();
        counter++;
    });



    $("#abc_table").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
        counter -= 1
    });


});

$(document).ready(function() {
    var counter = 0;

    $("#addrow3").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td><div class ="md-form"><input type="text" id="completed" name="education[completed][]" placeholder="Year Completed" data-parsley-group="step-4" data-parsley-required="true" class="form-control"><span ><i class="fa fa-calendar-times"></i></span></div></td>'
        cols += '<td> <div class ="md-form"><input type="text" class="form-control" name="education[school][]" data-parsley-group="step-4" data-parsley-required="true" placeholder="School Name"></div> </td>';
        cols += '<td> <div class ="md-form"><input type=\'text\' class=\'form-control\' name=\'education[state][]\' data-parsley-group="step-4" data-parsley-required="true" placeholder=\'State\'></div> </td>';
        cols += '<td> <div class ="md-form"><input type=\'text\' class=\'form-control\' name=\'education[degree][]\' data-parsley-group="step-4" data-parsley-required="true" placeholder=\'Degree/Certification\'></div> </td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
        newRow.append(cols);
        $("#education_table").append(newRow);
        counter++;
    });



    $("#education_table").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
        counter -= 1
    });


});

$(document).ready(function() {
    var counter = 0;

    $("#addrow4").on("click", function() {
        var newRow = $("<tr>");
        var cols = "";

        cols += '<td> <div class ="md-form"><input type="text" class="form-control" data-parsley-group="step-5" data-parsley-required="true" name="employment[start][]" placeholder="Year Start"></div> </td>';
        cols += '<td> <div class ="md-form"><input type="text" class="form-control" data-parsley-group="step-5" name="employment[end][]" placeholder="Year End"></div> </td>';
        cols += '<td> <div class ="md-form"><input type="text" class="form-control" data-parsley-group="step-5" data-parsley-required="true" name="employment[name][]" placeholder="Employer Name"></div> </td>';
        cols += '<td> <div class ="md-form"><input type="text" class="form-control" data-parsley-group="step-5" data-parsley-required="true" name="employment[address][]" placeholder="Phone Number"></div> </td>';
        cols += '<td> <div class ="md-form"><input type="text" class="form-control" data-parsley-group="step-5" name="employment[wage][]" placeholder="Wage"></div> </td>';
        cols += '<td> <div class ="md-form"><input type="text" class="form-control" data-parsley-group="step-5" data-parsley-required="true" name="employment[leave][]" placeholder="Reason Departed"></div> </td>';
        cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
        newRow.append(cols);
        $("#employment_table").append(newRow);
        counter++;
    });



    $("#employment_table").on("click", ".ibtnDel", function(event) {
        $(this).closest("tr").remove();
        counter -= 1
    });


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
