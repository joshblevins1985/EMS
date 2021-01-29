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
    <div class="col-lg-4">
        {{$employee->first_name}} {{$employee->last_name}}
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Occurance Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employee->attendance as $row)
                <tr>
                    <td>{{$row->date}}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop

@section('styles')

@stop

@section('scripts')
<script>
    $(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@stop