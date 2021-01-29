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

    <div class="col-lg-10 col-sm-12">
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
                                    <h2 class="text-right">Box ID</h2>
                                    <div class="text-muted">
                                        {{$box->box_number}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="p-3 text-primary flex-1">
                                    <i class="fa fa-medkit fa-3x"></i>
                                </div>

                                <div class="pr-3">
                                    <h2 class="text-right">Box Status</h2>
                                    <div class="text-muted">

                                        @if($box->status == 1)
                                        Secured
                                        @elseif($box->status ==2)
                                        Signed Out
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </a>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-striped">
                            <thead>
                            <tr>
                                <th>Vial ID</th>
                                <th>Drug</th>
                                <th>Lot Number</th>
                                <th>Exp Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$medications)
                            <tr>
                                <td colspan="3">No Medications Assigned</td>
                            </tr>
                            @else
                            @foreach($medications as $medication)
                            <tr>
                                <td><a href="/controlled/{{$medication->id}}">V-{{sprintf('%08d', $medication->id )}}</a></td>
                                <td>{{$medication->medications->trade_name}}</td>
                                <td>{{$medication->lot_number}}</td>
                                <td>{{date('m-d-Y', strtotime($medication->expiration))}}</td>
                            </tr>
                            <tr>
                                <td>NDC #</td>
                                <td>{{$medication->ndc_number or ''}}</td>
                                <td>Dose Avail</td>
                                <td>{{$medication->dose or 'Unknown'}}</td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Employee</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(!$box->waste)
                            <tr>
                                <td colspan="3">No Waste Forms Found</td>
                            </tr>
                            @else
                            @foreach($waste as $row)
                            <tr>
                                <td><a href="/narcoticwaste/{{$row->id}}">{{date('m-d-Y', strtotime($row->created_at))}}</a></td>
                                <td>{{$row->employee->first_name }} {{$row->employee->last_name }}</td>
                            </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='col-lg-2 col-sm-12'>
        <button type="button" class="btn btn-deep-orange" data-toggle="modal" data-target="#basicExampleModal2">Add
            Note
        </button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#basicExampleModal4">Add New
            Medication
        </button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#basicExampleModal3">Seal Change
        </button>

    </div>


    <div class="col-12">
        <hr style="border-color: #A9A9A9; padding: 15px;">
    </div>

</div>

<div class="row">
    <div class="col-lg-5 col-sm-12">

        <!--Panel-->
        <div class="card text-center">
            <div class=" card-header elegant-color white-text">
                Sign Out Log
            </div>
            <div class="card-body">
                <div class="list-group">
                    @foreach($logs as $log)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{date('m-d-Y H:i', strtotime($log->created_at))}}</h5>
                        </div>
                        <div class="col-12">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Employee</th>
                                    <th>Time</th>
                                    <th>Seal</th>
                                    <th>Tamper</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>Out</td>
                                    <td>@if(!$log->employees) Unknown @else{{$log->employees->first_name or ''}}
                                        {{$log->employees->last_name or 'unknown'}}/{{$log->witnessout->first_name or ''}}
                                        {{$log->witnessout->last_name or 'unknown'}} @endif
                                    </td>
                                    <td>@if(!$log->time_out) Unknown @else{{date('m-d H:i',strtotime($log->time_out))}}
                                        @endif
                                    </td>
                                    <td>@if(!$log->seal) Unknown @else{{$log->seal}} @endif</td>
                                    <td>@if(!$log->tamper_seal) Unknown @else{{$log->tamper_seal}} @endif</td>
                                </tr>
                                <tr>
                                    <td>In</td>
                                    <td>@if(!$log->employeesin) Unknown @else{{$log->employeesin->first_name or ''}}
                                        {{$log->employeesin->last_name or 'unknown'}} / {{$log->witnessin->first_name or ''}}
                                        {{$log->witnessin->last_name or 'unknown'}} @endif
                                    </td>
                                    <td>@if(!$log->time_in) Unknown @else{{date('m-d H:i',strtotime($log->time_in))}}
                                        @endif
                                    </td>
                                    <td>@if(!$log->seal_in) Unknown @else{{$log->seal_in}} @endif</td>
                                    <td>@if(!$log->tamper_seal_in) Unknown @else{{$log->tamper_seal_in}} @endif</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </a>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-muted elegant-color white-text">
                <p class="mb-0">{{ $logs->links() }}</p>
            </div>
        </div>
        <!--/.Panel-->

    </div>

    <div class="col-lg-4 col-sm-12">
        <!--Panel-->
        <div class="card text-center">
            <div class=" card-header indigo darken-4 white-text">
                Seal History
            </div>
            <div class="card-body">
                @foreach($seals as $seal)
                <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h6 class="mb-1">Changed By: @if($seal->employee == 0) System Note @elseif(!$seal->employees)
                            Unknown @else{{$seal->employees->first_name}} {{$seal->employees->last_name}} @endif Date
                            Changed: {{date('m-d-Y H:i', strtotime($seal->created_at))}}</h6>
                    </div>
                    <div class="col-12">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>Old Seal</th>
                                <th>New Seal</th>
                                <th>Old Tamper</th>
                                <th>New Tamper</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{$seal->seal}}</td>
                                <td>{{$seal->new_seal}}</td>
                                <td>{{$seal->tamper_seal}}</td>
                                <td>{{$seal->new_tamper_seal}}</td>
                            </tr>
                            </tbody>
                        </table>

                        <small>
                            Reason for Change:

                            @if($seal->reason == 1)
                            New Box
                            @elseif($seal->reason == 2)
                            Medication Used
                            @elseif($seal->reason == 3)
                            Broken Seal Replacement
                            @elseif($seal->reason == 4)
                            Expired Drug Replacement
                            @elseif($seal->reason == 5)
                            Box Audit
                            @else
                            Unknow Reason
                            @endif
                        </small>

                    </div>
                </a>
                @endforeach
            </div>
            <div class="card-footer text-muted indigo darken-4 white-text">
                <p class="mb-0">{{ $seals->links() }}</p>
            </div>
        </div>
        <!--/.Panel-->
    </div>

    <div class="col-lg-3 col-sm-12">

        <!--Panel-->
        <div class="card text-center">
            <div class=" card-header deep-orange darken-3 white-text">
                Box Notes
            </div>
            <div class="card-body">
                <div class="list-group">

                    @foreach($notes as $note)
                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">@if($note->added_by == 0) System Note @elseif(!$note->employees) Unknown
                                @else{{$note->employees->first_name}} {{$note->employees->last_name}} @endif</h5>
                                
                                <span class="badge badge-primary badge-pill">{{date('m/d/y H:i', strtotime($note->created_at))}}</span>
                        </div>
                        <div class="col-12">
                            {!!$note->note!!}
                        </div>

                    </a>
                    @endforeach
                </div>
            </div>
            <div class="card-footer text-muted deep-orange darken-3 white-text">
                <p class="mb-0">{{ $notes->links() }}</p>
            </div>
        </div>
        <!--/.Panel-->
    </div>
