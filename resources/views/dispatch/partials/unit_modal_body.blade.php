<div class="row">
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-4">
                <blockquote class="blockqoute {{$unit_info->care->color}}">
                    {{$unit_info->u->unit_number}}
                </blockquote>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Note</th>
                            <th>Noted By</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$unit_info->unit_notes)
                            @foreach($unit_info->unit_notes as $row)
                                <tr>
                                <td colspan="3">No Notes to Display</td>
                            </tr>
                            @endforeach
                        @else
                            
                            @foreach($unit_info->unit_notes as $row)
                                <tr>
                                    <td>{{ Carbon\Carbon::parse($row->created_at)->format('H:i') }}</td>
                                    <td>{{$row->note}}</td>
                                    <td>{{$row->user_id}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <table class="table">
            <thead>
                <tr>
                    <th>Time</th>
                    <th>Incident</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                
                    @foreach($unit_info->logs as $row)
                <tr>
                    <td>{{ Carbon\Carbon::parse($row->created_at)->format('H:i') }}</td>
                    <td><a href="#" data-toggle="tooltip" title="{{$row->incident->type->description or ''}}">{{ $row->incident->incident_number or 'Unknown'}}</a></td>
                    <td>{{ $row->status_label->description or 'Unknown' }}</td>
                </tr>    
                    @endforeach
                
            </tbody>
        </table>
    </div>
</div>