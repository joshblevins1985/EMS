@extends('layouts.app')

@section('page-title', trans('Instructed Class'))
@section('page-heading', trans('Instructed Class'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.toastr')

    <div class="row">

        <div class="col-lg-10 col-sm-12">
            <div class="row">
                <!--Card-->
                <div class="card">
                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <h3 class="card-title">{{ $facility->name  }}</h3>
                        <!--Text-->
                        <div class="col-lg-12">
                            <strong>{{ $facility->house_number  }} {{ $facility->address  }} {{ $facility->city  }} {{ $facility->state  }} {{ $facility->zip  }}</strong>
                        </div>

                        <div class="col-lg-12">
                            @if($facility->contracted == 1) <strong style="color: darkred;">This is a contracted facility</strong> @endif
                        </div>
                    </div>

                </div>
                <!--/.Card-->
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <!--Panel-->
                    <div class="card text-center">
                    <div class=" card-header elegant-color white-text">
                        Contact Information
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a href="#!" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-2 h5"><strong>Department</strong</h5>
                                    <small>(740) 821 - 5531</small>
                                </div>
                                <p class="mb-2"></p>
                                <small>Employee Name</small>
                            </a>

                        </div>
                    </div>
                    <div class="card-footer text-muted elegant-color white-text">
                        <p class="mb-0"></p>
                    </div>
                </div>
                <!--/.Panel-->
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <button type="button" class="btn btn-info btn-rounded">Add Contact Information</button>
        </div>

    </div>


@stop

@section('styles')

@stop

@section('scripts')



@stop