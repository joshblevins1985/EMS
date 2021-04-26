@foreach($incidents as $row)
<div class="row mb-3">
        <div class="col-12 ">
            <div class="callout
        @if($row->priorityId == 1) callout-immediate
            @elseif($row->priorityId == 2) callout-urgent
            @elseif($row->priorityId == 3) callout-medium
            @elseif($row->priorityId == 4) callout-low
            @elseif($row->priorityId == 5) callout-scheduled
            @endif ">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-3 mr-3">
                                <h4>Incident #: {{$row->incidentId ?? 'Unknown'}}</h4>
                            </div>
                            <div class="col-3 mr-3">
                                <h3>Incident Priority:
                                    @if($row->priorityId == 1) <span class="badge badge-danger"> IMMEDIATE </span>
                                    @elseif($row->priorityId == 2) <span class="badge badge-danger"> URGENT </span>
                                    @elseif($row->priorityId == 3) <span class="badge badge-warning"> MEDIUM </span>
                                    @elseif($row->priorityId == 4) <span class="badge badge-success"> LOW</span>
                                    @elseif($row->priorityId == 5) <span class="badge badge-success"> SCHEDULED</span>
                                    @else Unknown @endif
                                </h3>
                            </div>
                            <div class="col-3">
                                <h3>Incident Type: {{$row->type->description ?? 'Unknown'}}</h3>
                            </div>
                            <div class="col-2">
                                <div class="row">
                                    <div class="col">
                                        <a href="/incident/{{$row->id}}"><i class="fad fa-eye fa-2x"></i></a>
                                    </div>
                                    <div class="col">
                                        <i class="fad fa-file-edit fa-2x"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <h4>Pick Up Location is XXX minutes from primary station.</h4>
                                    </div>
                                    <div class="col-12">
                                        <h4>Pick Up Location: @if($row->facilityId) {{$row->facility->facilityName}} @else  {{$row->houseNumber ?? ''}} {{$row->street ?? ''}} {{$row->city ?? ''}} {{$row->state ?? ''}} {{$row->zip ?? ''}} @endif </h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-6"><h4>Drop Off Location: @if($row->destinationId) {{$row->destFacility->facilityName}} @else  {{$row->destHouseNumber ?? ''}} {{$row->destStreet ?? ''}} {{$row->destCity ?? ''}} {{$row->destState ?? ''}} {{$row->destZip ?? ''}} @endif </h4></div>
                                            <div class="col-3"><h4>Patient: John Doe</h4></div>
                                            <div class="col-3"><h4>PCR #: Unknown </h4></div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <h5>Incident Notes or Special Needs: {{$row->notes ?? 'No Notes Added'}} </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        Pick Up Time
                                    </div>
                                    <div class="col-4">
                                        Appointment Time
                                    </div>
                                    <div class="col-4">
                                        Estimated Time Complete
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        {{\Carbon\Carbon::parse($row->pickUpTime)->format('m/d/Y H:i')}}
                                    </div>
                                    <div class="col-4">
                                        {{\Carbon\Carbon::parse($row->aptTime)->format('m/d/Y H:i')}}
                                    </div>
                                    <div class="col-4">
                                        {{\Carbon\Carbon::parse($row->estimatedComplete)->format('m/d/Y H:i')}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

</div>
@endforeach
<div class="row mb-3">

</div>
