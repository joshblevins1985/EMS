<form class="" role="search" method="GET" action="{{url('dispatch/active')}}">
    <div class="row">
        <div class="col-5">

            <select class="multiple-select2 md-form" style="width: 100%"  multiple="multiple" id="station" name="station[]">

                @foreach($stations as $row)
                    <option value="{{$row->id}}")  >{{$row->station}}</option>
                @endforeach

            </select>
            <label for="station">Select the stations to view.</label>
        </div>
        <div class="col-5">

            <select class="multiple-select2 md-form" style="width: 100%" multiple="multiple" index="care" name="care[]">
                <option value="1">Ambulette / Car</option>
                <option value="2">Basic</option>
                <option value="3">Advanced</option>
                <option value="4">Medic</option>
                <option value="5">MICU</option>
            </select>
            <label for="statioin">Select the levels to view.</label>
        </div>

        <div class="col-2">

            <button class="btn btn-primary" type="submit"><i class="fab fa-searchengin"></i>Set Preference
            </button>
        </div>
    </div>
</form>