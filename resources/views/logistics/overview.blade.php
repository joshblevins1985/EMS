@extends('layouts.sidebar-fixed')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')


@include('partials.toastr')


@foreach($nw as $n)

{{$n->month}}
{{$n->medication}}
{{$n->use_count}}
@endforeach

<!-- Menu Section -->
<div class="row" style="text-align: center;">
    <div class="col-lg-9 col-sm-12">
        <!-- Narcotic Usage Report -->
        <div class="row">
            <h2>Narcotic Use by Medication Type </h2>
            <div class="col">
                <img src="https://image.freepik.com/free-vector/characters-people-holding-positive-emoticons-illustration_53876-43005.jpg" alt="Italian Trulli">
            </div>

        </div>


    </div>
    <div class="col-lg-3 col-sm-12">
        <div class="col-lg-12">
            @include('logistics.partials.overviewNotifications')
        </div>
        <div class="col-lg-12">
            <!--Panel-->
            <div class="card text-center">
                <div class="card-header danger-color white-text">
                    Narcotic Overuse Alerts
                    <p>Average: {{$useavg}}</p>
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer text-muted danger-color white-text">
                    <p class="mb-0"></p>
                </div>
            </div>
            <!--/.Panel-->
        </div>
        <div class="col-lg-12">
            <!--Panel-->
            <div class="card text-center">
                <div class="card-header primary-color white-text">
                    Logistic Menu
                </div>
                <div class="card-body">
                    <ul class="nav flex-column">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">Vial Tracking</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('controlled.index') }}"> <span class="dropdown-item-text"> Medication Vial
                                        List </span> </a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                   data-target="#basicExampleModal"><span class="dropdown-item-text"> Add New Medication Vial </span></a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">Narcotics Boxes</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('narcoticbox.index') }}"> <span class="dropdown-item-text">Narcotic Box
                                        List </span> </a>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                   data-target="#basicExampleModal2"> <span class="dropdown-item-text"> Create Box Report </span></a>
                                   
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                   data-target="#modalBoxReport"><span class="dropdown-item-text"> Create Station Box Report </span> </a>
                                   
                                   <a class="dropdown-item" href="#" data-toggle="modal"
                                      data-target="#modalBoxReportDates"><span class="dropdown-item-text">Create Station Box Report By Dates </span></a>

                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">Narcotic Logging</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#"> <span class="dropdown-item-text"> Narcotic Log </span> </a>
                                <a class="dropdown-item" href="#"><span class="dropdown-item-text"> Search Narcotic Log </span> </a>
                                `                   <a class="dropdown-item" href="logistic.waste"><span class="dropdown-item-text"> Narcotic Waste Log </span></a>
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
        
        <div class="col-12">
            <a href="/logistic/mnbindex"><button type="button" class="btn btn-primary">Manual Log Entry</button></a> 
        </div>
    </div>


    <div class="row">
        <!-- Meds and Boxes -->

        <!-- Medication List Report -->
        <div class="col-lg-6 col-sm-12">
            <h2>Narcotic Counts</h2>
            <div class="row">
                @foreach($cs as $row)
                <div class="col-lg-3 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="javascript:{}"
                               onclick="document.getElementById('safe{{$row->id}}').submit(); return false;"
                               class="text-center no-decoration">
                                <div class="row">


                                    <div class="p-3 text-primary flex-1">
                                        <div class="icon my-3">
                                            <i class="fas fa-medkit fa-2x"></i>
                                        </div>
                                        <p class="lead mb-0">{{$row->trade_name}}</p>
                                    </div>

                                    <div class="pr-3">
                                        @foreach($mcount as $count)
                                        @if($row->id == $count->medication)
                                        <form class="form-inline" id="safe{{$row->id}}" role="search"
                                              method="GET" action="{{url('logistic/safereport')}}">
                                            @csrf

                                            <input type="hidden" id="med" name="med"
                                                   value="{{$row->id}}">

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

        </div>

        <!-- Narcotic Boxes Report -->
        <div class="col-lg-6 col-sm-12">
            <h2>Narcotic Boxes</h2>
            <!--Accordion wrapper-->
            <div class="accordion md-accordion accordion-1" id="accordionEx23" role="tablist">
                @foreach($stations as $station)
                <div class="card">
                    <div class="card-header blue lighten-3 z-depth-1" role="tab" id="heading{{$station->id}}">
                       <div class="row">
                           <div class="col-lg-10">
                            <h5 class="text-uppercase mb-0 py-1">
                            <a class="white-text font-weight-bold" data-toggle="collapse"
                               href="#collapse{{$station->id}}" aria-expanded="true"
                               aria-controls="collapse{{$station->id}}">
                                {{$station->station}} Station Boxes
                            </a>
                            </h5>
                        </div>
                        <div class="col-lg-2">
                            @if($station->nc_status == 1)
                                <img src="{{storage_path('app/icons/connected.png')}}" width="20" height="20" alt="Connected"/>
                            @elseif($station->nc_status == 0)
                                <img src="{{storage_path('app/icons/disconnected.png')}}" width="20" height="20" alt="Disconnected"/>
                            @endif
                        </div>
                       </div>
                       
                    </div>
                    <div id="collapse{{$station->id}}" class="collapse" role="tabpanel"
                         aria-labelledby="heading{{$station->id}}" data-parent="#accordionEx23">
                        <div class="card-body">
                            <div class="row my-4">

                                @foreach($boxes as $box)
                                
                                @if($station->id == $box->station)
                                
                                
                                @if($box->status == 1)
                                <?php $color = "bg-success"; ?>
                                @elseif($box->status == 2)
                                <?php $color = "bg-warning";
                                ?>

                                @elseif($box->status == 3)
                                <?php $color = "bg-danger"; ?>
                                @elseif($box->status == 4)
                                <?php $color = "bg-dark"; ?>
                                @endif
                                
                               
                                <div class="col-md-3">
                                    <div class="card {{$color}} ">
                                        <div class="card-body">
                                            <a href="narcoticbox/{{$box->id}}"
                                               class="text-center no-decoration">
                                               
                                                <p class="lead mb-0">
                                                @foreach($elogs as $elog)
                                                    @if($box->id == $elog->box)
                                                        {{date('m/d H:i', strtotime($elog->time_out))}}
                                                        
                                                    @endif
                                                    @endforeach
                                                </p>
                                                <div class="icon my-3">
                                                    <i class="fa fa-th fa-2x"></i>
                                                </div>
                                                <p class="lead mb-0">Box: {{$box->box_number}}</p>
                                                <p>
                                                
                                                <p class="lead mb-0">
                                                    @foreach($elogs as $elog)
                                                    @if($box->id == $elog->box)
                                                           Bag: {{$elog->drugbaginfo->bag_number ?? 'N/B'}}</p>
                                                            Seal: {{$elog->drug_bag_seal_out ?? ''}}
                                                        {{$elog->employees->first_name or 'Unknown'}} {{$elog->employees->last_name or ''}}
                                                    @endif
                                                    @endforeach
                                                </p>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!--Accordion wrapper-->

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

<!-- Modal -->
<div class="modal fade" id="modalBoxReport" tabindex="-1" role="dialog" aria-labelledby="modalBoxReportLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBoxReportLabel">Create Station Box Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 600px;">
        <form class="form-inline" role="search" method="GET" action="{{url('/stationboxreport')}}">
                    @csrf

            <div class="form-group row">
                <input placeholder="Selected date" type="text" id="start" name="start" class="form-control datepicker">
                <label for="expiration">Start Date</label>
            </div>
            
            <div class="form-group row">
                <select class="mdb-select md-form" name="station">
                    <option value="" disabled selected>Select Station to Report</option>
                    @foreach($stations as $row)
                        <option value="{{$row->id}}">{{$row->station}}</option>
                    @endforeach
                </select>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Get Report</button>
        
        </form>
      </div>
    </div>
  </div>
  
</div>

<!-- Modal -->
<div class="modal fade" id="modalBoxReportDates" tabindex="-1" role="dialog" aria-labelledby="modalBoxReportDatesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBoxReportDatesLabel">Create Station Box Report By Date Range</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="height: 600px;">
        <form class="form" role="search" method="GET" action="{{url('/stationboxreportbydate')}}">
                    @csrf
            <div class="form-group row">
                <div class="col-xl-6 mr-4">
                    <label for="expiration">Start Date</label>
                    <input placeholder="Selected date" type="text" id="start" name="start" class="form-control datepicker">

                </div>

                <div class="col-xl-6">
                    <label for="expiration">End Date</label>
                    <input placeholder="Selected date" type="text" id="start" name="end" class="form-control datepicker">

                </div>
            </div>

            <select class="mdb-select md-form" name="station">
                <option value="" disabled selected>Select Station to Report</option>
                @foreach($stations as $row)
                <option value="{{$row->id}}">{{$row->station}}</option>
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

    @push('styles')
        <link href="assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
        <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />


    @endpush

    @push('scripts')
        <script src="https://cdnjs.com/libraries/Chart.js"></script>
        <script src="/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
        <script src="assets/plugins/select2/dist/js/select2.min.js"></script>
    <script>
        //line
        var ctxL = document.getElementById("lineChart").getContext('2d');
        var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: <?php echo $months ?>,
                datasets: [{
                    label: "Morphine",
                    data: [0, 0, , 0, 0, 0, 0, 0, 0, 2],
                    backgroundColor: [
                        'rgba(105, 0, 132, .2)',
                    ],
                    borderColor: [
                        'rgba(200, 99, 132, .7)',
                    ],
                    borderWidth: 2
                },
                    {
                        label: "Fentanyl",
                        data: [0, 0, , 0, 0, 0, 0, 0, 0, 3],
                        backgroundColor: [
                            'rgba(0, 137, 132, .2)',
                        ],
                        borderColor: [
                            'rgba(0, 10, 130, .7)',
                        ],
                        borderWidth: 2
                    },
                    {
                        label: "Versed",
                        data: [0, 0, , 0, 0, 0, 0, 0, 0, 4],
                        backgroundColor: [
                            'rgba(139, 70, 0, .2)',
                        ],
                        borderColor: [
                            'rgba(139, 70, 0, .7)',
                        ],
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true
            }
        });
    </script>
        <script>


            var handleSelect2 = function() {

                $('.datepicker').datepicker({
                    todayHighlight: true
                });

            };


            var FormPlugins = function () {
                "use strict";
                return {
                    //main function
                    init: function () {
                        handleSelect2();
                    }
                };
            }();

            $(document).ready(function() {
                FormPlugins.init();
            });

        </script>

        <script>
            $('#narcnotification').on('hidden.bs.dropdown', function() {
                $('#narcnotification').append($('.dropdown').css({
                    overflow: auto;
                }).detach());
            });
        </script>
    @endpush