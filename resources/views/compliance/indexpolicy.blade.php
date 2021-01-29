@extends('layouts.app')

@section('page-title', trans('Policies'))
@section('page-heading', trans('Policies'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Policies')
</li>
@stop

@section('content')

@include('partials.toastr')

<!--Panel-->
<div class="card text-center">
    <div class="card-header danger-color white-text">
        <h2>Company Policies</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-11">
                
            </div>
            <div class="col-1">
                <a class="btn-floating btn-sm blue-gradient" href="policies/create"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>
</div>


<!--/.Panel-->

<!--Panel-->
<div class="card text-center">

    <div class="card-body">
        <table class="table">
            <thead>
            <tr>
                <th>Policy Number</th>
                <th>Policy Title</th>
                <th>Effective Date</th>
                <th>Last Review</th>
                <th>Terminated Date</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @if(count($policies))
            @foreach($policies as $row)

            <tr>
                <td>{{$row->policy_number}}</td>
                <td>{{$row->title}}</td>
                <td>{{ Carbon\Carbon::parse($row->date_effective)->format('m/d/Y') }}</td>
                <td>{{ Carbon\Carbon::parse($row->last_reviewed)->format('m/d/Y') }}</td>
                <td> @if($row->date_terminated) {{ Carbon\Carbon::parse($row->date_terminated)->format('m/d/Y') }} @else Active @endif</td>
                <td>

                    <div class="dropdown show d-inline-block">
                        <a class="btn btn-icon"
                           href="#" role="button" id="dropdownMenuLink"
                           data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-h"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                            <a href="policies/{{$row->id}} " class="dropdown-item text-gray-500">
                                <i class="fas fa-eye mr-2"></i>
                                View Policy
                            </a>
                        </div>
                    </div>

                    <a href="policies/{{$row->id}}/edit "
                       class="btn btn-icon edit"
                       title="Edit Incident"
                       data-toggle="tooltip" data-placement="top">
                        <i class="fas fa-edit"></i>
                    </a>
                                     
                </td>
            </tr>

            @endforeach
            @else
            <tr><td colspan=5><h2>No Bad Run Sheets Found</h2></td></tr>
            @endif


            </tbody>
        </table>
    </div>
    {{ $policies->links() }}
</div>
<!--/.Panel-->

@stop

@section('styles')

@stop

@section('scripts')

@stop