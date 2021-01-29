@extends('layouts.app')

@section('page-title', trans('Narcotic Box'))
@section('page-heading', trans('Narcotic Box Info'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

    @include('partials.toastr')

    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <h1>Narcotic Box Report</h1>
        </div>

        <div class="col-sm-12 col-lg-4">
            <table>
                <tr>
                    <td>Date:</td>
                    <td>{{date('m-d-Y H:i:s', strtotime('now'))}}</td>
                </tr>
                <tr>
                    <td>Reported By:</td>
                    <td>{{ auth()->user()->present()->nameOrEmail }}</td>
                </tr>
                <tr>
                    <td>Start Date:</td>
                    <td> {{date('m-d-Y', strtotime($start))}} </td>
                </tr>
                <tr>
                    <td>End Date:</td>
                    <td> {{date('m-d-Y', strtotime($end))}} </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="row">
        <!-- Grid column -->
        <div class="col-lg-12 col-sm-12">

            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Box Information</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Box ID</td>
                            <td>{{$boxes->box_number}}</td>
                            <td>Assigned Station</td>
                            <td>{{$boxes->boxstations->station}}</td>
                        </tr>
                        <tr>
                            <td>Assigned Region</td>
                            <td></td>
                            <td>Box Status</td>
                            <td>
                                @if($boxes->status == 1)
                                    Secured
                                @elseif($boxes->status == 2)
                                    Checked Out
                                @elseif($boxes->status == 3)
                                    Used - OOS
                                @elseif($boxes->status == 4)
                                    ADMIN -- OOS
                                @else
                                    Unknown
                                @endif
                            </td>
                        </tr>
                    </table>

                </div>

            </div>


            <!--/.Card-->
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <!-- Grid column -->


            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Assignment Log</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                        <tr>
                            <th>Employee Out / Witness</th>
                            <th>Seal</th>
                            <th>Tamper</th>
                            <th>Employee In / Witness</th>
                            <th>Seal</th>
                            <th>Tamper</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($nlog as $row)
                            <tr>
                                <td>{{$row->employees->first_name or ''}} {{$row->employees->last_name or ''}} / {{$row->witnessout->first_name or ''}} {{$row->witnessout->last_name or ''}}</td>
                                
                                <td>{{$row->seal}}</td>
                                <td>{{$row->tamper_seal}}</td>
                                <td>{{$row->employeesin->first_name or ''}} {{$row->employeesin->last_name or ''}} / {{$row->witnessin->first_name or ''}} {{$row->witnessin->last_name or ''}}</td>
                                
                                <td>{{$row->seal_in}}</td>
                                <td>{{$row->tamper_seal_in}}</td>
                            </tr>
                            <tr>
                                <td>Time Out</td>
                                <td colspan="2">{{date('m-d-Y H:i', strtotime($row->time_out))}}</td>
                                <td>Time In</td>
                                <td colspan="2">{{date('m-d-Y H:i', strtotime($row->time_in))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            <!--/.Card-->

        </div>

        <div class="col-sm-12 col-lg-6">
            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Narcotic Vials Assigned</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Vial ID</th>
                            <th>Description</th>
                            <th>Expiration</th>
                            <th>NDC #</th>
                            <th>Lot #</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($vlog as $row)
                            <tr>
                                <td>V-{{sprintf('%08d', $row->vial->id )}}</td>
                                <td>{{$row->vial->medications->trade_name}} -- {{$row->vial->dose}}</td>
                                <td>{{date('m-d-Y', strtotime($row->vial->expiration))}}</td>
                                <td>{{$row->vial->ndc_number}}</td>
                                <td>{{$row->vial->lot_number}}</td>
                                <td>{{$row->vial->stat->label}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            <!--/.Card-->

        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12 col-lg-6">
            <!-- Grid column -->


            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Audit Log</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Employee</th>
                            <th>Log ID</th>
                            <th>Audit Type</th>
                            <th>Comments</th>
                            <th>Status</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($audit as $row)
                            <tr>
                                <td>{{date('m/d/y H:i', strtotime($row->created_at))}}</td>
                                <td>{{$row->employee->first_name}} {{$row->employee->last_name}}</td>
                                <td>NL-{{sprintf('%08d', $row->narcotic_log_id )}}</td>
                                <td>{{$row->audits->label}}</td>
                                <td>{{$row->comments}}</td>
                                <td>@if($row->status == 0) Open @elseif($row->status == 1) Closed @else Unknown @endif</td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            <!--/.Card-->

        </div>

        <div class="col-sm-12 col-lg-6">
            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Narcotic Wastes</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Vial ID</th>
                            <th>Medication /Available Dose</th>
                            <th>Used</th>
                            <th>Wasted</th>
                            <th>Attending</th>
                            <th>Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($waste as $row)
                            <tr>
                                <td>V-{{sprintf('%08d', $row->vial->id )}}</td>
                                <td>{{$row->vial->medications->trade_name}} -- {{$row->vial->dose}}</td>
                                <td>{{$row->used}} units</td>
                                <td>{{$row->waste}} units</td>
                                <td>{{$row->employee->first_name or ''}} {{$row->employee->last_name or ''}}</td>
                                <td>{{$row->vial->stat->label}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            <!--/.Card-->

        </div>
    </div>

    <div class="row">
        <!-- Grid column -->
        <div class="col-lg-12 col-md-12">

            <!--Card-->
            <div class="card">

                <!--Card image-->
                <div class="view">
                    <h4 class="card-title">Box Notes</h4>
                </div>

                <!--Card content-->
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 15%">Date</th>
                            <th style="width: 60%">Note</th>
                            <th style="width: 15%">Employee</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($notes as $note)
                        <tr>
                            <td>{{date('m-d-Y H:i', strtotime($note->created_at))}}</td>
                            <td>{!!$note->note!!}</td>
                            <td>{{$note->employees->first_name or 'System Note'}} {{$note->employees->last_name or ''}}</td>
                        </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>


            <!--/.Card-->
        </div>
    </div>
@stop

@section('styles')

@stop

@section('scripts')

@stop