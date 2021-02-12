
<div class="col-md-12 col-xl-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Field Orientation Dates (This function is under construction)</h4>

            <div class="list-wrapper">
                <ul class="d-flex flex-column-reverse todo-list-custom">
                    @if( in_array(21, explode(',', $employee->additional_postions )))
                        @foreach($employee->ftopaydates->sortByDesc('date') as $row)
                            <li>
                                <div class="row">
                                    <div class="col-2">{{ Carbon\Carbon::parse($row->date)->format('m/d/Y') }}</div>
                                    <div class="col-4"><a href="/fto/dashboard/{{$row->user_id}}" > {{$row->trainee->first_name or 'Unknown'}} {{$row->trainee->last_name or ''}} </a></div>
                                    <div class="col-2">@if($row->type == 1) Field Orientation @elseif($row->type == 2) Drivers Orientation @endif</div>
                                    <div class="col-2">Total Hours: {{$row->total_hours}}</div>
                                    <div class="col-2">Status: @if($row->payroll == 1) Paid @else Pending @endif</div>
                                </div>
                            </li>
                        @endforeach
                    @else
                        @if($employee->fieldtraining)
                            @foreach($employee->fieldtraining as $row)
                                <li>
                                    <div class="row">
                                        <div class="col-xl-3">{{ Carbon\Carbon::parse($row->date)->format('m/d/Y') }}</div>
                                        <div class="col-xl-3">{{$row->fto->first_name or 'Unknown'}} {{$row->fto->last_name or ''}}</div>
                                        <div class="col-xl-3">@if($row->type == 1) Field Orientation @elseif($row->type == 2) Drivers Orientation @endif</div>
                                        <div class="col-xl-3">Total Hours: {{$row->total_hours}}</div>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li>No Orientation Dates of File</li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>