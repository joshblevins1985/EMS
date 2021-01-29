@extends('layouts.reports')

@section('page-title', trans('Human Resources'))
@section('page-heading', trans('Human Resources'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Human Resources')
</li>
@stop

@section('content')

@include('partials.toastr')
<div class ="row">
    @include('hr.partials.employeeform')
</div>

@stop

@section('styles')


@stop

@section('scripts')
<script>
    // Data Picker Initialization
    $('.datepicker').pickadate();
</script>
<script type="text/javascript">


    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    
    $('.education_form').on('submit',function(e){
    var form = $(this);
    var submit = form.find("[type=submit]");
    var submitOriginalText = submit.attr("value");

    e.preventDefault();
    var data = form.serialize();
    var url = form.attr('action');
    var post = form.attr('method');
    $.ajax({
        type : post,
        url : '{{route('application.store')}}',
        data :data,
        success:function(data){
           submit.attr("value", "Submitted");
           console.log(data)
        },
        beforeSend: function(){
           submit.attr("value", "Loading...");
           submit.prop("disabled", true);
        },
        error: function() {
            submit.attr("value", submitOriginalText);
            submit.prop("disabled", false);
            
           // show error to end user
        }
    })
})

</script>

<script type="text/javascript">
    function add_row_employment() {
        $rowno = $("#employee_table tr").length;
        $rowno = $rowno + 1;
        $("#employee_table tr:last").after("" +
            "<tr id='row" + $rowno + "'>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='estart[]' placeholder='Start Date'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='eend[]' placeholder='End Date'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='ename[]' placeholder='Name'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='eaddress[]' placeholder='Address'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='ewage[]' placeholder='Position'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='eleave[]' placeholder='Reason for Leaving'></div> </td>" +
            "<td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></div></td>" +
            "</tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>

<script type="text/javascript">
    function add_row_school() {
        $rowno = $("#school_table tr").length;
        $rowno = $rowno + 1;
        $("#school_table tr:last").after("" +
            "<tr id='row" + $rowno + "'>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='scompleted[]' placeholder='Year Completed'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='sname[]' placeholder='School Name'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='saddress[]' placeholder='State'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='sdegree[]' placeholder='Degree/Certification'></div> </td>" +
            "<td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></div></td>" +
            "</tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>


@stop