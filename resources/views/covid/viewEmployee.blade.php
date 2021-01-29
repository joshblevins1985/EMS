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
        <li class="breadcrumb-item"><a href="javascript:;">COVID-19 Exposure {{strtoupper($exposure->employee->first_name)}} {{strtoupper($exposure->employee->last_name)}}</a></li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">COVID-19 Exposure Management {{strtoupper($exposure->employee->first_name)}} {{strtoupper($exposure->employee->last_name)}}</h1>
    <!-- end page-header -->

    <div class="row mb-2">
        <div class="col-xl-7">
            <div class="row">
                <table class="table table-borderless">
                    <tr>
                        <td>Employee Name</td>
                        <td>{{strtoupper($exposure->employee->first_name)}} {{strtoupper($exposure->employee->last_name)}}</td>
                    </tr>
                    <tr>
                        <td>Employee Phone Number</td>
                        <td>   {{ '('.substr($exposure->employee->phone_mobile, 0, 3).') '.substr($exposure->employee->phone_mobile, 3, 3).'-'.substr($exposure->employee->phone_mobile,6)  }} </td>
                    </tr>
                    <tr>
                        <td>Follow Up Email Info Sent</td>
                        <td>{{$exposure->follow_up ? Carbon\Carbon::parse($exposure->follow_up)->format('m-d-Y') : 'Pending'}}</td>
                    </tr>
                    <tr>
                        <td>Patient Exposed</td>
                        <td>{{$exposure->patient->patient_name ?? 'Error'}}</td>
                    </tr>
                    <tr>
                        <td>Pick Up Location</td>
                        <td>{{$exposure->patient->pick_up}}</td>
                    </tr>
                    <tr>
                        <td>Drop Off Location</td>
                        <td>{{ $exposure->patient->drop_off }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-xl-5">
            <div class="card bg-dark" >

                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td>Was employee exposed?</td>
                            <td>
                                <div class="col-xl-12">
                                @if($exposure->exposed == 0)
                                Negative Exposure <span class="pull-right"> <a href="javascript:;"><i class="far fa-edit" id="edit_edit_form"></i></a> </span>
                                @elseif($exposure->exposed == 1)
                                Unknown<span class="pull-right"> <a href="javascript:;"><i class="far fa-edit" id="edit_edit_form"></i></a> </span>
                                @elseif($exposure->exposed == 2)
                                Possible <span class="pull-right"> <a href="javascript:;"><i class="far fa-edit" id="edit_edit_form"></i></a> </span>
                                @elseif($exposure->exposed == 3)
                                    Not Applicable <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_edit_form"></i></a> </span>
                                @elseif($exposure->exposed == 4)
                                Positive Exposure <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_edit_form"></i></a> </span>
                                @endif
                                </div>

                                <div class="col-xl-12" id="exposed_form">
                                    <form action="/updateEmployeExposure/{{$exposure->id}}" id="exposed" method="POST">
                                        @csrf

                                        <div class="col-lg-12">
                                            <select select class="select2 form-control"  name="exposed" data-parsley-required="true">

                                                <option value="0" @if($exposure->exposed == 0) selected @endif>Negetive Exposure</option>
                                                <option value="1" @if($exposure->exposed == 1) selected @endif>Unknown</option>
                                                <option value="2" @if($exposure->exposed == 2) selected @endif>Possible</option>
                                                <option value="3" @if($exposure->exposed == 3) selected @endif>Not Applicable</option>
                                                <option value="4" @if($exposure->exposed == 4) selected @endif>Positive Exposure</option>
                                            </select>

                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Did employee wear a gown?</td>
                            <td>
                                <div class="col-xl-12">
                                @if($exposure->gown == 0)
                                    No <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gown_form"></i></a> </span>
                                @elseif($exposure->gown == 1)
                                    Unknown <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gown_form"></i></a> </span>
                                @elseif($exposure->gown == 2)
                                    Possible <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gown_form"></i></a> </span>
                                @elseif($exposure->gown == 3)
                                    Not Applicable <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gown_form"></i></a> </span>
                                @elseif($exposure->gown == 4)
                                    Yes <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gown_form"></i></a> </span>
                                @endif
                                </div>
                                <div class="col-xl-12" id="gown_form">
                                    <form action="/updateEmployeExposure/{{$exposure->id}}" id="exposed" method="POST">
                                        @csrf

                                        <div class="col-lg-12">
                                            <select select class="select2 form-control"  name="gown" data-parsley-required="true">

                                                <option value="0" @if($exposure->gown == 0) selected @endif>No</option>
                                                <option value="1" @if($exposure->gown == 1) selected @endif>Unknown</option>
                                                <option value="2" @if($exposure->gown == 2) selected @endif>Possible</option>
                                                <option value="3" @if($exposure->gown == 3) selected @endif>Not Applicable</option>
                                                <option value="4" @if($exposure->gown == 4) selected @endif>Yes</option>
                                            </select>

                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Did employee wear a mask?</td>
                            <td>
                                <div class="col-xl-12">
                                @if($exposure->mask == 0)
                                    No <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_mask_form"></i></a> </span>
                                @elseif($exposure->mask == 1)
                                    Unknown <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_mask_form"></i></a> </span>
                                @elseif($exposure->mask == 2)
                                    Possible <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_mask_form"></i></a> </span>
                                @elseif($exposure->mask == 3)
                                    Not Applicable <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_mask_form"></i></a> </span>
                                @elseif($exposure->mask == 4)
                                    Yes <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_mask_form"></i></a> </span>
                                @endif
                                </div>

                                <div class="col-xl-12" id="mask_form">
                                    <form action="/updateEmployeExposure/{{$exposure->id}}" id="exposed" method="POST">
                                        @csrf

                                        <div class="col-lg-12">
                                            <select select class="select2 form-control"  name="mask" data-parsley-required="true">

                                                <option value="0" @if($exposure->mask == 0) selected @endif>No</option>
                                                <option value="1" @if($exposure->mask == 1) selected @endif>Unknown</option>
                                                <option value="2" @if($exposure->mask == 2) selected @endif>Possible</option>
                                                <option value="3" @if($exposure->mask == 3) selected @endif>Not Applicable</option>
                                                <option value="4" @if($exposure->mask == 4) selected @endif>Yes</option>
                                            </select>

                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Did employee wear goggles?</td>
                            <td>
                                <div class="col-xl-12">
                                @if($exposure->goggles == 0)
                                    No <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_goggles_form"></i></a> </span>
                                @elseif($exposure->goggles == 1)
                                    Unknown <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_goggles_form"></i></a> </span>
                                @elseif($exposure->goggles == 2)
                                    Possible <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_goggles_form"></i></a> </span>
                                @elseif($exposure->goggles == 3)
                                    Not Applicable <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_goggles_form"></i></a> </span>
                                @elseif($exposure->goggles == 4)
                                    Yes <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_goggles_form"></i></a> </span>
                                @endif
                                </div>

                                <div class="col-xl-12" id="goggles_form">
                                    <form action="/updateEmployeExposure/{{$exposure->id}}" id="exposed" method="POST">
                                        @csrf

                                        <div class="col-lg-7">
                                            <select select class="select2 form-control"  name="goggles" data-parsley-required="true">

                                                <option value="0" @if($exposure->goggles == 0) selected @endif>No</option>
                                                <option value="1" @if($exposure->goggles == 1) selected @endif>Unknown</option>
                                                <option value="2" @if($exposure->goggles == 2) selected @endif>Possible</option>
                                                <option value="3" @if($exposure->goggles == 3) selected @endif>Not Applicable</option>
                                                <option value="4" @if($exposure->goggles == 4) selected @endif>Yes</option>
                                            </select>

                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Did employee wear gloves?</td>
                            <td>
                                <div class="col-xl-12">
                                @if($exposure->gloves == 0)
                                    No <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gloves_form"></i></a> </span>
                                @elseif($exposure->gloves == 1)
                                    Unknown <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gloves_form"></i></a> </span>
                                @elseif($exposure->gloves == 2)
                                    Possible <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gloves_form"></i></a> </span>
                                @elseif($exposure->gloves == 3)
                                    Not Applicable <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gloves_form"></i></a> </span>
                                @elseif($exposure->gloves == 4)
                                    Yes <span class="pull-right" > <a href="javascript:;"><i class="far fa-edit" id="edit_gloves_form"></i></a> </span>
                                @endif
                                </div>

                                <div class="col-xl-12" id="gloves_form">
                                    <form action="/updateEmployeExposure/{{$exposure->id}}" id="exposed" method="POST">
                                        @csrf

                                        <div class="col-lg-7">
                                            <select select class="select2 form-control"  name="gloves" data-parsley-required="true">

                                                <option value="0" @if($exposure->gloves == 0) selected @endif>No</option>
                                                <option value="1" @if($exposure->gloves == 1) selected @endif>Unknown</option>
                                                <option value="2" @if($exposure->gloves == 2) selected @endif>Possible</option>
                                                <option value="3" @if($exposure->gloves == 3) selected @endif>Not Applicable</option>
                                                <option value="4" @if($exposure->gloves == 4) selected @endif>Yes</option>
                                            </select>

                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-2">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="page-header mb-3">EMPLOYEE COVID-19 NOTES</h1>
                    <span class="pull-right"><button type="button" class="btn btn-light" data-toggle="modal" data-target="#modalExposureNote"><i class="far fa-notes-medical"></i> Add Note</button></span>
                </div>
                <div class="body">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <td>Date Added</td>
                            <td>Comments</td>
                            <td>Added By</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($exposure->notes as $note)
                        <tr>
                        <td>{{Carbon\Carbon::parse($note->created_at)->format('m-d-Y H:i')}}</td>
                        <td>{!! $note->comment !!}</td>
                        <td>{{$note->employee->first_name ?? 'Error'}} {{$note->employee->last_name}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection

@include('covid.partials.modalNewExposureNote')

@push('scripts')
    <script src="assets/plugins/select2/dist/js/select2.min.js"></script>

    <script>
        $( document ).ready(function() {
            $('#exposed_form').hide();
            $('#gown_form').hide();
            $('#mask_form').hide();
            $('#goggles_form').hide();
            $('#gloves_form').hide();

        });

        $( "#edit_edit_form" ).click(function() {
            $('#exposed_form').show();
        });

        $( "#edit_gown_form" ).click(function() {
            $('#gown_form').show();
        });
        $( "#edit_mask_form" ).click(function() {
            $('#mask_form').show();
        });
        $( "#edit_goggles_form" ).click(function() {
            $('#goggles_form').show();
        });
        $( "#edit_gloves_form" ).click(function() {
            $('#gloves_form').show();
        });


        $( ".select2" ).change(function() {
            $(this).closest("form").submit();
        });
    </script>


    <script>
        var handleSelect2 = function() {
            $(".select2").select2();
        };

        var FormPlugins = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleSelect2();
                }
            };
        }();
    </script>


    <script src="/assets/plugins/ckeditor/ckeditor.js"></script>
    <script src="/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="/assets/js/demo/form-wysiwyg.demo.js"></script>





@endpush
