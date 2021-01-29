@extends('layouts.app')

@section('page-title', trans('Dispatch'))
@section('page-heading', trans('Dispatch'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Dispatch')
    </li>
@stop

@section('content')

@include('partials.messages')

<div class="row pb-3">
    <div class="col-lg-6">
        
            <form class="form-inline" role="search" method="GET" action="{{url('dispatch')}}">

          <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here.." index="station" name="station[]">
            <option value="" disabled selected>Choose your stations</option>
            @foreach($stations as $row)
            <option value="{{$row->id}}">{{$row->station}}</option>
            @endforeach
          </select>
        
        <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here.." index="care" name="care[]">
            <option value="" disabled selected>Choose your levels</option>
            <option value="1">Ambulette / Car</option>
            <option value="2">Basic</option>
            <option value="3">Advanced</option>
            <option value="4">Medic</option>
            <option value="5">MICU</option>
          </select>
        
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
<div class="row">
    <div class="col-lg-8 col-md-12" >
     
        <div class="row border border-warning scrollBar" style="height: 500px;">
           <div class="col-sm-12">
                <h3 class="note note-primary text-center"><strong>Active Incidents</strong></h3>

            </div>
                  @include('dispatch.partials.card_dispatch')

        </div>
        
        <div class="row border border-primary scrollBar" style="height: 500px;">
           <div class="col-sm-12">
                <h3 class="note note-danger text-center"><strong>Pending Incidents</strong></h3>

            </div>
                  @include('dispatch.partials.pending.card_pending')

        </div>
    </div>
    <div class="col-lg-4 col-md-12 border border-primary scrollBar" style="height: 1000px;">
        <div class="col-sm-12">
                <h3 class="note note-primary text-center"><strong>Units</strong></h3>

            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <h4 class="note note-success text-center"><strong>BASIC</strong></h4>
                            @foreach($units->where('level', 2) as $row)
                            @include('dispatch.partials.card_avail_units')
                            @endforeach
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <h4 class="note note-warning text-center"><strong>ADVANCED</strong></h4>
                            @foreach($units->where('level', 3) as $row)
                            @include('dispatch.partials.card_avail_units')
                            @endforeach
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <h4 class="note note-danger text-center"><strong>ACLS</strong></h4>
                            @foreach($units->where('level','>=', 4) as $row)
                            @include('dispatch.partials.card_avail_units')
                            @endforeach
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <h4 class="note note-info text-center"><strong>AMBULETTE</strong></h4>
                            @foreach($units->where('level', 1) as $row)
                            @include('dispatch.partials.card_avail_units')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
</div>

@include('dispatch.partials.modalincident')
@include('dispatch.partials.modalunitstatus')
@include('dispatch.partials.modalunit')


@stop

@section('styles')
 <style>

.scrollBar {
  overflow-y: scroll;
}

 </style>
@stop
 
@section('scripts')
<script>
$('#unitstatusModal').on('show.bs.modal', function(e) {
    var unit = $(e.relatedTarget).data('unit');
    var status = $(e.relatedTarget).data('status');
    var message = $(e.relatedTarget).data('message');
    var call = $(e.relatedTarget).data('call');
    $("#unit").text("unit number is").html(call);
    $("#message").html(message);
    $("#unitInput").val(unit);
    $("#statusInput").val(status);
});
</script>

@stop