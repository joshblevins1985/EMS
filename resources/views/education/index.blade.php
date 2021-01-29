@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.messages')



<div class="row">
    <div class="col-lg-6 col-sm-12">
        <canvas id="lineChart"></canvas>
    </div>
    <div class="col-lg-3 col-sm-12">
        <!--Panel-->
                <div class="card text-center">
                    <div class="card-header danger-color white-text">
                        Isufficient PCR Notifications
                        <p>Average: {{$nwavg}}</p>
                    </div>
                    <div class="card-body">
                        <table class="table table">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Total Insufficient</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($empcount as $row)
                                @if($row->count > $nwavg)
                                <tr>
                                    <td>{{$row->employee->first_name}} {{$row->employee->last_name}}</td>
                                    <td>{{$row->count}}</td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="card-footer text-muted danger-color white-text">
                        <p class="mb-0"></p>
                    </div>
                </div>
                <!--/.Panel-->
    </div>
    <div class="col-lg-3 col-sm-12">
        <!--Panel-->
        <div class="card text-center">
            <div class="card-header warning-color white-text">
               <div class="col-lg-10"><h3>Open Compliance Issues</h3></div> 
               
                
            </div>
            <div class="card-body">
                @if(count($encounters))
                <ul class="list-group">
                @foreach($encounters as $erow)
                <a href="compliance/{{$erow->id}} ">
                    
                
                <li class="list-group-item d-flex justify-content-between align-items-center">
                   
                        {{$erow->employee->first_name}} {{$erow->employee->last_name}} --  
                        
                        @if($erow->encounter_type == 1)
                        File Notation
                        @elseif($erow->encounter_type == 2)
                        Corrective Counciling
                        @elseif($erow->encounter_type == 3)
                        Verbal Warning
                        @elseif($erow->encounter_type == 4)
                        Written Warning
                        @elseif($erow->encounter_type == 5)
                        Suspension
                        @elseif($erow->encounter_type == 6)
                        Termination
                        @endif
                    
                    <small>{{$erow->policies->policy_number}} -- {{$erow->policies->title}}.</small>
                </li>
                </a>
                
                @endforeach
                    
            </ul>
            {{$encounters->links()}}
                @else
                <ul class="list-group">
 
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    No Pending Compliance Issues
                </li>
                
              

            </ul>
                
                @endif
                
            </div>
            <div class="card-footer text-muted warning-color white-text">
                <p class="mb-0"><a href="encounters/list">View All</a></p>
            </div>
        </div>
        <!--/.Panel-->
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-sm-12">
         <!--Panel-->
        <div class="card text-center">
            <div class="card-header primary-color white-text">
               <div class="col-lg-10"><h3>QA QI Pending Contacts</h3></div> 
               
                
            </div>
            <div class="card-body">
               @if(count($qacontact))
                <div class="list-group">
                    @foreach($qacontact as $row)
                  <a href="/employees/{{$row->employee->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <div class="row">
                            <div class='col-12'>Date of Incident: {{date('M-d-y', strtotime($row->date))}} </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                           Location
                       </div>
                       <div class="col-6">
                           Employee: {{$row->employee->first_name}} {{$row->employee->last_name}}
                       </div>
                        </div>
                        
                  </a>
                  </div>
                  @endforeach
                  @else
                No Pending Contact Today.
                @endif
                
            </div>
            </div>
            <div class="card-footer text-muted primary-color white-text">
                <p class="mb-0"><a href="/cprclasses">View All</a></p>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    
    <div class="col-lg-4 col-sm-12">
        <!--Panel-->
        <div class="card text-center">
            <div class="card-header primary-color white-text">
               <div class="col-lg-10"><h3>CPR ASHI Classes</h3></div> 
               
                
            </div>
            <div class="card-body">
               @if(count($cpr))
                <div class="list-group">
                    @foreach($cpr as $row)
                  <a href="#!" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <div class="row">
                            <div class='col-12'>{{date('M-d-y H:i', strtotime($row->start_date))}} to {{date('M-d-y H:i', strtotime($row->end_date))}}</div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                           Location
                       </div>
                       <div class="col-6">
                           
                       </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                           <address> 
                           <strong>{{$row->facility->name}}</strong><br>
                           {{ $row->facility->house_number }} {{ $row->facility->street }}<br> {{ $row->facility->city }} {{ $row->facility->state }} {{ $row->facility->zip }} </address>
                       </div>
                       <div class="col-6">
                           <small>{{$row->instructor or 'No Instructor Assigned'}}</small><br>
                          <small>AC-{{date('y', strtotime($row->start_date))}}-{{$row->id}}</small>
                       </div>
                        </div>
                  </a>
                  </div>
                  @endforeach
                  @else
                No CPR Classes within 14 days.
                @endif
                
            </div>
            </div>
            <div class="card-footer text-muted primary-color white-text">
                <p class="mb-0"><a href="/cprclasses">View All</a></p>
            </div>
        </div>
        <!--/.Panel-->
    </div>
    
    <div class="col-lg-4 col-sm-12">
        <!--Panel-->
        <div class="card text-center">
            <div class="card-header primary-color white-text">
               <div class="col-lg-10"><h3>Todays Student Observers</h3></div> 
               
                
            </div>
            <div class="card-body">
                @if(count($observers))
                <div class="list-group">
                    @foreach($observers as $row)
                  <a href="#!" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                      <div class="row">
                            <div class='col-12'>{{date('M-d-y H:i', strtotime($row->start))}} to {{date('M-d-y H:i', strtotime($row->end))}}</div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                           Observer Name
                       </div>
                       <div class="col-6">
                           Preceptor Name
                       </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                           {{$row->observer->first_name}} {{$row->observer->last_name}}
                       </div>
                       <div class="col-6">
                           <small>{{$row->preceptors->first_name}} {{$row->preceptors->last_name}}</small>
                       </div>
                        </div>
                  </a>
                  </div>
                  @endforeach
                  @else
                No Observers today
                @endif
                
              
              
            </div>
            <div class="card-footer text-muted primary-color white-text">
                <p class="mb-0"><a href="encounters/list">View All</a></p>
            </div>
        </div>
        <!--/.Panel-->
    </div>
</div>


@stop

@section('styles')

@stop
@section('scripts')



<script>
    //line
var ctxL = document.getElementById("lineChart").getContext('2d');
var myLineChart = new Chart(ctxL, {
  type: 'line',
  data: {
    labels: [<?php echo $labels ?>],
    datasets: [{
        label: "Insufficient",
        data: [{{$nw->where('grade', 2)->pluck('count')->implode(', ')}}],
        backgroundColor: [
          'rgba(105, 0, 132, .2)',
        ],
        borderColor: [
          'rgba(200, 99, 132, .7)',
        ],
        borderWidth: 2
      },
      {
        label: "Sufficient",
        data: [{{$nw->where('grade', 1)->pluck('count')->implode(', ')}}],
        backgroundColor: [
          'rgba(0, 137, 132, .2)',
        ],
        borderColor: [
          'rgba(0, 10, 130, .7)',
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

@stop