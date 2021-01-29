<table>
    <thead>
    <th></th>
    </thead>

    <tbody>
    @foreach($collection as $patient)
        <tr>
            <td>{{$patient}}</td>
            <td>{{$patient->patient_type}}</td>
            <td>{{$patient->first_name}}</td>
            <td>{{$patient->last_name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>