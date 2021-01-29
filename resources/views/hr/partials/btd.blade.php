
    <!--Panel-->
    <div class="card text-center"">
    <div class=" card-header elegant-color white-text">
        Back to Driving Program
    </div>
    <div class="card-body">
        <div class="list-group">
            @foreach($btd as $row)
                <a href="employees/{{$row->id}}/edit" class="list-group-item list-group-item-action flex-column align-items-start ">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-2 h5">{{$row->last_name}}, {{$row->first_name}}</h5>
                        <small>{{ $diff = Carbon\Carbon::parse($row['dod'])->diffForHumans(Carbon\Carbon::now()) }}</small>
                    </div>
                    <p class="mb-2">{{$row->driver_note}}</p>
                    
                </a>
            @endforeach
        </div>
    </div>
    <div class="card-footer text-muted elegant-color white-text">

    </div>
</div>
<!--/.Panel-->
