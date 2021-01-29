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
    <h1>Narcotic Waste Forms</h1>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <th>Date Used</th>
                <th>Station</th>
                <th>Attending EMT</th>
                <th>Patient</th>
                <th>Vial</th>
                <th>Medication</th>
                <th>Used</th>
                <th>Wasted</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($wastes as $row)
                <tr>
                    <th>{{ Carbon\Carbon::parse($row->created_at)->format('m-d-Y H:i') }}</th>
                    <td>{{$row->stationinfo->station or 'Unknown'}}</td>
                    <td>{{$row->employee->first_name or 'Unknown'}} {{$row->employee->last_name or ''}}</td>
                    <td>{{$row->patient_name or 'Unknown'}}</td>
                    <td>{{sprintf('%08d', $row->vial_id )}}</td>
                    <td>{{$row->vial->Medications->trade_name}}</td>
                    <td>{{$row->used}}</td>
                    <td>{{$row->waste}}</td>
                    <td>
                        @permission('view.rx')
                        <div class="dropdown show d-inline-block">
                <a class="btn btn-icon"
                   href="#" role="button" id="dropdownMenuLink"
                   data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </a>
    
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
    
                    <a href="narcoticwaste/{{$row->id}} " class="dropdown-item text-gray-500">
                        <i class="fas fa-eye mr-2"></i>
                        View Rx Information
                    </a>
                </div>
            </div>
            @endpermission
            
            @permission('edit.rx')
            <a href="narcoticwaste/{{$row->id}}/edit"
               class="btn btn-icon edit"
               title="Edit Incident"
               data-toggle="tooltip" data-placement="top">
                <i class="fas fa-edit"></i>
            </a>
            @endpermission
            
            @permission('delete.rx')
            <a href="{{ route('narcoticwaste.destroy', $row->id) }}"
               class="btn btn-icon bg-danger"
               title="@lang('Delete Narcotic Box')"
               data-toggle="tooltip"
               data-placement="top"
               data-method="DELETE"
               data-confirm-title="@lang('app.please_confirm')"
               data-confirm-text="Are you sure you want to delete this medication"
               data-confirm-delete="@lang('Yes delete this medication.')">
                <i class="fas fa-trash"></i>
            </a>
            @endpermission
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    {{ $wastes->appends(request()->input())->links() }}
</div>

@stop

@section('styles')

@stop

@section('scripts')

@stop