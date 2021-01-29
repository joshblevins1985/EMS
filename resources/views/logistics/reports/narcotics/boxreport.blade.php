@extends('layouts.app')

@section('page-title', trans('Narcotic Box'))
@section('page-heading', trans('Narcotic Box Info'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

    @include('partials.toastr')

    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <h1>Narcotic Box Report</h1>
        </div>

        <div class="col-sm-12 col-lg-4">
            <table>
                <tr>
                    <td>Date:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Reported By:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Duration:</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <!-- Grid column -->
        <div class="col-lg-12 col-sm-12">

            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Box Information</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Box ID</td>
                            <td></td>
                            <td>Assigned Station</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Assigned Region</td>
                            <td></td>
                            <td>Box Status</td>
                            <td></td>
                        </tr>
                    </table>

                </div>

            </div>


            <!--/.Card-->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <!-- Grid column -->


            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Assignment Log</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Box ID</td>
                            <td></td>
                            <td>Assigned Station</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Assigned Region</td>
                            <td></td>
                            <td>Box Status</td>
                            <td></td>
                        </tr>
                    </table>

                </div>

            </div>

            <!--/.Card-->

        </div>

        <div class="col-sm-12 col-lg-6">
            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Narcotic Vials Assigned</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Box ID</td>
                            <td></td>
                            <td>Assigned Station</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Assigned Region</td>
                            <td></td>
                            <td>Box Status</td>
                            <td></td>
                        </tr>
                    </table>

                </div>

            </div>

            <!--/.Card-->

        </div>
    </div>

    <div class="row">
        <!-- Grid column -->
        <div class="col-lg-12 col-md-12">

            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Box Notes</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Note</th>
                            <th>Employee</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        </tbody>

                    </table>

                </div>

            </div>


            <!--/.Card-->
        </div>
    </div>
@stop

@section('styles')

@stop

@section('scripts')

@stop