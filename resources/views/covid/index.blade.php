@extends('layouts.default')

@section('title', 'COVID-19 EXPOSURE')

@push('css')

    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
@endpush

@section('content')
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">COVID-19 Exposure Dashboard</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">COVID-19 Exposure Management </h1>
    <!-- end page-header -->

    <div class="row mb-2">
        <div class="pull-right">
            <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#myModal"> <i class="fad fa-plus-circle"></i> Add New Exposure</button>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            @include('covid.partials.tableIndex')
        </div>
    </div>


@endsection

@include('covid.partials.modalNewExposure')
@include('covid.partials.modalUpdatePatient')

@push('scripts')
    <script src="assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
    <script src="assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
    <script src="/assets/plugins/highlight.js/highlight.min.js"></script>
    <script src="/assets/js/demo/render.highlight.js"></script>


    <script>
        var handleDataTableDefault = function() {
            "use strict";

            if ($('#data-table-default').length !== 0) {
                $('#data-table-default').DataTable({
                    responsive: true
                });
            }
        };

        var handleSelect2 = function() {
            $(".default-select1").select2();
            $(".default-select2").select2();
            $(".default-select3").select2();
            $(".default-select4").select2();
            $(".default-select5").select2();
            $('#datepicker-default').datepicker({
                todayHighlight: true
            });
            $('#datepicker-default2').datepicker({
                todayHighlight: true
            });
            $(".multiple-select2").select2({ placeholder: "Select All Employees Affected" });
        };

        var TableManageDefault = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDataTableDefault();
                }
            };
        }();

        var FormPlugins = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleSelect2();
                }
            };
        }();

        $(document).ready(function() {
            FormPlugins.init();
        });

        $(document).ready(function() {
            TableManageDefault.init();
        });
    </script>
    <script>
        $('#modalUpdatePatient').on('show.bs.modal', function(e) {
            var patientId = $(e.relatedTarget).data('patientid');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            // AJAX request
            $.ajax({
                url: '/updatePatient/modal/' + patientId,
                type: 'get',
                data: {},
                success: function(response){
                    // Add response in Modal body
                    $('#updatePatientBody').html(response);

                }
            });

        });
    </script>

@endpush
