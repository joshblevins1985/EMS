@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active" xmlns:Comments="http://www.w3.org/1999/xhtml">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')

<div class="row">
    <div class="col-lg-8">
        <!--Card-->
        <div class="card">

            <!--Card content-->
            <div class="card-body">
                <!--Title-->
                <h1 class="card-title">Patient Care Report Information -
                    @if($brs->status == 1)
                    Uploaded
                    @elseif($brs->status == 2)
                    Employee notified by email.
                    @elseif($brs->status == 3)
                    Acknowledged by Employee
                    @elseif($brs->status == 4)
                    Uploaded back to billing by employee
                    @elseif($brs->status == 5)
                    Run sheet addendum completed.
                    @else
                    Unknown status contact web developer.
                    @endif</h1>
                <hr>
                <!--Text-->
                <div class="row">

                    <div class="col-lg-3">
                        Authoring Employee:
                    </div>
                    <div class="col-lg-3">
                        {{$brs->Employee->first_name or 'Unknown - Contact web developer.'}} {{$brs->Employee->last_name or ''}}
                    </div>
                    <div class="col-lg-3">
                        PCR ID #:
                    </div>
                    <div class="col-lg-3">
                        {{$brs->pcr_number}}
                    </div>
                    <div class="col-lg-12">
                        <h4>Comments:</h4>
                    </div>
                    <div class="col-lg-12">
                        {!!$brs->comments!!}
                    </div>

                </div>
            </div>

        </div>
        <!--/.Card-->

        <!--Card-->
        <div class="card">

            <!--Card content-->
            <div class="card-body">
                <!--Title-->
                <h1 class="card-title">Audit Trail</h1>
                <hr>
                <!--Text-->
                <table class="table">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Added By</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brs->Audit as $row)
                    <tr>
                        <td>
                            @if($row->status == 1)
                            Uploaded
                            @elseif($row->status == 2)
                            Employee notified by email.
                            @elseif($row->status == 3)
                            Acknowledged by Employee
                            @elseif($row->status == 4)
                            Uploaded back to billing by employee
                            @elseif($row->status == 5)
                            Run sheet addendum completed.
                            @else
                            Unknown status contact web developer.
                            @endif
                        </td>
                        <td>{{$row->employee->first_name or 'Unknown - Contact web developer'}} {{$row->employee->last_name}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <!--/.Card-->
    </div>

    <div class="col-lg-4">
        @if($brs->status == 1)

        {!! Form::open(['url' => route('badrunsheets.oneclick', $brs->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $brs->id) }}
        {{ Form::hidden('status', '2') }}

        <button type="submit"  class="btn-link"><span class="badge badge-pill red">Uploaded</span></button>

        {!! Form::close() !!}
        @elseif($brs->status == 2)
        {!! Form::open(['url' => route('badrunsheets.oneclick', $brs->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $brs->id) }}
        {{ Form::hidden('status', '3') }}

        <button type="submit" class="btn btn-outline-primary btn-rounded waves-effect">By selecting this button I acknowledge that I have received notification to correct this patient care report.</button>

        {!! Form::close() !!}
        @elseif($brs->status == 3)
        {!! Form::open(['url' => route('badrunsheets.oneclick', $brs->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $brs->id) }}
        {{ Form::hidden('status', '4') }}

        <button type="submit" class="btn btn-outline-secondary btn-rounded waves-effect">By selecting this button I acknowledge that I have uploaded the completed addendum to the billing department.</button>

        {!! Form::close() !!}
        @elseif($brs->status == 4)
        {!! Form::open(['url' => route('badrunsheets.oneclick', $brs->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $brs->id) }}
        {{ Form::hidden('status', '5') }}

        <button type="submit" class="btn btn-outline-success btn-rounded waves-effect">By selecting this button I as part of the billing team acknowledge that I have received the updated addendum from the employee and it is complete.</button>

        {!! Form::close() !!}
        @elseif($brs->status == 5)
        <button type="button" class="btn btn-outline-success btn-rounded waves-effect">This patient care report and addendum has been completed as requested.</button>
        @endif
    </div>
</div>

@stop

@section('styles')

@stop

@section('scripts')

<script>
    // Data Picker Initialization
    $('.datepicker').pickadate();
</script>
@stop