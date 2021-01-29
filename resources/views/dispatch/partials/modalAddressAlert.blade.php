
<div class="card @if(count($alerts)) bg-danger @else bg-success text-dark @endif">
    <div class="card-header">
        Dispatch Alerts Search Result
    </div>
    <div class="card-body">
        <table class="table table-striped @if(count($alerts))  @else text-dark @endif">
            <thead>
            <tr>
                <th>Add</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Patient</th>
                <th>Flag</th>
                <th>Message</th>
            </tr>
            </thead>
            <tbody>
            @if(count($alerts))
                @foreach($alerts as $alert)
                    <tr>
                        <td><input class="form-check-input" type="checkbox" name="alert_id[]" id="inlineCheckbox1" value="option{{$alert->id}}" /></td>
                        <td>{{ $alert->house_number ?? ''}} {{$alert->street}} {{$alert->state}} {{$alert->city}} {{$alert->zip}} </td>
                        <td>{{$alert->phone_number ?? 'No Phone Listed'}}</td>
                        <td>{{$alert->patient ?? 'No Assoc... Patient'}}</td>
                        <td>@if($alert->flag == 1) <i class="fal fa-head-side-mask"></i> @endif</td>
                        <td>{{$alert->message ?? 'No Message'}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="6">No Alert Match Address / Phone Number / Patient</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>

