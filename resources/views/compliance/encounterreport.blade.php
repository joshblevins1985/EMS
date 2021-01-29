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
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Total Count</th>
            </tr>

            </thead>

            <tbody>
            @foreach($encounters as $row)
            <tr>
                <td>{{$row->employee->first_name}}  {{$row->employee->last_name}}</td>
                <td>{{$row->total}}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('styles')

@stop

@section('scripts')


@stop