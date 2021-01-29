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
            <h1>Narcotic {{$station->station}} Station Box Report</h1>
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
            </table>
        </div>
    </div>
@foreach($log as $row)
    <div class="row">
        <h2>{{ $row->box_number }}</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Employee Out</th>
                    <th>Time Out</th>
                    <th>Employee In</th>
                    <th>Time In</th>
                </tr>
                @foreach($row->NarcoticLog as $nl)
                <tr>
                    
                    <td>{{$nl->Employees->first_name}} {{$nl->Employees->last_name}}</td>
                    <td>{{ Carbon\Carbon::parse($nl->time_out)->format('m-d-Y H:i') }}</td>
                    <td>{{$nl->EmployeesIn->first_name or ''}} {{$nl->EmployeesIn->last_name or 'Checked Out'}}</td>
                    <td>{{ Carbon\Carbon::parse($nl->time_in)->format('m-d-Y H:i') }}</td>
                </tr>
                @endforeach
            </thead>
        </table>
    </div>
    <hr>
    @endforeach

@stop

@section('styles')

@stop

@section('scripts')

@stop