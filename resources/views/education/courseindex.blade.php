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


<div class="row-fluid">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Course ID</th>
                <th>Course Name</th>
                <th>Location</th>
                <th>Base Level</th>
                <th>Category</th>
                <th>Hours Awarded</th>
                <th>Orientation Course</th>
                <th>Renews</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @include('education.partials.courserow')
        </tbody>
        </table>
    {{ $courses->links() }}
</div>

@stop

@section('styles')

@stop
@section('scripts')


@stop