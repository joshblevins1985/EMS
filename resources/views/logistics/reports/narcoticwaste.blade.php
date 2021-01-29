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


    
<div class="row" style="margin-bottom: 50px;">
    <div class="col-lg-12">
        <div class="col-sm-4 float-left"><h1>Narcotic Waste Report</h1></div>

        <div class="col-sm-4 float-right">
            <div class="row">
                <div class="col-6">
                    Waste ID:
                </div>
                <div class="col-6 ">
                    NW:{{sprintf('%08d', $waste->id )}}
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    Employee Requesting Report:
                </div>
                <div class="col-6 ">
                    {{ auth()->user()->present()->nameOrEmail }}
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    Report Date:
                </div>
                <div class="col-6 ">
                    {{date('m/d/Y H:i')}}
                </div>
            </div>
            
        </div>
        
    </div>
    <hr>
    
</div>





<div class="row" style="margin-bottom: 50px;">
    
    <div class="col-lg-12">
        <div class="float-right">Date of Waste: {{date('D - M d, Y', strtotime($waste->created_at))}}</div>
    </div>
    <div class="col-lg-12">
        <div class="float-right">Time of Waste: {{date('H:i', strtotime($waste->created_at))}}</div>
    </div>
</div>

<div class="row">
    
    
        <div class="col-4 font-weight-bold text-center">Station</div>
        <div class="col-4 font-weight-bold text-center">Attendant</div>
        <div class="col-4 font-weight-bold text-center">Driver</div>
        
    
    
</div>

<div class="row" style="margin-bottom: 50px;">
    
    
        <div class="col-4 text-center">{{$waste->stationinfo->station}}</div>
        <div class="col-4 text-center">{{$waste->employee->first_name}} {{$waste->employee->last_name}} -- {{$waste->employee->eid}}</div>
        <div class="col-4 text-center">@if(!$waste->driver) Unkown @else{{$waste->drivers->first_name}} {{$waste->drivers->last_name}} -- {{$waste->drivers->eid}} @endif</div>
        
   
    
</div>


<div class="row">
    
    
        <div class="col-4 font-weight-bold text-center">Patient Name</div>
        <div class="col-4 font-weight-bold text-center">Transport Reason</div>
        <div class="col-4 font-weight-bold text-center">Administration Reason</div>
</div>

<div class="row" style="margin-bottom: 50px;">
    
    
        <div class="col-4 text-center">{{$waste->patient_name or 'Pending Entry'}}</div>
        <div class="col-4 text-center">{{$waste->transport or 'Pending Entry'}}</div>
        <div class="col-4 text-center">{{$waste->administration or 'Pending Entry'}}</div>
        
</div>

<div class="row">
    
    
        <div class="col-4 font-weight-bold text-center">Box Number</div>
        <div class="col-4 font-weight-bold text-center">Old Seal</div>
        
        <div class="col-4 font-weight-bold text-center">New Seal</div>
</div>

<div class="row" style="margin-bottom: 50px;">
    
    
        <div class="col-4 text-center">{{$waste->boxinfo->box_number}}</div>
        <div class="col-4 text-center">{{$waste->seal or 'Pending Entry'}}</div>
        <div class="col-4 text-center">{{$waste->new_seal or 'Pending Entry'}}</div>
        
</div>

<div class="row">
    
    
        <div class="col-3 font-weight-bold text-center">Vial ID / Drug</div>
        <div class="col-3 font-weight-bold text-center">Dose Available</div>
        <div class="col-3 font-weight-bold text-center">Amount Used</div>
        
        <div class="col-3 font-weight-bold text-center">Amount Wasted</div>
</div>

<div class="row" style="margin-bottom: 50px;">
    
    
        <div class="col-3 text-center">{{sprintf('%08d', $waste->vial->id )}} -- {{$waste->vial->medications->trade_name}}</div>
        <div class="col-3 text-center">{{$waste->vial->dose}}</div>
        <div class="col-3 text-center">{{$waste->used or 'Pending Entry'}} units</div>
        <div class="col-3 text-center">{{$waste->waste or 'Pending Entry'}} units</div>
        
</div>

<div class="row" style="margin-bottom: 50px;">
    
    
        <div class="col-6 font-weight-bold text-center">Employee Administered Signature: Electronically Obtained: {{$waste->employee->first_name}} {{$waste->employee->last_name}} -- {{$waste->employee->eid}}  on {{date('m-d-Y H:i', strtotime($waste->created_at))}}</div>
        
</div>

<div class="row" style="margin-bottom: 50px;">
    
    
        <div class="col-6 font-weight-bold ">Witness Name: Signature on file: {{$waste->witness}}</div>
        
</div>





    @stop

    @section('styles')

    @stop

    @section('scripts')
    
    @stop






