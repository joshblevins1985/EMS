<table id="data-table-default" class="table table-striped  table-td-valign-middle">
    <thead>
    <tr>
        <th >Employee </th>
        <th>Interview</th>
        <th>Follow Up Email</th>
        <th>Transport Date</th>
        <th>Patient</th>
        <th>Pick Up</th>
        <th>Drop Off</th>
        <th>Patient Result</th>
    </tr>
    </thead>
    <tbody>
    @foreach($exposures as $row)
        <tr class="odd gradeX">
            <td><a href="/covid/{{$row->id}}">{{$row->employee->last_name ?? ''}}, {{$row->employee->first_name ?? 'Error'}}</a> </td>
            <td>{{ ($row->interview ? Carbon\Carbon::parse($row->interview)->format('m-d-Y') : 'Pending')}}</td>
            <td>
                @if($row->follow_up)
                    {{Carbon\Carbon::parse($row->follow_up)->format('m-d-Y')}}
                @else
                    <a href='/updateExposureFu/{{$row->id}}'>Pending</a>
                @endif

                </td>
            <td> @if($row->patient->transport_date == '0000-00-00') <a href="javascript:;" data-toggle="modal" data-target="#modalUpdatePatient" data-patientid="{{$row->patient->id}}">Needs Updated</a>
                @else {{Carbon\Carbon::parse($row->patient->transport_date)->format('m-d-Y')}} @endif </td>
            <td>{{$row->patient->patient_name ?? 'Error'}}</td>
            <td>{{$row->patient->pick_up ?? 'Error'}}</td>
            <td>{{$row->patient->drop_off ?? 'Error'}}</td>
            <td>
                @if($row->patient->patient_status == 1)
                    Negative Result
                @elseif($row->patient->patient_status == 2)
                    Possible
                @elseif($row->patient->patient_status == 3)
                    Not Applicable
                @elseif($row->patient->patient_status == 4)
                    Positive Result
                @else
                    <a href="javascript:;" data-toggle="modal" data-target="#modalUpdatePatient" data-patientid="{{$row->patient->id}}">Pending</a>
                @endif
            </td>

        </tr>
    @endforeach

    </tbody>
</table>