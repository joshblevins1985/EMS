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
    <a href="/compliance/create"><button type="button" class="btn btn-primary">Add New Encounter</button></a> 
</div>
<div class="row">
        <!-- Grid column -->
    <div class="col-lg-4 col-md-6">

        <!--Panel-->
        <div class="card text-center">
            <div class="card-header danger-color white-text">
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
                        @elseif($erow->encounter_type == 7)
                        Employee Report
                        @endif
                    
                    <small>{{$erow->policies->policy_number or 'Employee Reported'}} -- {{$erow->policies->title or ''}}.</small>
                </li>
                </a>
                @endforeach

            </ul>
                @else
                <ul class="list-group">
 
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    No Pending Compliance Issues
                </li>
                
              

            </ul>
                
                @endif
                
            </div>
            <div class="card-footer text-muted danger-color white-text">
                <p class="mb-0"><a href="encounters/list">View All</a></p>
            </div>
        </div>
        <!--/.Panel-->

    </div>
    
     <!-- Grid column -->
    <div class="col-lg-4 col-md-6">

        <!--Panel-->
        <div class="card text-center">
            <div class="card-header danger-color white-text">
                <h3>Motor Vehicle Crashes</h3>
            </div>
            <div class="card-body">
                <h4 class="card-title">Special title treatment</h4>
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                <a class="btn btn-success btn-sm">Go somewhere</a>
            </div>
            <div class="card-footer text-muted danger-color white-text">
                <p class="mb-0"></p>
            </div>
        </div>
        <!--/.Panel-->

    </div>
    <!-- Grid column -->
    
        <!-- Grid column -->
    <div class="col-lg-2 col-md-6">

        <!--Panel-->
        <div class="card text-center">
            <div class="card-header primary-color white-text">
                <h3>Attendance Notifications</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @foreach($attendance as $row)
                        <?php
                            if($row->level == 1){
                                $color = 'list-group-item-info';
                            }elseif($row->level == 2){
                                $color = 'list-group-item-warning';
                            }elseif($row->level == 3){
                                $color = 'list-group-item-danger';
                            }else{
                                $color= '';
                            }
                        ?>
                        <a href="/attend/{{$row->user_id}}">
                           <li class="list-group-item {{$color}}">
                            <div class="row">
                                <div class="col-lg-10">
                                    {{$row->employee->first_name}} {{$row->employee->last_name}}
                                </div>
                            </div>
                         </li> 
                        </a>
                        
                   
                    @endforeach
                </ul>
            </div>
            <div class="card-footer text-muted primary-color white-text">
                <p class="mb-0"></p>
            </div>
        </div>
        <!--/.Panel-->

    </div>
    <!-- Grid column -->
    
    <div class="col-lg-2 col-md-6">

        <!--Panel-->
        <div class="card text-center">
            <div class="card-header warning-color white-text">
                <h3>Expired / Expiring Policies</h3>
            </div>
            <ul class="list-group">
                @foreach($exppolicies as $prow)
                @if(strtotime('$prow->last_reviewed') < strtotime('-18 months') && strtotime('$prow->last_reviewed') > strtotime('-2 years') )
                    <?php $list_color = "list-group-item-warning"  ?>
                @elseif(strtotime('$prow->last_reviewed') < strtotime('-2 years'))
                    <?php $list_color = "list-group-item-danger"  ?>
                    
                @else
                    <?php $list_color = ""  ?>
                @endif
                <li class="list-group-item {{$list_color}} d-flex justify-content-between align-items-center">
                    {{$prow->title}}
                    <span class="badge badge-primary badge-pill">{{date('m-d-Y',strtotime($prow->last_reviewed))}}</span>
                </li>
                
                @endforeach

            </ul>
    <div class="card-footer text-muted warning-color white-text">
                <p class="mb-0"></p>
            </div>
        </div>
        <!--/.Panel-->

    </div>
</div>



@stop

@section('styles')

@stop

@section('scripts')

@stop