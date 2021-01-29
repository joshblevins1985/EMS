@if(!$rse)
    <tr>
        <td colspan="4">No Run Errors to diplay</td>
        
    </tr>
@else
@foreach($rse as $row)
    <tr>
        <td>{{date('m-d-Y', strtotime($row->doi))}}</td>
        <td></td>
        <td>{{$row->employee->first_name}} {{$row->employee->last_name}}</td>
        <td>@if(!$row->runerror) Unknown Error @else{{$row->RunError->description}}@endif</td>
    </tr>
@endforeach
@endif