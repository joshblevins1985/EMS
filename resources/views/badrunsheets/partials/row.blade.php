<tr>
    <td>{{$row->incident_date}}</td>
    <td>
        @foreach($row->employees as $emp)
        <div class="row">
            <span class="@if($emp->status == 1) bg-danger @elseif($emp->status == 2) bg-warning text-dark @elseif($emp->status == 3) bg-primary @elseif($emp->status == 4) bg-primary @elseif($emp->status == 5) bg-success @endif">{{$emp->employee->last_name or 'Unknown'}}, {{$emp->employee->first_name or 'Unknown'}} -- {{ $emp->employee->station->station ?? 'Unknown' }}</span>
        </div>
        @endforeach
    </td>
    <td class="align-middle">{{ $row->pcr_number }}</td>
    <td class="align-middle">
        @if($row->status == 1)

        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $row->id) }}
        {{ Form::hidden('status', '2') }}

        <button type="submit"  class="badge badge-pill bg-danger"><span class="">Uploaded</span></button>

        {!! Form::close() !!}
        @elseif($row->status == 2)
        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $row->id) }}
        {{ Form::hidden('status', '3') }}

        <button type="submit"  class="badge badge-pill bg-warning"><span class="">Notified</span></button>

        {!! Form::close() !!}
        @elseif($row->status == 3)
        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $row->id) }}
        {{ Form::hidden('status', '4') }}

        <button type="submit"  class="badge badge-pill bg-primary"><span class="">Acknowledged</span></button>

        {!! Form::close() !!}
        @elseif($row->status == 4)
        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $row->id) }}
        {{ Form::hidden('status', '5') }}

        <button type="submit"  class="badge badge-pill bg-primary"><span class="">To Billing</span></button>

        {!! Form::close() !!}
        @elseif($row->status == 5)
        <span class="badge badge-pill bg-success">Complete</span>
        @endif
    </td>
    <td>
        @if($row->status < 5)
        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
        @method('PUT')
        @csrf

        {{ Form::hidden('id', $row->id) }}
        {{ Form::hidden('status', '5') }}

        <button type="submit"  class="btn btn-success">Mark Complete</button>

        {!! Form::close() !!}
        @endif
    </td>
    <td> @foreach($row->pcr as $rowpcr) <a href="{{$rowpcr->location}}"><i class="far fa-file-pdf"></i></a> @endforeach</td>
    <td>
        <div class="dropdown show d-inline-block">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                <a href="badrunsheets/{{$row->id}} " class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    View Incident
                </a>
            </div>
        </div>

        <a href="badrunsheets/{{$row->id}}/edit "
           class="btn btn-icon edit"
           title="Edit Incident"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>

        <form action="/badrunsheets/{{$row->id}}" method="POST">
            @method('DELETE')
            @csrf
            <button><i class="fas fa-trash"></i></button>
        </form>
    </td>
</tr>