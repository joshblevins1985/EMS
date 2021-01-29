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
<div class="row">
    <form action="{{ route('application.store_schoolhx') }}" method="post"  class="education_form">
        <div class="row">
            <div class="col-lg-6">Provided you have no education to report please type none in the first box to move forward.</div>
            <div class="col-lg-6">
                 
            </div>
        </div>
        

        <table id="school_table" align=center class="table table">
            <tr>
                <th>Please enter all formal education degrees or certificates.</th>
            </tr>
            <tr id="row1">
                <input type='hidden' class='form-control' name='edu[application_id][]' value="{{$employee}}" placeholder='Start Date'/>
                <td> <div class ="md-form"><input type='text' class='form-control' name='edu[completed][]' placeholder='Year Completed'></div> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='edu[school][]' placeholder='School Name'></div> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='edu[state][]' placeholder='State'></div> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='edu[degree][]' placeholder='Degree/Certification'></div> </td>
            </tr>
        </table>
        <input type="button" class="btn btn-primary" onclick="add_row_school();" value="ADD ROW">

        <button class="btn btn-primary btn-block my-4" type="submit" >Add Education History</button>

        @csrf
        {!! Form::close() !!}
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
    function add_row_school() {
        $rowno = $("#school_table tr").length;
        $rowno = $rowno + 1;
        $("#school_table tr:last").after("" +
            "<tr id='row" + $rowno + "'>" +
            "<input type='hidden' class='form-control' name='edu[application_id][]' value='{{$employee}}' placeholder='Start Date'>"+
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='edu[completed][]' placeholder='Year Completed'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='edu[school][]' placeholder='School Name'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='edu[state][]' placeholder='State'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='edu[degree][]' placeholder='Degree/Certification'></div> </td>" +
            "<td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></div></td>" +
            "</tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>


@stop

