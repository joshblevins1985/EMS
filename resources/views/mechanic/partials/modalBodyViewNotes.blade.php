<table class="table table-striped">
    <thead>
        <tr>
            <th> Date Added </th>
            <th> Note </th>
            <th> Added By </th>
        </tr>
    </thead>
    <tbody>
        @if(count($notes))
        @foreach($notes as $note)
        <tr>
            <td> {{ Carbon\Carbon::parse($note->created_at)->format('m-d-Y H:i') }} </td>
            <td> {{ $note->note }} </td>
            <td> {{ $note->employee->first_name ?? 'Unknown' }} {{ $note->employee->last_name ?? ''  }} </td>
        </tr>
        @endforeach
        @else 
        <tr>
            <td colspan="3"> No Notes to View </td>
        </tr>
        @endif
    </tbody>
</table>