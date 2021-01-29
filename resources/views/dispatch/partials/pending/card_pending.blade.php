<div class="row-fluid" id='pending'>

        @foreach($pending->where('status', '<', 1) as $row)
        <div class="col-lg-12">
                <h2 class="text-danger">{{$row->type->description or 'Unknown'}}</h2>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 mb-2">
                                <strong>Incident #:{{$row->incident_number}}</strong>
                            </div>
                            <div class="col-lg-2">
                                @if($row->patient)<a href="/patients/{{$row->patient_id}}"
                                                     target="_blank"><strong>{{decrypt($row->patient->first_name) ?? ''}} {{decrypt($row->patient->last_name) ?? ''}}</strong></a>@endif
                            </div>
                            <div class="col-lg-2">
                                <strong>PCR #: Unknown</strong>
                            </div>
                            <div class="col-lg-4">
                                <strong>This incident is {{$row->travel}} minutes away from the station.</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-1">
                                @if($row->plate == 1)
                                    <?php $plate = "fa-spin"?>
                                @else
                                    <?php $plate = "" ?>
                                @endif
                                <i class="fas fa-ambulance {{$plate}} fa-3x {{$row->stat->color or ''}}"></i>
                            </div>
                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <strong>Pick Up</strong>
                                    </div>
                                    <div class="col-lg-10">
                                        {{$row->pick_up_facility->name or ''}}
                                        - {{$row->house_number}} {{ucwords($row->incident_address)}} {{ucwords($row->incident_city)}} {{ucwords($row->incident_state)}} {{$row->incident_zip}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <strong>Drop Off</strong>
                                    </div>
                                    <div class="col-lg-10">
                                        {{$row->destination_facility_id or 'Destination Location Pending'}}
                                        - {{$row->destination_house_number}} {{ucwords($row->destination_address)}} {{ucwords($row->destination_city)}} {{ucwords($row->destination_state)}} {{$row->destination_zip}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2">
                                        <strong>Notes</strong>
                                    </div>
                                    <div class="col-lg-10">
                                        {!! $row->notes !!}
                                    </div>
                                </div>
                                <div draggable="true" data-uuid="1.1" class="row" style="height:50px">
                                    Drop unit to dispatch
                                </div>

                            </div>
                            <div class="col-lg-2">
                                <div class="row">
                                    <div class="col-lg-12 mb-2">
                                        <a data-toggle="modal" data-target="#modalDispatch"
                                        href="javascript;"
                                        data-incident="{{$row->id}}"
                                        data-incident_id="{{$row->incident_number}}"
                                        data-incident_type="{{$row->type->description or 'Unknown'}}">
                                            <span class="badge badge-pill badge-primary">Dispatch Unit</span>
                                        </a>
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <span class="badge badge-pill badge-dark">Add Note</span>
                                    </div>
                                    <div clas="col-lg-12 mb-2">
                                        <span class="badge badge-pill badge-danger">Cancel Incident</span>
                                    </div>
                                </div>


                            </div>
                            <div class="col-lg-2">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong>Special Considerations</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(count($row->alerts))
                                <button class="btn-danger btn-block" data-incident_id="{{$row->id}}" data-toggle="modal"
                                        data-target="#modalAlert">Address Has Alerts
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
        @endforeach


</div>

<script src="/assets/dispatch/modalDispatch.js"></script>
          