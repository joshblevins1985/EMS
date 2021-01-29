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

<div class="row">
    <div class="col-lg-12">

        <!--Panel-->
        <div class="card card-body">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-4">
                            Title:
                        </div>
                        <div class="col-lg-8">
                            {{$policy->title}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            Policy #:
                        </div>
                        <div class="col-lg-8">
                            {{$policy->policy_number}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            Date of Issue:
                        </div>
                        <div class="col-lg-8">
                            {{ Carbon\Carbon::parse($policy->date_effective)->format('m/d/Y') }}
                        </div>
                    </div>



                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-4">
                            Date of Review:
                        </div>
                        <div class="col-lg-8">
                            {{ Carbon\Carbon::parse($policy->last_reviewed)->format('m/d/Y') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--/.Panel-->

    </div>
</div>

<!--Panel-->
<div class="card card-body">
    <div class="row">
        <div class="col-lg-12">
            <h2>Overview</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!!$policy->purpose!!}

        </div>
    </div>
</div>
<!--/.Panel-->

<!--Panel-->
<div class="card card-body">
    <div class="row">
        <div class="col-lg-12">
            <h2>Scope</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!!$policy->scope!!}

        </div>
    </div>
</div>
<!--/.Panel-->

<!--Panel-->
<div class="card card-body">
    <div class="row">
        <div class="col-lg-12">
            <h2>Policy</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!!$policy->policy!!}

        </div>
    </div>
</div>
<!--/.Panel-->

<!--Panel-->
<div class="card card-body">
    <div class="row">
        <div class="col-lg-12">
            <h2>Procedure</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">


        </div>
    </div>
</div>
<!--/.Panel-->

<!--Panel-->
<div class="card card-body">
    <div class="row">
        <div class="col-lg-12">
            <h2>Approved by:</h2>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            Electronic Signature
            @if(Auth::User()->id == 1046)
                @if(empty($policy->signature))
            By clicking the button below you are electronically you are signing and approving this policy electronically.

            <form  action="/policy/acknowledge/{{$policy->id}}" method="POST" >
                {{csrf_field()}}

                <input type="hidden" name="id" value="{{$policy->id}}">

                <hr>

                <button type="submit" class="btn btn-outline-danger btn-rounded waves-effect btn-block">I confirm I approve this policy as written.</button>
            </form>
            @else
                
            @endif
            @endif
            
        </div>
    </div>
</div>
<!--/.Panel-->


@stop

@section('styles')

@stop

@section('scripts')

@stop