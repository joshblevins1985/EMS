@extends('layouts.app')

@section('page-title', trans('Camera Review'))
@section('page-heading', trans('Camera Review'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Unit Camera Review')
</li>
@stop

@section('content')

@include('partials.toastr')

<div class="row">
    <div class="col-lg-8 col-md-12">

        <div class="card">
            <!--Card content-->
            <div class="card-body">
                <!--Title-->
                <h4 class="card-title">Drive Camera Review </h4>
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class="card widget">
                            <div class="card-body">
                                <div class="row">
                                    <div class="p-3 text-primary flex-1">
                                        <i class="fa fa-ambulance fa-3x"></i>
                                    </div>

                                    <div class="pr-3">
                                        <h2 class="text-right">{{$review->unit->unit_number}}</h2>
                                        <div class="text-muted">Unit Number</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="card widget">
                            <div class="card-body">
                                <div class="row">
                                    <div class="p-3 text-primary flex-1">
                                        <i class="fas fa-warehouse fa-3x"></i>
                                    </div>

                                    <div class="pr-3">
                                        <h2 class="text-right"></h2>
                                        <div class="text-muted">Unit Station</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <!--/.Card-->
    </div>
    <div class="col-lg-4 col-md-12">
        <!--Panel-->
        <div class="card text-center">
            <div class=" card-header success-color white-text">
                Featured
            </div>
            <div class="card-body">
                <h4 class="card-title">Drive Camera Menu</h4>
                <div class="list-group">
                    <a data-toggle="modal" data-target="#reviewFormModal"
                       class="list-group-item list-group-item-action">
                        Add New Review
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">Print Report</a>

                </div>
            </div>
            <div class="card-footer text-muted success-color white-text">
                <p class="mb-0">2 days ago</p>
            </div>
        </div>
        <!--/.Panel-->
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="card">
            <!--Card content-->
            <div class="card-body">
                <!--Title-->
                <h4 class="card-title">Driver Camera Reviews </h4>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date Reviewed</th>
                            <th>Driver</th>
                            <th>Total Time</th>
                            <th>Score</th>
                            <th>Comments</th>
                            <th>View Review</th>
                            <th>Print Review</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($review->driver_assessments)
                            @foreach($review->driver_assessments as $dr)
                        <tr>
                            <td>{{date('m-d-Y', strtotime($dr->date_of_evaluation))}}</td>
                            <td>{{$dr->employee->first_name}} {{$dr->employee->last_name}}</td>
                            <td>{{$dr->total_time}} min</td>
                            <td>{{round($dr->performance_rating)}} %</td>
                            <td>{!!$dr->comments!!}</td>
                            <td><a href="/driveassessment/{{$dr->id}}">View Report</a></td>
                            <td><a href="/da/pdf/{{$dr->id}}">Export to PDF</a></td>
                            
                        </tr>
                        
                        @endforeach
                        @else
                        
                        @endif
                        
                    </tbody>
                </table>


            </div>

        </div>
        <!--/.Card-->
    </div>
</div>


<!-- Modal -->
<div class="modal fade top" id="reviewFormModal" tabindex="-1" role="dialog" aria-labelledby="reviewFormLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fluid modal-full-height modal-top" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reviewFormLabel">Camera Review Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('driveassessment.store') }}" method="post" enctype="multipart/form-data">
                
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-lg-4 col-md-12">

                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="md-form">
                                <select class="mdb-select" id="employee_id" name="unit" searchable="Search here..">
                                    <option value="default" disabled selected>Select Unit Reviewed</option>
                                    @foreach($units as $id => $unit)
                                    <option value="{{$id}}"
                                            
                                            @if($review->unit->id == $id)
                                        selected
                                        @else
                                        @if(old('unit') == $id) selected @endif
                                        @endif
                                        >{{$unit}}
                                    </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('employee_id'))
                                The date field is required.
                                @endif

                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="md-form">
                                <input placeholder="Date of Review" type="text" id="date" name="date"
                                       class="form-control datepicker" value="">
                                <label for="doi">Date of Run</label>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2 col-md-12">
                            <div>Start Time</div>
                           <div class="md-form">
                                <input placeholder="Date being reviewed" type="text" id="date_review" name="date_review"
                                       class="form-control datepicker" value="">
                                <label for="doi">Date Being Reviewed</label>
                            </div>

                        </div>
                        
                        <div class="col-lg-2 col-md-12">
                            <div>Start Time</div>
                           <div class="md-form">
                              <input placeholder="Selected time" type="text" id="start_time" name="start_time" class="form-control timepicker">
                              <label for="input_starttime">Start Time</label>
                            </div>

                        </div>
                        
                        <div class="col-lg-2 col-md-12">
                            <div>Start Time</div>
                           <div class="md-form">
                              <input placeholder="Selected time" type="text" id="end_time" name="end_time" class="form-control timepicker">
                              <label for="input_starttime">Start Time</label>
                            </div>

                        </div>
                            
                        <?php $employee = Vanguard\Employee::orderBy('last_name')->where('status', 5)->get(); ?>    

                        <div class="col-lg-6 col-md-12">

                            <select class="mdb-select" id="user_id" name="user_id" searchable="Search here.." >
          <option value="" disabled selected>Choose Employee</option>
          @foreach($employee as $row)
            <option value="{{$row->user_id}}" >{{$row->last_name}}, {{$row->first_name}}</option>
          @endforeach
        </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">

                            <select class="mdb-select md-form" id="user_id" name="drive_type"
                                    searchable="Search here..">
                                <option value="" disabled selected>Reason for Evaluation</option>

                                <option value="1" selected>Routine Driving</option>
                                <option value="2">Routine Driving Loaded</option>
                                <option value="3">Emergency Response</option>
                                <option value="4">Emergency Response Lodaded</option>

                            </select>

                        </div>

                        <div class="col-lg-6 col-md-12">

                            <select class="mdb-select md-form" id="user_id" name="reason" searchable="Search here..">
                                <option value="" disabled selected>Response Type</option>

                                <option value="1" selected>Random</option>
                                <option value="2">30-30-30</option>
                                <option value="3">Back to Driving Program</option>
                                <option value="4">Post Accident Review</option>
                                <option value="5">Post Complaint Review</option>
                            </select>

                        </div>
                    </div>

                    <div class="row">
                        @foreach($questions as $row)
                        <div class="col-lg-6">
                            {{$row->question}}
                        </div>

                        <div classs="col-lg-6">
                            <!-- Material inline 1 -->
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="{{$row->id}}p" name="q{{$row->id}}" value="{{$row->p}}" checked>
                                <label class="form-check-label" for="{{$row->id}}p">Pass</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="{{$row->id}}ni" name="q{{$row->id}}" value="{{$row->ni}}">
                                <label class="form-check-label" for="{{$row->id}}ni">Needs Improvement</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="{{$row->id}}f" name="q{{$row->id}}" value="{{$row->f}}">
                                <label class="form-check-label" for="{{$row->id}}f">Fail</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input" id="{{$row->id}}na" name="q{{$row->id}}" value="{{$row->na}}">
                                <label class="form-check-label" for="{{$row->id}}na">N/A</label>
                            </div>
                        </div>
                        <hr>
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="md-form">
                                <div class="md-form">
                                    <textarea id="comments" name="comments" class="form-control"></textarea>
                                    <label for="procedure">Comments</label>
                                </div>
                            </div>
                        </div>
                            
                    </div>
                    
                    <div class="row">
                        <input type="file" class="form-control" name="photo[]" multiple />
                    </div>

                <input type="hidden" name="pid" value="{{$review->id}}">
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
<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>

@stop

@section('scripts')


<script type="text/javascript">
    $('#end_time').pickatime({
    // 12 or 24 hour
    twelvehour: false,
});

$('#start_time').pickatime({
    // 12 or 24 hour
    twelvehour: false,
});


</script>



@stop