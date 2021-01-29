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

<form  action="{{ route('qaqi.store') }}" id="qa-form" method="POST" enctype="multipart/form-data" >
                        {{csrf_field()}}

@include('education.partials.qaform')
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
            $("#employee_table tr:last").after("<tr id='row"+$rowno+"'><td><div class='md-form'><input type='text' class='form-control' name='deficiencies[]' placeholder='Describe Deficiency'></td><td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row"+$rowno+"')></div></td></tr>");
        }
        function delete_row(rowno)
        {
            $('#'+rowno).remove();
        }
    </script>
    {!! HTML::script('public/assets/js/as/login.js') !!}
    
     {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\QaRequest', '#qa-form') !!}

@stop