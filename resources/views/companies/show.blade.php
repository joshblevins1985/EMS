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

<div class="row">
    <div class="col-md-8">
        <!-- Card -->
        <div class="card card-cascade">

            <!-- Card image -->
            <div class="view view-cascade gradient-card-header blue-gradient">

                <!-- Title -->
                <h2 class="card-header-title mb-3">{{$companies->name}}</h2>


            </div>

            <!-- Card content -->
            <div class="card-body card-body-cascade text-center">

                <!-- Text -->
                <div class="col-md-8">
                    <div class="col">
                        <p><strong>Phone:</strong> {{$companies->phone}}</p>
                        <p><strong>Email:</strong> {{$companies->email}}</p>
                        <address>{{$companies->street_number}} {{$companies->route}} <br> {{$companies->locality}}, {{$companies->state}} {{$companies->postal_code}}</address>
                    </div>
                </div>
                
            </div>

        </div>
    </div>
    <div class="col-md-4" style="max-height: 600px;">
        <!-- Card -->
        <div class="card card-cascade">

            <!-- Card image -->
            <div class="view view-cascade gradient-card-header blue-gradient">

                <!-- Title -->
                <h2 class="card-header-title mb-3">Employees</h2>


            </div>
<div class="col-md-12 scroll" style="max-height: 600px;">
            <!-- Card content -->
            <div class="card-body card-body-cascade text-center">

                <!-- Text -->


                <div class="list-group">
                @foreach($companies->employees as $employee)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><strong>{{$employee->last_name}}, {{$employee->first_name}}</strong></h5>

                        </div>
                        <p class="mb-1">Employee Primary Position</p>
                        <small class="text-muted">Phone</small>
                    </a>
                    <hr>
                @endforeach
                </div>
</div>


            </div>

        </div>
    </div>
</div>

@stop

@section('styles')
<style>
  .scroll {
    max-height: 100px;
    overflow-y: auto;  
</style>

}
@stop

@section('scripts')


@stop