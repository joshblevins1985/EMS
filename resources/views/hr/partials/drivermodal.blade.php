<!-- Modal -->
<div class="modal fade" id="driverOModal" tabindex="-1" role="dialog" aria-labelledby="30Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="30Label">30-30-30 Drivers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    @foreach($driving as $row)
                    <a href="/employees/{{$row->id}}" target="_blank" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">{{$row->first_name}} {{$row->last_name}}</h5>
                            <small>{{$row->employeepositions->label or ''}}</small>
                            <small>{{$row->station->station}}</small>
                        </div>
                        <div class="d-flex w-100 justify-content-between">
                            <small>Employee is eligible for next step on: {{ Carbon\Carbon::parse($row->driver_step)->format('m/d/Y')  }}</small>
                        </div>
                    </a>
                    @endforeach

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

