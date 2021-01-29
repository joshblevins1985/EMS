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
    <form action="{{ route('application.store_interviewform') }}" method="post" enctype="multipart/form-data" class="education_form">
        <input type='hidden' class='form-control' name='pid' value="{{$employee}}" >
        <div class="row">
            <div class="col-lg-10">How many years driving a personal vehicle do you have?</div>
            <div class="col-lg-2"> <input type="text" class="form-control" name="year_pdrive"/> </div>
            <div class="col-lg-10">How many years driving a commercial vehicle do you have?</div>
            <div class="col-lg-2"> <input type="text" class="form-control" name="year_cdrive"/> </div>
            <div class="col-lg-10">How many years driving a emergency vehicle do you have?</div>
            <div class="col-lg-2"> <input type="text" class="form-control" name="year_edrive"/> </div>
            <div class="col-lg-10">Have you ever worked for in EMS before?</div>
            <div class="col-lg-2">
                <!-- Default inline 1-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="emswork1" name="emswork" value="yes">
                  <label class="custom-control-label" for="emswork1">Yes</label>
                </div>
                
                <!-- Default inline 2-->
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" id="emswork2" name="emswork" value="no">
                  <label class="custom-control-label" for="emswork2">No</label>
                </div>
            </div>
            <div class="col-lg-10">If yes how many years have you served in EMS?</div>
            <div class="col-lg-2"> <input type="text" class="form-control" name="ems_years"/> </div>
        </div>
        
          
          <button class="btn btn-primary btn-block my-4" type="submit" >Next Step</button>
          @csrf
          {!! Form::close() !!}
</div>

<div class="row">
    
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
             "<input type='hidden' value='"+ $rowno +"' name='rowid'/>"+
            "<input type='hidden' class='form-control' name='edu[index][application_id]' value='450' placeholder='Start Date'>"+
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='edu[index][completed]' placeholder='Year Completed'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='edu[index][school]' placeholder='School Name'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='edu[index][state]' placeholder='State'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='edu[index][degree]' placeholder='Degree/Certification'></div> </td>" +
            "<td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></div></td>" +
            "</tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>


@stop

