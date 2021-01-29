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
    
    <div class="col-lg-3 col-md-4 col-sm-12">
        
        <!--Panel-->
        <div class="card text-center">
            <div class="card-header success-color white-text">
                Narcotic Box Notification
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($narcoticlog as $row)
                    
                    <?php 
                    $checkedout= $row->time_out;
                    $checkedout= strtotime($checkedout);
                    $limit1= strtotime("-24 hours");
                    
                    
                    ?>
                    @if($checkedout <= $limit1 && $row->in_signature === NULL )
                  <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <h5 class="mb-1">{{$row->narcoticbox->box_number}}</h5>
                      <small>Checked out </small>
                    </div>
                    @if(!$row->employees)
                    <p>Employee Information Unavailable</p>
                    @else
                    <br>Checked out greater than 24 hours ago.</br>
                    <p>Checked out by: {{$row->employees->first_name}} {{$row->employees->last_name}}</p>
                    @endif
                  </a>
                  @else
                  
                  @endif
                  @endforeach
                </div>
                
                
            </div>
            <div class="card-footer text-muted success-color white-text">
                <p class="mb-0"></p>
                <a class="white-text" href="{{ route('narcoticbox.index') }}">View All</a>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-12">
        
        <!--Panel-->
        <div class="card text-center">
            <div class="card-header danger-color white-text">
                Narcotic Vial Notification
            </div>
            <div class="card-body">
                <div class="list-group">
                   
                  @foreach($controlled as $row)
                    <?php $expiration = strtotime($row->expiration) ?>
                    @if($expiration < strtotime("now"))
                    
                        <a href="controlled/{{$row->id}}" class="list-group-item list-group-item-action list-group-item-dark flex-column align-items-start">
                            
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">VID: {{sprintf('%08d', $row->id )}} </h5>
                              
                              
                              
                              <small> {{date('m-d-Y', strtotime($row->expiration))}} </small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                              
                              <h6>This vial has became expired. Locate and replace vial.</h6>
                              
                              
                            </div>
                       
                       </a>
                    
                    @elseif($expiration > strtotime("now") && $expiration < strtotime("+ 60 days"))
                        
                        <a href="controlled/{{$row->id}}" class="list-group-item list-group-item-action list-group-item-danger flex-column align-items-start">
                            
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">VID: {{sprintf('%08d', $row->id )}} </h5>
                              <?php
                              

                                $now = time(); // or your date as well
                                $expiration = strtotime($row->expiration);
                                $datediff = $now - $expiration;
                                
                                $days= round($datediff / (60 * 60 * 24 * -1));


                              ?>
                              
                              
                              <small> {{date('m-d-Y', strtotime($row->expiration))}} </small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                              
                              <h6>This vial will expire in {{$days}} days.</h6>
                              
                              
                            </div>
                       
                       </a>
                    
                    @elseif($expiration > strtotime("+ 60 days") && $expiration < strtotime("+ 90 days"))
                        
                        <a href="controlled/{{$row->id}}" class="list-group-item list-group-item-action list-group-item-warning flex-column align-items-start">
                            
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">VID: {{sprintf('%08d', $row->id )}} </h5>
                              <?php
                              

                                $now = time(); // or your date as well
                                $expiration = strtotime($row->expiration);
                                $datediff = $now - $expiration;
                                
                                $days= round($datediff / (60 * 60 * 24 * -1));


                              ?>
                              
                              
                              <small> {{date('m-d-Y', strtotime($row->expiration))}} </small>
                            </div>
                            <div class="d-flex w-100 justify-content-between">
                              
                              <h6>This vial will expire in {{$days}} days.</h6>
                              
                              
                            </div>
                       
                       </a>
                    @endif
                  
                  @endforeach
                   
                  
                 
                </div>
                
                
            </div>
            <div class="card-footer text-muted danger-color white-text">
                <p class="mb-0"></p>
                <a class="white-text" href="{{ route('controlled.index') }}">View All</a>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-12">
        
        <!--Panel-->
        <div class="card text-center">
            <div class="card-header danger-color white-text">
                Out of Service Boxes
            </div>
            <div class="card-body">
                <div class="list-group">
                   
                  @foreach($boxes as $row)
                    
                    @if($row->status == 3)
                    
                        <a href="#" class="list-group-item list-group-item-action list-group-item-danger flex-column align-items-start">
                            
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">Box ID: {{$row->box_number}} </h5>
                              <h6>A drug has been used and needs restocked.</h6>
                              
                            </div>
                       
                       </a>
                    
                    @elseif($row->status == 4)
                        
                        <a href="#" class="list-group-item list-group-item-action list-group-item-dark flex-column align-items-start">
                            
                            <div class="d-flex w-100 justify-content-between">
                              <h5 class="mb-1">Box ID: {{$row->box_number}} </h5>
                              <h6>Administration has placed box Out of Service</h6>
                              
                            </div>
                       
                       </a>
                    
                    @endif
                  
                  @endforeach
                   
                  
                 
                </div>
                
                
            </div>
            <div class="card-footer text-muted danger-color white-text">
                <p class="mb-0"></p>
                <a class="white-text" href="{{ route('narcoticbox.index') }}">View All</a>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    
    <div class="col-lg-3 col-md-4 col-sm-12">
        
        <!--Panel-->
        <div class="card text-center">
            <div class="card-header primary-color white-text">
                Logistic Menu
            </div>
            <div class="card-body">
                <ul class="nav flex-column">
                  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Vial Tracking</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('controlled.index') }}">Medication Vial List</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#basicExampleModal">Add New Medication Vial</a>
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Narcotics Boxes</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('narcoticbox.index') }}">Narcotic Box List</a>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#basicExampleModal2">Create Box Report</a>
                            
                        </div>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Narcotic Logging</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Narcotic Log</a>
                            <a class="dropdown-item" href="#">Search Narcotic Log</a>
                            
                        </div>
                    </li>
                  
                </ul>
                                
                
            </div>
            <div class="card-footer text-muted primary-color white-text">
                <p class="mb-0"></p>
            </div>
        </div>
        <!--/.Panel-->
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Vial of Medication</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'controlled.store', 'id' => 'medication-form']) !!}    
        
            <select class="mdb-select md-form" name="medication">
                <option value="" disabled selected>Choose the medication</option>
                @foreach($rx as $id => $rx)
                <option value="{{$id}}">{{$rx}}</option>
                @endforeach
            </select>
            
            
            <!-- Material input -->
            <div class="md-form">
                <input type="number" id="lot_number" name="lot_number" class="form-control">
                <label for="lot_number" >Lot Number</label>
            </div>
            
            <div class="md-form">
                <input placeholder="Selected date" type="text" id="expiration" name="expiration" class="form-control datepicker">
                <label for="expiration">Expiration Date</label>
            </div>
            
            <div class="md-form">
                <input type="text" id="dose" name="dose" class="form-control">
                <label for="dose" >Available Dose</label>
            </div>
            
            <select class="mdb-select md-form" name="location">
                <option value="" disabled selected>Where is the Medication Located</option>
                @foreach($nb as $id => $nb)
                <option value="{{$id}}">{{$nb}}</option>
                @endforeach
            </select>
            
            
            <select class="mdb-select md-form" name="status">
                <option value="" disabled selected>Current Status of the Medication</option>
                
                <option value="1">Ordered</option>
                <option value="2">Shipping</option>
                <option value="3">Safe</option>
                <option value="4">Box</option>
                <option value="5">Used</option>
                <option value="6">Expired</option>
                <option value="7">Destroyed</option>
                
                
            </select>
            
            
            
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Create Box Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 600px;">
        <form class="form-inline" role="search" method="GET" action="{{url('/boxreport')}}">
                    @csrf
                        
                    

                    
            
            <div class="md-form">
                <input placeholder="Selected date" type="text" id="start" name="start" class="form-control datepicker">
                <label for="expiration">Start Date</label>
            </div>
            
            <div class="md-form">
                <input placeholder="Selected date" type="text" id="end" name="end" class="form-control datepicker">
                <label for="expiration">End Date</label>
            </div>
            
            <select class="mdb-select md-form" name="box">
                <option value="" disabled selected>Where is the Medication Located</option>
                @foreach($nb2 as $id => $nb2)
                <option value="{{$id}}">{{$nb2}}</option>
                @endforeach
            </select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Get Report</button>
        
        </form>
      </div>
    </div>
  </div>
</div>

@stop

@section('styles')

@stop

@section('scripts')

@stop