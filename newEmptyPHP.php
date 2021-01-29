
@if(!$box)
<div class="col-lg-12"><h1 class="white-text">{{$response}}</h1></div>
<div class="col-lg-12"><a href="/timeclock"><button class="btn btn-danger btn-rounded btn-block my-4 waves-effect z-depth-0"
                                                    >
            Go Back to main screen
        </button></a></div>

@endif

<div class="row white-text">
    <!--Show Box Details for verifications-->
    <div class="col-4">
        <div class="row white-text">
            <h1>Box ID: {{$box->box_number}}</h1>
        </div>
        <div class="row">
            Box Contains The Following Drugs
        </div>
        <div class="row">
            <table class="table">
                <thead class="white-text">
                    <tr class="white-text">
                        <th>Drug</th>
                        <th>Lot Number</th>
                        <th>Exp Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="white-text">
                        <td>Morphine</td>
                        <td>14555</td>
                        <td>02/09/2019</td>
                    </tr>
                    <tr class="white-text">
                        <td>Fentnyl</td>
                        <td>14555</td>
                        <td>02/09/2019</td>
                    </tr>
                    <tr class="white-text">
                        <td>Versed</td>
                        <td>14555</td>
                        <td>02/09/2019</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
        <!--Check if narcotic log has an open entry for the box scanned-->
        @if(!$narclog)

        <!--If not log for the box assigned to another employee allow employee to check out the box-->

        @else

        <!--If box is checked out update the log with whom is checking the box in-->
        <div class="row white-text">
            <div class="col-sm-12">
                <h3>Assigned to: EMPLOYEE ASSIGNED</h3>
            </div>
        </div>

    </div>
    @endif

    <div class="col-6">
        <!--Check what the employee ants to do??? Check in or Out-->

        @if($info == true)

        @endif


        <!--Check if narcotic log has an open entry for the box scanned-->
        @if(!$narclog)

        <!--If not log for the box assigned to another employee allow employee to check out the box-->

        <h1 class="white-text">You are signing out narcotics</h1>

        {!! Form::open(['route' => 'narcoticlog.store', 'id' => 'badrunsheets-form']) !!} 
        @csrf
        <div class="mb-form">
            <input type="password" class="form-control clock_id" id="out_signature" name="out_signature"></input>
            <label class="white-text" for="out_signature">Scan your ID badge to sign out.</label>
        </div>
        <div class="mb-form">
            <input type="password" class="form-control clock_id" id="witness_out" name="witness_out"></input>
            <label class="white-text" for="witness_out">Witness scan your ID badge to sign out.</label>
        </div>

        <input type="hidden" class="form-control clock_id" id="box" name="box" value="{{$box->id}}"></input>

        <input type="hidden" class="form-control clock_id" id="time_out" name="time_out" value="{{date('Y-m-d H:i:s')}}"></input>

        <input type="hidden" class="form-control clock_id" id="status" name="status" value="1"></input>

        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                type="submit">
            Sign Out
        </button>
        </form>
        @else

        <!--If box is checked out update the log with whom is checking the box in-->
        <h1 class="white-text">You are signing in narcotics</h1>


        {!! Form::open(['route' => ['narcoticlog.update', $narclog->id], 'id' => 'narcoticlog-form']) !!}
        @method('PUT')
        @csrf
        <div class="mb-form">
            <input type="password" class="form-control clock_id" id="in_signature" name="in_signature"></input>
            <label class="white-text" for="demo">Scan your ID badge to sign in.</label>
        </div>
        <div class="mb-form">
            <input type="password" class="form-control clock_id" id="witness_in" name="witness_in"></input>
            <label class="white-text" for="witness_in">Witness scan your ID badge to sign in.</label>
        </div>
        <input type="hidden" class="form-control clock_id" id="time_out" name="time_in" value="{{date('Y-m-d H:i:s')}}"></input>

        <input type="hidden" class="form-control clock_id" id="status" name="status" value="2"></input>

        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                type="submit">
            Sign Narcotics In
        </button>
        {!! Form::close() !!}

        @endif
    </div>
</div>