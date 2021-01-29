@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
<link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">Employee Dashboard</a></li>

</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">Employee Dashboard</h1>
<!-- end page-header -->

<!-- begin col-12 -->
    <div class="col-xl-12">
        <!-- begin card -->
        <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
            <!-- begin card-body -->
            <div class="card-body">

            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col-12 -->

@endsection

<!--Attandance Model-->
    <div class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-fluid modal-full-height modal-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalPreviewLabel">Employee Attendance Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Card-->
        <div class="card">

            <!--Card content-->
            <div class="card-body elegant-color white-text">
                <!--Title-->
                <h4 class="card-title">Current Quarter Attendance</h4>
                <!--Text-->
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Infraction</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!count($attend))
                        <tr>
                            <td colspan="2">No Attendance Infractions</td>
                        </tr>
                        @else
                        @foreach($attend as $row)
                        <tr>
                            <td>{{date('m-d-Y', strtotime($row->date))}}</td>
                            <td>{{$row->type->label or 'Unknown'}}</td>
                            <td>{{$row->type->points}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="progress md-progress" style="height: 20px">
                    <div class="progress-bar" role="progressbar" style="width: {{$percent}}%; height: 20px" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7"></div>
                </div>
                <small>This progress bar shows a count of your current attendance record for this quarter. When 100% is reached you are ineligibleble for the quarterly bonus. If you feel this information is inaccurate contact compliance as soon as possible. </small>
            </div>

        </div>
        <!--/.Card-->
      </div>

    </div>
  </div>
</div>
<!--/.Attendance Model-->

<div class="modal fade right" id="qaModal" tabindex="-1" role="dialog" aria-labelledby="qaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qaModalLabel">Quality Assurance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(!count($qa))
        @else
        <!--Card-->
        <div class="card">
            <!--Card content-->
            <div class="card-body elegant-color white-text">
                <!--Title-->
                <h4 class="card-title">Recent Quality Assurance</h4>
                <!--Text-->
                <div class="list-group">



                    @foreach($qa as $row)
                    <a href="qaqi/{{$row->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">{{date('m-d-Y', strtotime($row->date))}}</h5>
                            <small></small>
                        </div>
                        <p class="mb-2">{!!substr($row->comments, 0, 200)!!}</small>

                        <p class="mb-2">@if(!$row->acknowledged) <span class="badge badge-danger">Please click to review and sign the qa report.</span>@else You have signed and acknowledged this QaQi report. Thank you @endif</small>
                    </a>
                    @endforeach

                </div>
                {{$qa->links("pagination::bootstrap-4")}}
                <small>Items displayed here are from quality assurance reviews completed on your patient care documents. You may click a review to see more detailed information.</small>
            </div>

        </div>
        <!--/.Card-->
        @endif
      </div>

    </div>
  </div>
</div>

<div class="modal fade right" id="complianceModal" tabindex="-1" role="dialog" aria-labelledby="complianceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="complianceLabel">Compliance Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(!count($encounters))
            <h3>No Compliance Issues</h3>
        @else
        <!--Card-->
        <div class="card">

            <!--Card content-->
            <div class="card-body elegant-color white-text">
                <!--Title-->
                <h4 class="card-title">Employee Encounters Needing Action</h4>
                <!--Text-->
                <div class="list-group">
                    @foreach($encounters as $row)
                    <a href="#!" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">{{date('m-d-Y', strtotime($row->doi))}}</h5>
                            <small>@if($row->status == 1) Investigation @elseif($row->status == 2)
                                Contact @elseif($row->status == 3) Admin/Training @elseif($row->status == 4)
                                Closed @else Unknown @endif</small>
                        </div>
                        <p class="mb-2">{!!substr($row->incident_report, 0, 200)!!}</small>
                    </a>
                    @endforeach
                </div>
                <small>Items displayed here are from encounters entered into the system that require a response or action by the employee.</small>
            </div>

        </div>
        <!--/.Card-->
        @endif
      </div>

    </div>
  </div>
</div>

@push('scripts')
<script src="assets/plugins/d3/d3.min.js"></script>
<script src="assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="assets/plugins/moment/moment.js"></script>
<script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="assets/js/demo/dashboard-v3.js"></script>

<script>
    var labels = {!! json_encode(array_keys($activities)) !!}
    ;
            var activities = {!! json_encode(array_values($activities)) !!}
    ;
    var trans = {
        chartLabel: "{{ trans('app.registration_history')  }}",
        action: "{{ trans('app.action_sm')  }}",
        actions: "{{ trans('app.actions_sm')  }}"
    };
</script>
{!! HTML::script('assets/js/chart.min.js') !!}
{!! HTML::script('assets/js/as/dashboard-default.js') !!}

@endpush
