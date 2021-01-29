@extends('layouts.app')

@section('page-title', trans('Edit Task'))
@section('page-heading', trans('Edit Task'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Tasks')
    </li>
@stop

@section('content')

    @include('partials.toastr')
    <div class="row">
        <div class="col-lg-6">
            <!--Card Primary-->
            <div class="card z-depth-2">
                <div class="card-body">
                    <h3 class="text-uppercase font-weight-bold amber-text mt-2 mb-3"><strong>{{$task->task_label->label}} - {{$task->comments}}</strong></h3>
                    <div class="row">
                        <div class="col-lg-6">
                            Reported By:
                        </div>
                        <div class="col-lg-6">
                            <a href = "mailto: {{$task->report->reported_by->email}}">{{$task->report->reported_by->first_name}} {{$task->report->reported_by->last_name}}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            Unit Number:
                        </div>
                        <div class="col-lg-6">
                            {{$task->unit->unit_number}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            Mileage:
                        </div>
                        <div class="col-lg-6">
                            {{$task->report->mileage}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            Description:
                        </div>
                        <div class="col-lg-6">
                            {!!$task->report->comments!!}
                        </div>
                    </div>

                </div>
            </div>
            <!--/.Card Primary-->
            
            <!--Card Primary-->
            <div class="card z-depth-2">
                <div class="card-body">
                    <h3 class="text-uppercase font-weight-bold red-text mt-2 mb-3"><strong>Mechanic Notes</strong></h3>
                    
                   <table class="table table-striped">
                       <thead>
                           <tr>
                                <th>Date</th>
                               <th>Note</th>
                               <th>Mechanic</th>
                            </tr>
                       </thead>
                       <tbody>
                           @foreach($task->notes as $row)
                           <tr>
                               <td>{{ Carbon\Carbon::parse($row->created_at)->format('m-d-Y') }}</td>
                               <td>{{ $row->note }}</td>
                               <td>{{ $row->employee->first_name }} {{ $row->employee->last_name }}</td>
                           </tr>
                           @endforeach
                       </tbody>
                   </table>

                </div>
            </div>
            <!--/.Card Primary-->
        </div>

        <div class="col-lg-6">
            <!--Card Primary-->
            <div class="card  z-depth-2">
                <div class="card-body">
                    {!! Form::open(['url' => route('mechanic.update', $task->id), 'method' => 'POST']) !!}
                    @method('PUT')
                    @include('mechanic.partials.taskform')

                    {!! Form::close() !!}
                </div>
            </div>
            <!--/.Card Primary-->
        </div>
    </div>

@stop

@section('styles')

@stop

@section('scripts')

@stop