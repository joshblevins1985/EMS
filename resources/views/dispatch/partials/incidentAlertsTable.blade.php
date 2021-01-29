
<table class="table table-striped">
    <thead>
    <tr>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Patient</th>
        <th>Flag</th>
        <th>Message</th>
    </tr>
    </thead>
    <tbody>
    @if(count($alerts))
        @foreach($alerts as $row)
            <tr>
                <td>{{ $row->alert->house_number ?? ''}} {{$row->alert->street}} {{$row->alert->state}} {{$row->alert->zip}} </td>
                <td>{{$row->alert->phone_number ?? 'No Number Listed'}}</td>
                <td>{{$row->alert->patient ?? 'No Patient Listed'}}</td>
                <td>@if($row->alert->flag == 1) <i class="fal fa-head-side-mask"></i> @endif</td>
                <td>{{$row->alert->message}}</td>
            </tr>
        @endforeach
    @else
        <tr>
            <td class="text-center" colspan="6">No Alert Match Address / Phone Number / Patient</td>
        </tr>
    @endif
    </tbody>
</table>