@extends('layouts.empty')

@section('page-title', trans('Tow Response'))
@section('page-heading', trans('Maintanance Tasks'))



@section('content')
<div class="row">
  <div class="col-xl-2">
    <div class="btn-group-vertical btn-group-toggle"  data-toggle="buttons">
      <label class="btn btn-primary mb-5">
        <input type="radio" name="options" id="option1" autocomplete="off" >  Mike Adkins
      </label>
      <label class="btn btn-primary mb-5">
        <input type="radio" name="options" id="option2" autocomplete="off"> Tim Clifford
      </label>
      <label class="btn btn-primary mb-5">
        <input type="radio" name="options" id="option3" autocomplete="off"> Other Mechanic
      </label>
    </div>
  </div>

  <div class="col-xl-8">
    <div class="row">
      <div class="col-xl-2 float-right">
        <div class="well">Pending Tows:</div>
      </div>
    </div>
    <div class="row">
      <!-- begin col-3 -->
    <div class="col-xl-6 col-md-6">
      <div class="widget widget-stats bg-primary" style="height: 150px;">
        <div class="stats-icon stats-icon-lg"><i class="far fa-broadcast-tower fa-fw"></i></div>
        <div class="stats-content">
          <div class="stats-title"><h1>Enroute</h1></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>
     <!-- begin col-3 -->
    <div class="col-xl-6 col-md-6">
      <div class="widget widget-stats bg-success" style="height: 150px;">
        <div class="stats-icon stats-icon-lg"><i class="fas fa-plane-arrival fa-fw"></i></div>
        <div class="stats-content">
          <div class="stats-title"><h1>At Location</h1></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>
     <!-- begin col-3 -->
    <div class="col-xl-6 col-md-6">
      <div class="widget widget-stats bg-warning" style="height: 150px;">
        <div class="stats-icon stats-icon-lg"><i class="fas fa-truck-ramp fa-fw"></i></div>
        <div class="stats-content">
          <div class="stats-title"><h1>Transporting</h1></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>
     <!-- begin col-3 -->
    <div class="col-xl-6 col-md-6">
      <div class="widget widget-stats bg-success" style="height: 150px;">
        <div class="stats-icon stats-icon-lg"><i class="fad fa-clipboard-list-check fa-fw"></i></div>
        <div class="stats-content">
          <div class="stats-title"><h1>Arrived Destination</h1></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>
    </div>

    <div class="row">

      MAP WITH LOCATION OF TOW TRUCK.
    </div>
  </div>

  <div class="col-xl-2">
    <div class="col-xl-12 mb-3">
      <div class="widget widget-stats bg-dark" >
        <div class="stats-content">
          <div class="stats-title"><h3>Unit: </h3></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>

    <div class="col-xl-12 mb-3">
      <div class="widget widget-stats bg-dark" >
        <div class="stats-content">
          <div class="stats-title"><h3>Make: </h3></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 mb-3">
      <div class="widget widget-stats bg-dark" >
        <div class="stats-content">
          <div class="stats-title"><h3>Model: </h3></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 mb-3">
      <div class="widget widget-stats bg-dark" >
        <div class="stats-content">
          <div class="stats-title"><h3>Lic #: </h3></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>
    <div class="col-xl-12 mb-3">
      <div class="widget widget-stats bg-dark" >
        <div class="stats-content">
          <div class="stats-title"><h3>Company: </h3></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>

    <div class="col-xl-12 mb-3">
      <div class="widget widget-stats bg-dark" >
        <div class="stats-content">
          <div class="stats-title"><h3>Station: </h3></div>
          <div class="stats-number"></div>
        </div>
      </div>
    </div>

</div>

@stop

@section('scripts')

@stop