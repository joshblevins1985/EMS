<!-- Modal -->
<div class="modal fade" id="ftoEMSModal" tabindex="-1" role="dialog" aria-labelledby="ftoModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ftoModalLabel">EMS Field Training Employees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    @foreach($ftoems as $row)
                    <a href="/employees/{{$row->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">{{$row->first_name}} {{$row->last_name}} -- {{ Carbon\Carbon::parse($row->doh)->format('m-d-Y') }}</h5>
                            <small>{{$row->employeepositions->label}}</small>
                            <small>{{$row->station->station}}</small>
                        </div>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>FTO</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($row->fieldtraining as $row)
                            <tr>
                                <td> {{ Carbon\Carbon::parse($row->date)->format('m/d/Y') }}</td>
                                <td>{{$row->total_hours}}</td>
                                <td>{{$row->fto->first_name}} {{$row->fto->last_name}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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

