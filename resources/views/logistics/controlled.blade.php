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
    @foreach($cs as $row)
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <a href="javascript:{}" onclick="document.getElementById('safe{{$row->id}}').submit(); return false;" class="text-center no-decoration">
                    <div class="row">
                        
                            
                            <div class="p-3 text-primary flex-1">
                                  <div class="icon my-3">
                                <i class="fas fa-medkit fa-2x"></i>
                                </div>
                                <p class="lead mb-0">{{$row->trade_name}}</p>  
                            </div>
                            
                            <div class="pr-5">
                                @foreach($mcount as $count)
                                @if($row->id == $count->medication)
                                <form class="form-inline" id ="safe{{$row->id}}" role="search" method="GET" action="{{url('logistic/safereport')}}">
                                    @csrf
                                    
                                        <input  type="hidden" id="med" name="med" value="{{$row->id}}">
                   
                                </form>
                                  <table>
                                      <tr>
                                          <th>Total</th>
                                          <td>{{$count->count}}</td>
                                      </tr>
                                      <tr>
                                          <th>Safe</th>
                                          <td>{{$count->safe}}</td>
                                      </tr>
                                      <tr>
                                          <th>Box's</th>
                                          <td>{{$count->box}}</td>
                                      </tr>
                                      <tr>
                                          <th>Destroyed</th>
                                          <td>{{$count->destroyed}}</td>
                                      </tr>
                                      @endif
                                      @endforeach
                                  </table> 
                            </div>
                        
                    </div>
                        
                    
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    
    
    <!--Panel-->
<div class="card text-center col-lg-12">
    <div class="card-header primary-color white-text">
        <h2>Company Narcotic Vials</h2>            
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col-12">
                <!-- Material input -->
                <form class="form-inline" role="search" method="GET" action="{{url('controlled')}}">
                    @csrf
                    <!-- Material input -->
                    <div class="md-form">
                      <input type="text" id="vial_number" name="vial_number" class="form-control">
                      <label for="vial_number">Search Vial Number</label>
                    </div>
                    <button class="btn btn-primary" type="submit"><i class="fab fa-searchengin"></i></button>
                </form>

            </div>
            
        </div>
    </div>

</div>
<!--/.Panel-->
</div>

<div class="row">
    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#basicExampleModal">Add New Vial</button>
</div>
<div class="row">
        
    <div class="col-sm-12 col-lg-8">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Vial ID</th>
                    <th>Medication</th>
                    <th>Lot Number</th>
                    <th>NDC #</th>
                    <th>Concentration</th>
                    <th>Expiration</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($medications as $row)
                <tr>
                    <td>{{sprintf('%08d', $row->id )}}</td>
                    <td>{{$row->medications->trade_name}}</td>
                    <td>{{$row->lot_number}}</td>
                    <td>{{$row->ndc_number or ''}}</td>
                    <td>{{$row->dose}}</td>
                    <td>{{date('m-d-Y', strtotime($row->expiration))}}</td>
                    <td>{{$row->locations->box_number ?? 'Unknown'}}</td>
                    <td>
                        @if($row->status == 1)
                            Ordered
                        @elseif($row->status == 2)
                            Shipping
                        @elseif($row->status == 3)
                            Safe
                        @elseif($row->status == 4)
                            Box
                        @elseif($row->status == 5)
                            Station Safe
                        @elseif($row->status == 6)
                            Used
                        @elseif($row->status == 7)
                            Expired
                        @elseif($row->status == 8)
                            Destroyed
                        @elseif($row->status == 9)
                        Tampered
                        @endif
                    </td>
                    <td>
                        @permission('view.rx')
                        <div class="dropdown show d-inline-block">
                <a class="btn btn-icon"
                   href="#" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </a>
    
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
    
                    <a href="controlled/{{$row->id}} " class="dropdown-item text-gray-500">
                        <i class="fas fa-eye mr-2"></i>
                        View Rx Information
                    </a>
                </div>
            </div>
            @endpermission
            
            @permission('edit.rx')
            <a href="controlled/{{$row->id}}/edit "
               class="btn btn-icon edit"
               title="Edit Incident"
               data-toggle="tooltip" data-placement="top">
                <i class="fas fa-edit"></i>
            </a>
            @endpermission
            
            @permission('delete.rx')
            <a href="{{ route('controlled.destroy', $row->id) }}"
               class="btn btn-icon bg-danger"
               title="@lang('Delete Narcotic Box')"
               data-toggle="tooltip"
               data-placement="top"
               data-method="DELETE"
               data-confirm-title="@lang('app.please_confirm')"
               data-confirm-text="Are you sure you want to delete this medication"
               data-confirm-delete="@lang('Yes delete this medication.')">
                <i class="fas fa-trash"></i>
            </a>
            @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{ $medications->links() }}
    </div>
    
    <div class="col-sm-12 col-lg-4">
    
    @if(!$waste)
     <?php $wastecolor = "success"; $message="No Pending Wastes"; ?>
    @else
    <?php $wastecolor = "danger"; ?>
    @endif
        <!--Panel-->
    <div class="card text-center">
    <div class=" card-header {{$wastecolor}}-color white-text">
      <h2>Pending Narcotic Waste Forms</h2>
    </div>
    <div class="card-body">
      <div class="list-group">
          @foreach($waste as $row)
          <a href="narcoticwaste/{{$row->id}}/edit" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1">{{$row->boxinfo->box_number}}</h5>
              <small>{{date('m-d-Y', strtotime($row->created_at))}}</small>
            </div>
            <p class="mb-1">{{$row->employee->first_name}} {{$row->employee->last_name}} has used Vial ID number {{sprintf('%08d', $row->vial->id )}} - {{$row->vial->medications->trade_name}}</p>
            
          </a>
          @endforeach
        </div>
    </div>
    <div class="card-footer text-muted {{$wastecolor}}-color white-text">
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
         <form onsubmit="return confirm('Confirm the quanity of medication you are entering?');" action="{{ route('controlled.store') }}" method="POST" >
            {{csrf_field()}}   
        
            <div class="md-form">
                <input type="number" value="1" id="run" name="run" class="form-control">
                <label for="run" >Total Number of Vials to Add</label>
            </div>
            
            <select class="mdb-select md-form" name="medication">
                <option value="" disabled selected>Choose the medication</option>
                @foreach($rx as $id => $rx)
                <option value="{{$id}}">{{$rx}}</option>
                @endforeach
            </select>
            
            <div class="md-form">
                <input type="text" id="ndc_number" name="ndc_number" class="form-control">
                <label for="ndc_number" >NDC Number</label>
            </div>
            
            <!-- Material input -->
            <div class="md-form">
                <input type="text" id="lot_number" name="lot_number" class="form-control">
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
                
                @foreach($status as $id => $status)
                <option value="{{$id}}">{{$status}}</option>
                @endforeach
                
            </select>
            
            <div class="md-form">
                <input type="text" id="comment" name="comment" class="form-control" required>
                <label for="comment" >Comment</label>
            </div>
            
            
            
        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
        <button type="submit" class="btn btn-primary">Add New Controlled Substance</button>
        
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