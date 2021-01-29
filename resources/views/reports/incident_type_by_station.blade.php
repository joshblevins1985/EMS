@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Create Employee')
    </li>
@stop

@section('content')

@include('partials.toastr')

<div class ="row">
    <h1>Incident Type Count Report {{$station->station}}</h1>
</div>

<div class="row">
<table class="table table-striped">
    <thead>
        <tr>
            <th>Incident Type</th>
            <th>Total Count</th>
        </tr>
    </thead>
    <tbody>
        @foreach($type as $row)
        <tr>
            <td>{{$row->title}}</td>
            <?php $count = Vanguard\QaQi::with(['employee' => function ($q) use($station){$q->where('primary_station', $station->id );}])->where('protocol', $row->id)->count(); ?>
            <td>{{$count}}</td>
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