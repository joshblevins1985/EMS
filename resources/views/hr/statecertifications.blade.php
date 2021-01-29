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
    <form action="{{ route('application.store_state') }}" method="post" enctype="multipart/form-data" class="education_form">
            
            <table id="school_table" align=center class="table table">
            <tr>
                <th>Please enter all EMS state certifications.</th>
            </tr>
            <tr id="row1">
                <input type='hidden' class='form-control' name='sc[index][user_id]' value="450" />
                <input type='hidden' class='form-control' name='sc[index][status]' value="1" />
                <td> 
                    <select class="mdb-select md-form" name="sc[index][state]">
                      <option value="" disabled selected>Choose your option</option>
                      <option value="1">Ohio</option>
                      <option value="2">Kentucky</option>
                      <option value="3">West Virgina</option>
                    </select>
                 </td>
                 <td>
                    
                    <select class="mdb-select md-form" name="sc[index][certification_level]">
                      <option value="" disabled selected>Choose your option</option>
                      @foreach($cert_level as $row)
                      <option value="{{$row->id}}">{{$row->label}}</option>
                      @endforeach
                    </select>
                 
                </td>
                <td>
                    <div class="md-form">
                        <input placeholder="Expiration" type="date" name="sc[index][expiration]" class='form-control' id="expiration" >
            
                    </div>
                </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='sc[index][cert_number]' placeholder='Certification Number'></div> </td>
            
            </tr>
        </table>
        <input type="button" class="btn btn-primary" onclick="add_row_school();" value="ADD ROW">
        
        

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
            "<input type='hidden' class='form-control' name='sc[index][user_id]' value='450' >"+
            "<input type='hidden' class='form-control' name='sc[index][status]' value='1' >"+
            "<td> <select class='md-form' name='sc[index][state]'> <option value='' disabled selected>Choose your option</option> <option value='1'>Ohio</option> <option value='2'>Kentucky</option> <option value='3'>West Virgina</option> </select> </td>" +
            "<td> <select class='md-form' name='sc[index][certification_level]'> <option value='' disabled selected>Choose your option</option> @foreach($cert_level as $row) <option value='{{$row->id}}'>{{$row->label}}</option> @endforeach </select> </td>" +
             "<td> <div class ='md-form'><input type='date' class='form-control' name='sc[index][expiration]' ></div> </td>" +
            "<td> <div class ='md-form'><input type='text' class='form-control' name='sc[index][cert_number]' placeholder='Certification Number'></div> </td>" +
           
            "<td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></div></td>" +
            "</tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>


@stop

