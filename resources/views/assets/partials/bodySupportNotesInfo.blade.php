<table class="table table-striped">
    <thead>
        <tr>
            <th>Date</th>
            <th>Note</th>
            <th>Tech</th>
        </tr>
    </thead>
    <tbody>
        @if($notes)
        @foreach($notes as $row)
        <tr>
            <td>{{ Carbon\Carbon::parse($row->created_at)->format('m-d-Y H:i') }}</td>
            <td>{!! $row->description !!}</td>
            <td>{{ $row->tech->first_name }} </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="3">No Notes to Show</td>
        </tr>
        @endif
    </tbody>
</table>