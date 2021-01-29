@extends('layouts.app')

@section('page-title', trans('New Class'))
@section('page-heading', trans('New Class Form'))
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xtyhuf4jcvx14hba5xdmoird6al6xaza7rz13b4c0ic8po15"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Employee Encounter')
</li>
@stop

@section('content')

@include('partials.messages')

<div class="row-fluid" style="height: 100%; overflow:visible;">
    {!! Form::open(['url' => route('classes.store'), 'method' => 'POST']) !!}
   
@include('classes.partials.classform')

{!! Form::close() !!}
</div>

@stop

@section('styles')

@stop

@section('scripts')
<script>
        $(document).ready(function() {
            $('.ir').summernote();
        });
</script>
@stop