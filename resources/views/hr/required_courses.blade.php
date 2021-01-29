@extends('layouts.app')

@section('page-title', trans('Human Resources'))
@section('page-heading', trans('Human Resources'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Human Resources')
</li>
@stop

@section('content')

@include('partials.toastr')

@foreach($courses as $row)
@foreach($row->instructed->where('required', 1) as $i)
<div class="row">
    <h2>{{$i->course->title}}</h2>
</div>
<div class="row">
    <div class="col-6">
        <h3>Employees Completed</h3>
        @foreach($i->complete as $c)
                            
        <p>{{$c->employee->last_name or $c->id}}, {{$c->employee->first_name or $c->id}}</p>
        
        @endforeach
    </div>
    <div class="col-6">
        <h3>Employees Pending</h3>
    </div>
</div>
@endforeach
@endforeach




@stop

@section('styles')


@stop

@section('scripts')



@stop