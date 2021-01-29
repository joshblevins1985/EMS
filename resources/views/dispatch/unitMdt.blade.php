@extends('layouts.defaultEmpty')

@section('title', 'Unit MDT')

@push('css')

<style>
    #outer {
  width: 100%;
  height: 100vh;
  display: flex;
}

#inner {
  margin: auto;
}
</style>
@endpush

@section('content')
@include('partials.messages')

@if (Cookie::get('unitId') !== null)
    @include('dispatch.partials.unitMdtIncidents')
@else

<div class="row pb-2">

        <div class="col-lg-6">
        
            <form class="form-inline" role="search" method="post" action="/dispatch/unitMDT">

          @csrf
         <input type="text" class="form-control" name="unitId" placeholder="Employee Id">
        
    </div>

    
    <div class="col-lg-2">
        <div class="col-md-12">

          <button class="btn btn-primary" type="submit"><i class="fab fa-searchengin"></i>Set Preference</button>
            
        </div>
    </div>
    </form>
    <div class="col-lg-2" onload="startTime()">
        <div id="txt"></div>
    </div>
    <div class="col-lg-2">
        <button type="button" class="btn btn-danger btn-rounded" data-toggle="modal" data-target="#modalIncident">New Response</button>
    </div>

</div>

<div class="col-md-12">
        <div id="outer" class="container">
          <div id="inner">
              <h1>You must Log In </h1>
          </div>
        </div>
</div>


@endif

@endsection


@push('scripts')

@endpush