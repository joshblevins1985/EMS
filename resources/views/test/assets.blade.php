@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')

@stop

@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <th>Description</th>
            <th>ID</th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($assets as $asset)
        
        <tr>
            <td>{{ $asset['Description'] }}</td>
            <td>{{ $asset['ID'] or '' }}</td>
        </tr>
        @endforeach
    </tbody>
    
</table>

@stop

@section('styles')

@stop

@section('scripts')

@stop