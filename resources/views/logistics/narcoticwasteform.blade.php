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

        <div class="col-sm">
            {!! Form::open(['route' => ['narcoticwaste.update', $waste->id], 'id' => 'narcoticwaste-form']) !!}
            @method('PUT')
            {{csrf_field()}}
            <div class="col-sm">
            <h5>Date:</h5>
            </div>
                <div class="col-sm">
                    {{date('m-d-Y H:i', strtotime($waste->created_at))}}
                </div>
        </div>
        <div class="col-sm">

                <div class="col-sm">
                    <h5>Station:</h5>
                </div>
                <div class="col-sm">
                    {{$waste->stationinfo->station or 'Unknown'}}
                </div>
        </div>
        <div class="col-sm">

                <div class="col-sm">
                    <h5>Crew:</h5>
                </div>
                <div class="col-sm">
                    Attendant: {{$waste->employee->first_name}} {{$waste->employee->last_name}} -- {{$waste->employee->eid}}
                </div>
                <div class="col-sm">
                    Driver:
                    <select class="mdb-select" id="driver" name="driver" searchable="Search here.." >
                        <option value="" disabled selected>Choose Employee</option>
                        @foreach($employees as $id => $employee_name)
                            <option value="{{$id}}">{{$employee_name}}</option>
                        @endforeach
                    </select>
                </div>
        </div>

    </div>
    <hr>
    <div class="row">

        <div class="col-sm">
                <div class="col-sm">
                    <h5>Patient Name:</h5>
                </div>
                <div class="col-sm">
                    <div class="mb-form">
                        <input type="text" class="form-control" id="patient_name" name="patient_name" required></input>
                        <label for="attending">Patient's name</label>
                    </div>
                </div>
        </div>


    </div>
    <hr>
    <div class="row">

        <div class="col-sm">
            <div class="col-sm">
                <h5>Transport Reason:</h5>
            </div>
            <div class="col-sm">
                <div class="mb-form">
                    <input type="text" class="form-control" id="transport" name="transport" required></input>
                    <label for="attending">Reason for Transport</label>
                </div>
            </div>
        </div>

        <div class="col-sm">
            <div class="col-sm">
                <h5>Administration Reason:</h5>
            </div>
            <div class="col-sm">
                <div class="mb-form">
                    <input type="text" class="form-control" id="administration" name="administration" required></input>
                    <label for="attending">Reason the drug was administered.</label>
                </div>
            </div>
        </div>


    </div>
    <hr>
    <div class="row">

        <div class="col-sm">
            <div class="col-sm">
                <h5>Box ID:</h5>
            </div>
            <div class="col-sm">
                {{$waste->boxinfo->box_number}}
            </div>
        </div>

        <div class="col-sm">
            <div class="col-sm">
                <h5>Old Seal</h5>
            </div>
            <div class="col-sm">
                {{$waste->seal}}
            </div>
        </div>

        <div class="col-sm">
            <div class="col-sm">
                <h5>Old Tamper Seal</h5>
            </div>
            <div class="col-sm">
                {{$waste->tamper_seal}}
            </div>
        </div>

        <div class="col-sm">
            <div class="col-sm">
                <h5>New Seal</h5>
            </div>
            <div class="col-sm">
                {{$waste->new_seal}}
            </div>
        </div>

    </div>
    <hr>
    <div class="row">

        <div class="col-sm">
            <div class="col-sm">
                <h5>Drug Used:</h5>
            </div>
            <div class="col-sm">
                Vial ID: {{sprintf('%08d', $waste->vial->id )}} -- {{$waste->vial->medications->trade_name}}
            </div>
        </div>

        <div class="col-sm">
            <div class="col-sm">
                <h5>Amount Used</h5>
            </div>
            <div class="col-sm">
                {{$waste->used}}
            </div>
        </div>

        <div class="col-sm">
            <div class="col-sm">
                <h5>Amount Wasted</h5>
            </div>
            <div class="col-sm">
                {{$waste->waste}}
            </div>
        </div>



    </div>
    <hr>
    <div class="row">

        <div class="col-sm">
            <div class="col-sm">
                <h5>Employee Administered by Signature:</h5>
            </div>
            <div class="col-sm">
                Electronically Obtained: {{$waste->employee->first_name}} {{$waste->employee->last_name}} -- {{$waste->employee->eid}}  on {{date('m-d-Y H:i', strtotime($waste->created_at))}}
            </div>
        </div>

        <div class="col-sm">
            <div class="col-sm">
                <h5>Name of Witness</h5>
            </div>
            <div class="col-sm">
                <div class="mb-form">
                    <input type="text" class="form-control" id="witness" name="witness" required></input>
                    <label for="witness">Name of Witness.</label>
                </div>
            </div>
        </div>

    </div>

    <hr>
    <div class="row">

        <button class="btn btn-primary btn-block my-4" type="submit">Update Narcotic Use Form</button>

    </div>


    {!! Form::close() !!}
@stop

@section('styles')

@stop

@section('scripts')

@stop