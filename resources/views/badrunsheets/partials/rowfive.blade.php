<tr>

    <td>
        {{$row->Employee->last_name or 'Unknown'}}, {{$row->Employee->first_name or ''}}
    </td>
    <td>{{$row->Employee->phone_mobile or ''}}</td>
    <td class="align-middle">{{ $row->count }}</td>


</tr>