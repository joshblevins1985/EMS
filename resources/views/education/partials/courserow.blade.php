@foreach($courses as $row)

    <tr>
        <td>{{$row->course_id}}</td>
        <td>{{$row->title}}</td>
        <td>{{$row->location}}</td>
        <td>{{$row->EmployeePositions['label']}}</td>
        <td>{{$row->category}}</td>
        
        <td>{{$row->hours}}</td>
        <td>
            @if($row->is_orientation == 0)
            No
            @elseif($row->is_orientation == 1)
            Yes
            @else
            Unknown
            @endif
        </td>
        <td>@if($row->renew == NULL) NA @else {{$row->renew}} months @endif</td>
        <td>
            @if($row->status == 1)
            Building
            @elseif($row->status == 2)
            Pending Approval
            @elseif($row->status == 3)
            Approved - Active
            @elseif($row->status == 4)
            Denied - Inactive
            @elseif($row->status == 5)
            Archived
            @else
            Unknown Status
            @endif
        </td>
    </tr>

@endforeach