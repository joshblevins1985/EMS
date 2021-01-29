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

    <!--Panel-->
    <div class="card text-center">
        <div class="card-header primary-color white-text">
            <h2>Patient List</h2>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="col-8">
                    <!-- Material input -->
                    <form class="form-inline" role="search" method="GET" action="{{url('patients')}}">
                        @csrf
                        <div class="md-form mb-4 mr-sm-2">
                            <input type="text" class="form-control" id="name" name="name">
                            <label for="name">Search by Last Name</label>
                        </div>

                        <div class="md-form mb-4 mr-sm-2">
                            <input placeholder="Select date" type="text" id="date" name="date" class="form-control datepicker">
                            <label for="date">Search by Date</label>
                        </div>
                        <div class="md-form mb-4 mr-sm-2">
                            <select id="status" name="status" class="mdb-select">
                                <option value="" disabled selected>Choose your option</option>
                                <option value="1">Active</option>
                                <option value="2">Deactive</option>
                                <option value="3">Deceased</option>
                            </select>
                            <label for="status">Search by Status</label>
                        </div>
                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                    </form>

                </div>

                <div class="col-1">

                </div>

                <div class="col-1">


                    <a class="btn-floating btn-sm blue-gradient" href="patients/create"><i class="fa fa-plus"></i></a>

            </div>
        </div>

    </div>
    <!--/.Panel-->

    <!--Panel-->
    <div class="card text-center">

        <div class="card-body">

            <div class="row">
                @foreach($patients as $row)
                    @include('patients.partials.row')
                @endforeach
            </div>




        </div>


    </div>
    <!--/.Panel-->

        {{ $patients->appends(request()->input())->links() }}
@stop

@section('styles')

@stop

@section('scripts')
    <script>
        $("#status").change(function () {
            $("#employee-form").submit();
        });
    </script>
@stop