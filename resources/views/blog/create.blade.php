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
<div class="row-fluid" style="height: 100%; overflow:visible;">

    <form action="/blog" method="POST" id="blog-form" enctype="multipart/form-data">
        @csrf

        @include('blog.partials.form')

    </form>
</div>
@stop

@section('styles')
    <link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
@stop
 
@section('scripts')
    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>

    <script>
        var handleSelect2 = function() {
            $(".default-select2").select2();
            $("#employees").select2({ placeholder: "Select Employees to send to" });
            $("#companies").select2({ placeholder: "Select Companies to send to" });
            $("#stations").select2({ placeholder: "Select Stations to send to" });
        };

        var FormPlugins = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleSelect2();
                }
            };
        }();

        $(document).ready(function() {
            FormPlugins.init();
        });
    </script>
@stop