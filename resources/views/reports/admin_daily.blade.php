@extends('layouts.reports')

@section('content')

<div class="row">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Station</th>
                <th>Total</th>
                <th>Uploaded</th>
                <th>Notified</th>
                <th>Acknowledged</th>
                <th>Billing</th>
            </tr>
        </thead>
        <tbody>
            @foreach($brs as $row)
                <tr>
                    <td>{{$row->station}}</td>
                    <td>{{$row->count}}</td>
                    <td>{{$row->uploaded}}</td>
                    <td>{{$row->notified}}</td>
                    <td>{{$row->acknowledged}}</td>
                    <td>{{$row->billing}}</td>
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