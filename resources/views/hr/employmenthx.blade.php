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
      <form action="{{ route('application.store_workhx') }}" method="post" enctype="multipart/form-data" class="education_form">
        
          @include('hr.partials.workhx')
          
          <button class="btn btn-primary btn-block my-4" type="submit" >Add Employment History</button>
          @csrf
          {!! Form::close() !!}

</div>


    
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
    function add_row_employment() {
        $rowno = $("#employee_table tr").length;
        $rowno = $rowno + 1;
        $("#employee_table tr:last").after("" +
            "<tr id='row" + $rowno + "'>" +
            
            "<input type='hidden' class='form-control' name='hx[pid][]' value='{{$employee->user_id}}' placeholder='Start Date'>"+
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='hx[start][]' placeholder='Start Date'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='hx[end][]' placeholder='End Date'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='hx[name][]' placeholder='Name'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='hx[address][]' placeholder='Address'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='hx[wage][]' placeholder='Position'></div> </td>" +
            "<td> <div class =\"md-form\"><input type='text' class='form-control' name='hx[leave][]' placeholder='Reason for Leaving'></div> </td>" +
            "<td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></div></td>" +
            "</tr>");
    }

    function delete_row(rowno) {
        $('#' + rowno).remove();
    }
</script>



@stop

