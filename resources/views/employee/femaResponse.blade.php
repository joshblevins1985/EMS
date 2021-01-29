@extends('layouts.sidebar-fixed')

@section('page-title', 'Employee List')
@section('page-heading', 'Employee List')
@push('css')
    <link href="/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
    <link href="/assets/plugins/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" />
@endpush

@section('content')

    @include('partials.toastr')

    <!--Panel-->
    <div class="card text-center">
        <div class="card-header primary-color white-text">
            <h2>Response Team Employees</h2>
        </div>
        <div class="card-body mb-4">
            <div class="row">

                <div class="col-8">
                    <!-- Material input -->
                    <form class="form-inline" role="search" method="GET" action="{{url('employees')}}">
                        @csrf
                        <div class="mb-4 mr-sm-2">
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="name">Search by Last Name</label>
                        </div>

                        <div class="mb-4 mr-sm-2">
                            <input placeholder="Select date" type="text" id="date" name="date"
                                   class="form-control datepicker">
                            <label for="date">Search by Date</label>
                        </div>
                        <div class="mb-4 mr-sm-2">

                            <select id="status" name="status" class="select2"  style="width:100%">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="1">Applicants</option>
                                <option value="2">Pre-Hire</option>
                                <option value="3">Orientation</option>
                                <option value="4">Field Training</option>
                                <option value="5">Active</option>
                                <option value="6">FMLA</option>
                                <option value="7">Workers Comp</option>
                                <option value="8">Terminated</option>
                            </select>
                            <label for="status">Search by Status</label>
                        </div>

                        <div class="mb-4 mr-sm-2">

                            <button type="submit" class="btn btn-primary" type="submit">Search
                            </button>

                        </div>


                    </form>

                </div>

                <div class="col-1">
                    <a href="{{ route('employee.excel') }}" class="btn btn-success">Export to Excel</a>
                </div>

                <div class="col-1">

                    @permission('employee.add')
                    <a class="btn-floating btn-sm blue-gradient" href="employees/create"><i class="fa fa-plus"></i></a>
                    @endpermission
                </div>
            </div>
        </div>

    </div>
    <!--/.Panel-->

    <!--Panel-->
    <div class="card text-center">

        <div class="card-body">

            <div class="row">
                <table id="data-table-buttons" class="table table-striped table-td-valign-middle">
                    <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>EMS Cert</th>
                        <th>Drive Lic</th>
                        <th>EVOC</th>
                        <th>HEB-B</th>
                        <th>NIM 100</th>
                        <th>NIM 700</th>
                        <th>NIM 800</th>
                        <th>Hazmat</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        @include('employee.partials.rowFema')
                    </tbody>
                </table>
            </div>


        </div>
        {{ $employees->appends(request()->input())->links() }}

    </div>
    <!--/.Panel-->
@stop

@push('scripts')
    <script src="/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/assets/plugins/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/assets/plugins/pdfmake/build/pdfmake.min.js"></script>
    <script src="/assets/plugins/pdfmake/build/vfs_fonts.js"></script>
    <script src="/assets/plugins/jszip/dist/jszip.min.js"></script>
    <script src="/assets/js/demo/table-manage-buttons.demo.js"></script>
@endpush