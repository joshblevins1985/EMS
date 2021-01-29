<!-- Modal -->
<div class="modal fade" id="orientationModal" tabindex="-1" role="dialog" aria-labelledby="orientationModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orientationModalLabel">EMS Orientation Employees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    @foreach($orientation as $row)
                    <a href="/employees/{{$row->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">{{$row->first_name}} {{$row->last_name}}  </h5>
                            <small>{{$row->employeepositions->label}}</small>
                            <small>{{$row->station->station}}</small>
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

