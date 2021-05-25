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
    <div class="col-12">
        <table class='table'>
            <thead>
                <tr>
                    @foreach($stationlist as $list)
                    <th class="text-center">{{$list->station}}</th>
                    @endforeach
                </tr>
                <tr>
                    @foreach($stationlist as $list)
                    @foreach($scount as $td)
                    
                    @if($td->station == $list->id )
                        <td class="text-center">{{$td->count}}</td>
                    
                    @endif
                    
                    @endforeach
                    @endforeach
                </tr>
            </thead>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-primary flex-1">
                        <i class="fas fa-medkit fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">
                            @foreach($bcount as $count)
                                    @if($count->status == 1)
                                     {{$count->count}}
                                    @endif
                                @endforeach
                            </h2>
                        <div class="text-muted">Total Boxes Secured</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-primary flex-1">
                        <i class="fas fa-medkit fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">
                            @foreach($bcount as $count)
                                    @if($count->status == 2)
                                     {{$count->count}}
                                    @endif
                                @endforeach
                            </h2>
                        <div class="text-muted">Total Boxes Signed Out</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-primary flex-1">
                        <i class="fas fa-medkit fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">
                            @foreach($bcount as $count)
                                    @if($count->status == 3)
                                     {{$count->count}}
                                    @endif
                                @endforeach
                            </h2>
                        <div class="text-muted">Total Boxes Used</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="p-3 text-primary flex-1">
                        <i class="fas fa-medkit fa-3x"></i>
                    </div>

                    <div class="pr-3">
                        <h2 class="text-right">
                            @foreach($bcount as $count)
                                    @if($count->status == 4)
                                     {{$count->count}}
                                    @endif
                                @endforeach
                            </h2>
                        <div class="text-muted">Total Boxes Secured</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<div class="row">
    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect" data-toggle="modal" data-target="#basicExampleModal">Add New Narcotic Box</button>
</div>
<div class="row">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Box Number</th>
                <th>Station</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($boxes as $row)
            <tr>
                <td>{{$row->box_number}}</td>
                <td>@if(!$row->boxstations) Unknown Station @else {{$row->boxstations->station}} @endif</td>
                <td>
                    @if($row->status == 1)
                        Secured
                    @elseif($row->status == 2)
                        Checked Out
                    @elseif($row->status == 3)
                        Used - OOS
                    @elseif($row->status == 4)
                        ADMIN -- OOS
                    @else
                    
                    @endif
                </td>
                <td>
                    @permission('view.narcoticbox')
                    <div class="dropdown show d-inline-block">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                <a href="narcoticbox/{{$row->id}} " class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    View Box Information
                </a>
            </div>
        </div>
        @endpermission
        
        @permission('edit.narcoticbox')
        <a href="narcoticbox/{{$row->id}}/edit "
           class="btn btn-icon edit"
           title="Edit Incident"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>
        @endpermission
        
        @permission('delete.narcoticbox')
        <a href="{{ route('narcoticbox.destroy', $row->id) }}"
           class="btn btn-icon bg-danger"
           title="@lang('Delete Narcotic Box')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="Are you sure you want to delete this box"
           data-confirm-delete="@lang('Yes delete this box.')">
            <i class="fas fa-trash"></i>
        </a>
        @endpermission
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $boxes->links() }}
</div>


<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Narcotic Box</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {!! Form::open(['route' => 'narcoticbox.store', 'id' => 'medication-form']) !!}    
            
                        
            <select class="mdb-select md-form" name="station">
                <option value="" disabled selected>Select Station</option>
                 @foreach($station as $id => $station)
                <option value="{{$id}}">{{$station}}</option>
                @endforeach
            </select>
            
            <!-- Material input -->
            <div class="md-form">
                <input type="text" id="box_number" name="box_number" class="form-control">
                <label for="box_number" >Box Number</label>
            </div>
            
            <div class="md-form">
                <input type="text" id="seal" name="seal" class="form-control">
                <label for="seal" >Box Seal</label>
            </div>
            
            <div class="md-form">
                <input type="text" id="tamper_seal" name="tamper_seal" class="form-control">
                <label for="tamper_seal" >Tamper Seal</label>
            </div>
            
            <select class="mdb-select md-form" name="status">
                <option value="" disabled selected>Select Box Status</option>
                 
                <option value="1">Secured</option>
                <option value="2">Checked Out</option>
                <option value="3">Used -- OOS</option>
                <option value="4">ADMIN -- OOS</option>
                
            </select>
            
            <div class="md-form">
                <input type="text" id="rfid" name="rfid" class="form-control">
                <label for="rfid" >RFID Scan</label>
            </div>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>



@stop

@section('styles')

@stop

@section('scripts')
<script>
    document.getElementById("medication-form").onkeypress = function(e) {
  var key = e.charCode || e.keyCode || 0;     
  if (key == 13) {
    e.preventDefault();
  }
}

</script>
@stop