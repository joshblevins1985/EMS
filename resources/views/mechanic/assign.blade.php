@extends('layouts.app')

@section('page-title', trans('Mechanic Tasks'))
@section('page-heading', trans('Maintanance Tasks'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Mechanic Tasks')
</li>
@stop

@section('content')

@include('partials.toastr')

<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="card unique-color">
                <div class="card card-body">
                    <h4 class="card-title">Available Mechanics</h4>
                    <div class="card-text">


                        </div>
                    </div>

                </div>
            </div>
       
        <div class="row">
            @foreach($mechanics as $row)
            <div class="col-lg-4">
                <!--Panel-->
                <div class="card">
                    <div class="card card-body">
                        <h4 class="card-title">{{$row->first_name}} {{$row->last_name}}</h4>
                        <div class="card-text">
                            <div id="assigned_tasks{{$row->id}}" class="col-lg-12">

                            </div>
                        </div>

                    </div>
                </div>

                <!--/.Panel-->
            </div>
            @endforeach
        </div>


    </div>
    <div class="col-lg-4" >
        <div class="row">
            <div class="card unique-color">
                <div class="card card-body">
                    <h4 class="card-title">Pending Tasks</h4>
                    <div class="card-text">
                        <div id="assigned_tasks{{$row->id}}" class="col-lg-12">

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row">
            @foreach($tasks as $row)
            <?php
            if($row->status == 1){
                $color= "danger-color-dark";
            }elseif($row->status == 2){
                $color= "warning-color-dark";
            }elseif($row->status == 3){
                $color= "primary-color-dark";
            }elseif($row->status == 4){
                $color= "info-color-dark";
            }elseif($row->status == 5){
                $color= "success-color-dark";
            }
            ?>
            <div class="col-lg-12">
                <!--Panel-->
                <div class="card {{$color}}">
                    <div class="card card-body">
                        <h4 class="card-title">{{$row->task_label->label}}</h4>
                        <div class="card-text">
                            <div id="assigned_tasks{{$row->id}}" class="col-lg-12">

                            </div>
                        </div>

                    </div>
                </div>

                <!--/.Panel-->
            </div>
            @endforeach
        </div>


    </div>

</div>
@stop

@section('styles')

@stop

@section('scripts')

@stop