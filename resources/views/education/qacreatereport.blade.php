@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.toastr')

                <form class="form-inline" role="search" method="GET" action="{{url('qa/report')}}">
                    @csrf
                    
                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="start" name="start" class="form-control datepicker">
                        <label for="date">Enter Start Date</label>
                    </div>
                    <div class="md-form mb-4 mr-sm-2">
                        <input placeholder="Select date" type="text" id="end" name="end" class="form-control datepicker">
                        <label for="date">Enter End Date</label>
                    </div>
                    
                    <button class="btn btn-default" type="submit">Search</button>
                </form>

   
@stop

@section('styles')

@stop

@section('scripts')
    <script type="text/javascript">
        function add_row()
        {
            $rowno=$("#employee_table tr").length;
            $rowno=$rowno+1;
            $("#employee_table tr:last").after("<tr id='row"+$rowno+"'><td><input type='text' class='form-control' name='deficiencies[]' placeholder='Describe Deficiency'></td><td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row"+$rowno+"')></td></tr>");
        }
        function delete_row(rowno)
        {
            $('#'+rowno).remove();
        }
    </script>

@stop