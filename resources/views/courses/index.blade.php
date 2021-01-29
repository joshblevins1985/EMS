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
      <!-- Grid column -->
    <div class="col-lg-6 col-md-6">

        <!--Panel-->
        <div class="card text-center">
            <div class="card-header danger-color white-text">
                Required Courses
            </div>
            <div class="card-body">
                @include('courses.partials.required_courses')
            </div>
            <div class="card-footer text-muted danger-color white-text">
                <p class="mb-0"></p>
            </div>
        </div>
        <!--/.Panel-->

    </div>
    <!-- Grid column -->
    
     <!-- Grid column -->
    <div class="col-lg-6 col-md-6">

        <!--Panel-->
        <div class="card text-center">
            <div class="card-header primary-color white-text">
                Available Courses
            </div>
            <div class="card-body">
                @include('courses.partials.courses')
                {{ $courses->links() }}
            </div>
            <div class="card-footer text-muted primary-color white-text">
                <p class="mb-0"></p>
            </div>
        </div>
        <!--/.Panel-->

    </div>
    <!-- Grid column -->
 </div>


@stop

@section('styles')

@stop

@section('scripts')
<script>
    $("#status").change(function () {
        $("#employee-form").submit();
    });
</script>
@stop