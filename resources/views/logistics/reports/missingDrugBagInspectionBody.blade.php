<div class="row">
    <div class="col-12">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Bag ID</th>
                <th>Station</th>
                <th>Level</th>
                <th>Seal Number</th>
                <th>Next Expiration</th>
            </tr>
            </thead>
            <tbody>
            @foreach($inspections as $i)
                <tr>
                    <td>{{$i->description}}</td>
                    <td>{{$i->station->description ?? ''}}</td>
                    <td>{{$i->level->description ?? ''}}</td>
                    <td>{{$i->currentSealNumber ?? ''}}</td>
                    <td>{{\Carbon\Carbon::parse($i->bagExpires)->format('m-d-Y')}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