</div>


<!--Modal for Adding Notes-->

<!-- Modal -->
<div class="modal fade" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add Encounter Note</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('boxnote.store'), 'method' => 'POST']) !!}
                @csrf

                <div class="form-group">
                    <label for="note">Box Note</label>
                    <textarea class="form-control rounded-0" id="note" name="note" rows="3"></textarea>
                </div>
                <input type="hidden" name="box" value="{{$box->id}}">
                <button class="btn btn-info btn-block my-4" type="submit">Add New Note</button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>


<!--Modal for Changing Seal-->

<!-- Modal -->
<div class="modal fade" id="basicExampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel3">Change Seal Data for Box</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('seallog.store'), 'method' => 'POST']) !!}
                @csrf
                <select class="mdb-select md-form" name="reason">
                    <option value="" disabled selected>Select Reason for Change</option>

                    <option value="1">New Box</option>
                    <option value="2">Medication Used</option>
                    <option value="3">Broken Seal</option>
                    <option value="4">Expired Drug</option>
                    <option value="5">Audit</option>

                </select>


                <input type="hidden" id="box" name="box" class="form-control" value="{{$box->id}}">
                <div class="md-form">
                    <input type="text" id="box" name="seal" class="form-control" value="{{$box->seal}}">
                    <label for="box">Confirm Old Seal</label>
                </div>

                <div class="md-form">
                    <input type="text" id="box" name="tamper_seal" class="form-control" value="{{$box->tamper_seal}}">
                    <label for="tamper_seal">Confirm Old Tamper Seal</label>
                </div>


                <div class="md-form">
                    <input type="text" id="new_seal" name="new_seal" class="form-control">
                    <label for="new_seal">New Seal</label>
                </div>

                <div class="md-form">
                    <input type="text" id="new_tamper_seal" name="new_tamper_seal" class="form-control">
                    <label for="new_tamper_seal">New Tamper Seal</label>
                </div>


                <button class="btn btn-info btn-block my-4" type="submit">Change Seal Data</button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

<!--Modal for Adding New Rx-->

<!-- Modal -->
<div class="modal fade" id="basicExampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel4"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Add New Medication to Box</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('boxnewmed'), 'method' => 'POST']) !!}
                @csrf
                <select class="mdb-select md-form" name="med" searchable="Search here..">
                    <option value="" disabled selected>Select Reason for Change</option>
                    @foreach($cs as $id => $info)
                    <option value="{{$id}}">{{$info}}</option>
                    @endforeach

                </select>

                <input type="hidden" name="box" value="{{$box->id}}">


                <button class="btn btn-info btn-block my-4" type="submit">Add New Medicationt</button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
@stop

@section('styles')

@stop

@section('scripts')

@stop