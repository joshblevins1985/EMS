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

<div class="row">
    
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Station</th>
                    <th>Address</th>
                    <th>Management</th>
                    <th>Total Employees</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stations as $row)
                <tr>
                    <td><strong>{{$row->station}}</strong></td>
                    <td>
                        <address>
                      {{$row->house_number}} {{$row->route}}<br>
                      {{$row->locality}}, {{$row->state}} {{$row->postal_code}}<br>

                    </address>
                    </td>
                    <td>
                        <div class="row">
                            Regional: {{$row->Regional->first_name or ''}} {{$row->Regional->last_name or 'None'}}
                        </div>
                        <div class="row">
                            Phone:
                        </div>
                        <div class="row">
                            Regional: {{$row->mgr->first_name or ''}} {{$row->mgr->last_name or 'None'}}
                        </div>
                        <div class="row">
                           Phone:
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            Active: {{count($row->employees)}}
                        </div>
                        <div class="row">
                            COMP:
                        </div>
                        <div class="row">
                            FMLA:
                        </div>
                        </td>
                </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@stop

@section('styles')
<style>
    .btn-link {
        border: none;
        outline: none;
        background: none;
        cursor: pointer;
        color: #0000EE;
        padding: 0;
        text-decoration: underline;
        font-family: inherit;
        font-size: inherit;
    }
</style>

<style>
    ul.horizontal-fix li a {
        padding: .84rem 2.14rem;
    }
</style>

<!-- Stepper CSS -->

@stop

@section('scripts')





@stop