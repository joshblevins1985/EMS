@extends('layouts.app')

@section('page-title', trans('Controlled Substance'))
@section('page-heading', trans('Vial Info'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')
<div class="row">
    <div class="col-sm-12 col-lg-12">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="text-center no-decoration">
                            <div class="row">
                                <div class="p-3 text-primary flex-1">
                                    <i class="fa fa-medkit fa-3x"></i>
                                </div>

                                <div class="pr-3">
                                    <h2 class="text-right">Vial #</h2>
                                    <div class="text-muted">{{sprintf('%08d', $vl->id )}}</div>
                                </div>
                            </div>

                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="text-center no-decoration">
                            <div class="row">
                                <div class="p-3 text-primary flex-1">
                                    <i class="fa fa-arrow-circle-o-right fa-3x"></i>
                                </div>

                                <div class="pr-3">
                                    <h2 class="text-right">Status</h2>
                                    <div class="text-muted">{{$vl->stat->label}}</div>
                                </div>
                            </div>

                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="text-center no-decoration">
                            <div class="row">
                                <div class="p-3 text-primary flex-1">
                                    <i class="fa fa-id-badge fa-3x"></i>
                                </div>

                                <div class="pr-3">
                                    <h2 class="text-right">Lot Number</h2>
                                    <div class="text-muted">{{$vl->lot_number}}</div>
                                </div>
                            </div>

                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <a href="#" class="text-center no-decoration">
                            <div class="row">
                                <div class="p-3 text-danger flex-1">
                                    <i class="fa fa-calendar-times-o fa-3x"></i>
                                </div>

                                <div class="pr-3">
                                    <h2 class="text-right">Expiration</h2>
                                    <div class="text-muted">{{date('m-d-Y', strtotime($vl->expiration))}}</div>
                                </div>
                            </div>

                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-9">
        <div class="row">
            <h1>Vial History</h1>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Comment</th>
                        <th>Location</th>
                        <th>Employee</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vl->log as $row)
                    <tr>
                        <td>{{$row->stat->label}}</td>
                        <td>{{$row->comment}}</td>
                        <td>{{$row->loc->box_number or 'Unknown'}}</td>
                        <td>{{$row->employee->first_name}} {{$row->employee->last_name}}</td>
                    </tr>           
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-sm-12 col-lg-3">
        <button type="button" class="btn btn-primary btn-rounded" data-toggle="modal" data-target="#basicExampleModal">Change Location</button>
        
        <a href="{{ route('controlled.destroy', $vl->id) }}"
           
           title="@lang('Mark Vial Expired')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="Are you sure you want to mark this vial expired"
           data-confirm-delete="@lang('Yes delete this box.')">
            <button type="button" class="btn btn-danger btn-rounded">Mark Expired</button>
        </a>
        
        @if($vl->status == 6 || $vl->status == 7 || $vl->status == 8 )
        @if(!$vl->waste_form)
        <button type="button" class="btn btn-warning btn-rounded" data-toggle="modal" data-target="#basicExampleModal1">Upload Waste Form</button>
        @else
        <div class="list-group col-12">
          <a href="#" class="list-group-item active waves-light">Available Attachments</a>
          
          <a href="/storage/app/{{$vl->waste_form}}" class="list-group-item waves-effect" download="{{$vl->waste_form}}">Medicaiton Waste Form</a>
          
        </div>
        @endif
        @else
        Vial must be marked used, expired or destroyed prior to waste form being available for upload.
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Medication Location or Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-6">
                            Medication Vial ID
                        </div>
                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-6">
                            Medication
                        </div>
                        <div class="col-lg-6">

                        </div>
                        <div class="col-lg-6">
                            Current Location
                        </div>
                        <div class="col-lg-6">

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('viallog.store') }}" method="POST" >
                            {{csrf_field()}}
                            
                            <input type="hidden" name="id" value="{{$vl->id}}">
                            <div class="form-group">
                                <select class="mdb-select md-form" name="location" required>
                                    <option value="" disabled selected>Where is the New Medication Location</option>
                                    @foreach($nb as $id => $nb)
                                    <option value="{{$id}}">{{$nb}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Must provide a location location for the vial.</div>
                            </div>

                            <div class="form-group">
                                <select class="mdb-select md-form" name="status" required>
                                    <option value="" disabled selected>Current Status of the Medication</option>

                                    @foreach($status as $id => $status)
                                    <option value="{{$id}}">{{$status}}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">Must provide a status for the vial</div>
                            </div>





                            <div class="md-form">
                                <input type="text" id="comment" name="comment" class="form-control">
                                <label for="comment" >Comment</label>
                            </div>




                    </div>
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
</div>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel1">Add New Vial of Medication</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     <form action="/wasteform" method="post" enctype="multipart/form-data">
 
{{ csrf_field() }}
 

 

<input type="hidden" name="pid" value="{{$vl->id}}">
 
<br />
 
<input type="file" class="form-control" name="attachments[]" multiple />
 
<br /><br />
 
<input type="submit" class="btn btn-primary" value="Upload" />
 
</form>
        
      </div>

      </div>
    </div>
  </div>
</div>

@stop

@section('styles')

@stop

@section('scripts')

@stop