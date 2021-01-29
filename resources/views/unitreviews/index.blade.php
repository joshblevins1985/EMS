@extends('layouts.app')

@section('page-title', trans('Unit Review'))
@section('page-heading', trans('Unit Review'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')

<!--Panel-->
<div class="card text-center">
    <div class="card-header danger-color white-text">
        <h2>Unit Dash Cam Review</h2>
    </div>
    <div class="row mb-3">
        <a href="/da/export"><button type="button" class="btn btn-primary btn-lg btn-block">Export Current Excell Report</button></a>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-11">
                <form class="form-inline" role="search" method="GET" action="{{url('badrunsheets')}}">
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
                            <option value="1">Uploaded</option>
                            <option value="2">Notified</option>
                            <option value="3">To Billing</option>
                            <option value="4">Completed</option>
                        </select>
                        <label for="status">Search by Status</label>
                    </div>
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </form>
            </div>
            <div class="col-1">
                <a class="btn-floating btn-sm blue-gradient" data-toggle="modal" data-target="#basicExampleModal"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>


<!--/.Panel-->

<!--Panel-->
<div class="card text-center">

    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th>Unit</th>
                <th>Date Requested</th>
                <th>Date Reviewed</th>
                <th>Total Driver Evaluated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @if(count($reviews))
            @foreach($reviews as $row)
            @include('unitreviews.partials.row')
            @endforeach
            @else
            <tr><td colspan=4><h2>No Bad Run Sheets Found</h2></td></tr>
            @endif


            </tbody>
        </table>
    </div>
    {{ $reviews->links() }}
</div>
<!--/.Panel-->

<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Unit to Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form method="POST" action="{{route('unitreview.store')}}">
        {!! Form::token() !!}
            <div class="col-lg-12 col-md-12">
                            <div class="md-form">
                                <select class="mdb-select" id="employee_id" name="unit_id" searchable="Search here..">
                                    <option value="default" disabled selected>Select Unit Reviewed</option>
                                    @foreach($units as $id => $unit)
                                    <option value="{{$unit}}"
                                     
                                        >{{$unit}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('employee_id'))
                                The date field is required.
                                @endif

                            </div>
                        </div>
            
            <div class="col-lg-12 col-md-12">
                            <div class="md-form">
                                <select class="mdb-select" id="employee_id" name="reason_reviewed" searchable="Search here..">
                                    <option value="default" disabled selected>Select Reason Camera Pulled</option>
                                    
                                    <option value="1">
                                        Random Selection
                                    </option>
                                    <option value="2">
                                        New Driver Evaluation
                                    </option>
                                    <option value="">
                                        Complaint Review
                                    </option>
                                
                                </select>
                                

                            </div>
                        </div>  
                        
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
@stop

@section('styles')
<style>
    .btn-link{
  border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color:#0000EE;
  padding:0;
  text-decoration:underline;
  font-family:inherit;
  font-size:inherit;
}
</style>
@stop

@section('scripts')

<script>
    // Data Picker Initialization
    $('.datepicker').pickadate();
</script>
@stop