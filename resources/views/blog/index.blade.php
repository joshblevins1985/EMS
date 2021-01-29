@extends('layouts.app')

@section('page-title', trans('Training Blog'))
@section('page-heading', trans('Training Blog'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Training Block')
</li>
@stop

@section('content')

@include('partials.messages')

<!-- Section: Blog v.3 -->
<section class="my-5">

<a href="blog/create"><button type="button" class="btn btn-primary">Add New Blog</button></a>
</section>

<!-- Section: Blog v.3 -->
<section class="my-5">

  <!-- Section heading -->
  <h2 class="h1-responsive font-weight-bold text-center my-5">Recent Training Posts</h2>
  <!-- Section description -->
  <p class="text-center dark-grey-text w-responsive mx-auto mb-5"></p>

@foreach($blog as $row)
@include('blog.partials.row')
@endforeach



</section>
<!-- Section: Blog v.3 -->

@stop

@section('styles')

@stop

@section('scripts')



@stop