<td>{{$row->unit_id}}</td>
<td>{{date('m-d-Y', strtotime($row->created_at))}}</td>
<td>{{$row->mechanic->first_name or 'Pending'}} {{$row->mechanic->last_name or ''}}</td>
<td>{{$row->task_label->label}}</td>
<td>{{$row->comments}}</td>
<td>@if($row->anticipated_start_date === NULL) {{$status}} @else{{date('m-d-Y', strtotime($row->anticipated_start_date))}} @endif</td>
<td>@if($row->aticipated_end_date === NULL) {{$status}} @else{{date('m-d-Y', strtotime($row->aticipated_end_date))}} @endif</td>
<td>@if($row->start_date === NULL) {{$status}} @else{{date('m-d-Y', strtotime($row->started))}} @endif</td>
<td>@if($row->end_date === NULL) {{$status}} @else{{date('m-d-Y', strtotime($row->ended))}} @endif</td>
<td>@if($row->status == 1) {{$status}} @elseif($row->status == 2) Assigned @elseif($row->status == 3) Working @elseif($row->status == 4) Inspection  @elseif($row->status == 5) Completed  @endif</td>
<td>
   

    <a href="mechanic/{{$row->id}}/edit "
       class="btn btn-icon edit"
       title="Edit Incident"
       data-toggle="tooltip" data-placement="top">
        <i class="fas fa-edit"></i>
    </a>
    <a href="mechanics/{{$row->id}}/delete"
       class="btn btn-icon bg-danger">
        <i class="fas fa-trash"></i>
    </a>

</td>
