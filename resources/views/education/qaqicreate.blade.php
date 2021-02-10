@extends('layouts.sidebar-fixed')

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

@push('styles')
    <link rel="stylesheet" href="/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css" ></link>
    <link rel="stylesheet" href="/assets/plugins/ckeditor/custom.css" type="text/css">
@endpush

@push('scripts')
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

    <!-- Laravel Javascript Validation -->
    <script type="text/javascript" src="{{ url('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\QaRequest', '#qa-form', '#qa-form') !!}

    <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/85rtiygd4xnqpm04vzi7623vl2s06d1nn8xiza93ocp7ehw0/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="/assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js" ></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>


    <script>
        $('.datepicker').datepicker({
            format: 'mm/dd/yyyy',
        });
    </script>

    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endpush