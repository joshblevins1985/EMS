@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Create Employee')
    </li>
@stop

@section('content')

@include('partials.toastr')

<div class ="row">
    <h1>{{$rc->label}} Competency Report {{$station->station}}</h1>
</div>

<div class="row">
    <div class="col-lg-6">
        <!-- Card -->

        <!-- Card -->
        <div class="card card-cascade wider">
        
          <!-- Card image -->
          <div class="view view-cascade gradient-card-header peach-gradient">
        
            <!-- Title -->
            <h2 class="card-header-title mb-3">Employees Completed</h2>
            
          </div>
        
          <!-- Card content -->
          <div class="card-body card-body-cascade text-center">
        
            <!-- Text -->
            <ul class="list-group">
                @foreach($completed as $row)
              <li class="list-group-item">{{$row->first_name}} {{$row->last_name}}</li>
                @endforeach
            </ul>
            <!-- Link -->
            <a href="#!" class="orange-text d-flex flex-row-reverse p-2">
              <h5 class="waves-effect waves-light">Read more<i class="fas fa-angle-double-right ml-2"></i></h5>
            </a>
        
          </div>
          <!-- Card content -->
        
        </div>
        <!-- Card -->
    </div>
    
    <div class="col-lg-6">
        <!-- Card -->

        <!-- Card -->
        <div class="card card-cascade wider">
        
          <!-- Card image -->
          <div class="view view-cascade gradient-card-header peach-gradient">
        
            <!-- Title -->
            <h2 class="card-header-title mb-3">Employees Pending Completion</h2>
            
          </div>
        
          <!-- Card content -->
          <div class="card-body card-body-cascade text-center">
        
            <!-- Text -->
            <ul class="list-group">
                @foreach($incomplete as $row)
              <li class="list-group-item">{{$row->first_name}} {{$row->last_name}}</li>
                @endforeach
            </ul>
            <!-- Link -->
            <a href="#!" class="orange-text d-flex flex-row-reverse p-2">
              <h5 class="waves-effect waves-light">Read more<i class="fas fa-angle-double-right ml-2"></i></h5>
            </a>
        
          </div>
          <!-- Card content -->
        
        </div>
        <!-- Card -->
    </div>
</div>
    

@stop

@section('styles')

@stop
 
@section('scripts')

@stop