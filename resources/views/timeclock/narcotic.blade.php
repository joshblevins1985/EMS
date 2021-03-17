@extends('layouts.auth')


@section('page-title', 'Narcotic Log')

<style>
    body {
        @if($box->status == 1)background-color: #05304d !important @elseif($box->status == 2) background-color: #800000 !important @elseif($box->status == 3) background-color: #800080 !important @endif;
    }
</style>

<style>

    .select-wrapper input.select-dropdown{
        background-color: white !important;
    }
</style>
@section('content')
@include('partials.messages')
@if(!$box)
<h1 class="white-text">The box inforamtion does not match try again.</h1>

<div class="col-sm-12"><a href="/timeclock"><button class="btn btn-danger btn-rounded btn-block my-4 waves-effect z-depth-0"
        >
            Go Back to main screen
        </button></a></div>
@else

<div class="row white-text">
    <!--Show Box Details for verifications-->
    <div class="col-sm-12 col-lg-5">
        <div class="row white-text">
            <h1>Box ID: {{$box->box_number}}</h1>
        </div>
        <div class="row">
            Box Contains The Following Drugs
        </div>
        <div class="row">
            <div class="col-6">Seal # : {{$box->seal}}</div>
            <div class="col-6">Tamper Seal # : {{$box->tamper_seal}}</div>
        </div>
        <div class="row">
            <table class="table">
                <thead class="white-text">
                <tr class="white-text">
                    <th class="white-text">ID</th>
                    <th class="white-text">Drug</th>
                    <th class="white-text">Lot Number</th>
                    <th class="white-text">Strength </th>
                    <th class="white-text">Exp Date</th>
                </tr>
                </thead>
                <tbody>
                @if(!$medications)
                <tr>
                    <td colspan="3" >No Medications Assigned</td>
                </tr>
                @else
                @foreach($medications as $medication)
                <tr class="white-text">
                    <td>{{$medication->id}}</td>
                    <td>{{$medication->medications->trade_name}}</td>
                    <td>{{$medication->lot_number}}</td>
                    <td>{{$medication->dose}}</td>
                    <td>{{date('m-d-Y', strtotime($medication->expiration))}}</td>
                </tr>
                @endforeach
                @endif
                </tbody>
            </table>
            {!!$medications->appends(request()->input())->links()!!}
        </div>

        <!--Check if narcotic log has an open entry for the box scanned-->
        @if(!$narclog)

        <!--If no log for the box assigned to another employee allow employee to check out the box-->

        @else

        <!--If box is checked out update the log with whom is checking the box in-->
        <div class="row white-text">
            <div class="col-sm-12">
                @if(!$narclog->employees)
                <h3>Assigned to: Employee not found</h3>
                @else
                <h3>Assigned to: {{$narclog->employees->first_name}} {{$narclog->employees->last_name}}</h3>
                @endif
            </div>
        </div>


        @endif
        <div class="col-sm-12"><a href="/timeclock"><button class="btn btn-danger btn-rounded btn-block my-4 waves-effect z-depth-0"
                >
                    Go Back to main screen
                </button></a></div>

    </div>
    <div class="col-sm-12 col-lg-5">

        <!--Check if narcotic log has an open entry for the box scanned-->
        @if(!$narclog)

        <!--If not log for the box assigned to another employee allow employee to check out the box-->

        <h1 class="white-text">You are signing out narcotics</h1>

        {!! Form::open(['route' => 'narcoticlog.store', 'id' => 'narc-form']) !!}
        @csrf
        <!-- Commenting this out for now.....
        <select class="mdb-select md-form bg-white colorful-select dropdown-primary white-text" name="unit" required>
            <option value="" disabled selected>Choose your Unit Number</option>
            @foreach($units as $id => $unit)
            <option value="{{$id}}">{{$unit}}</option>
            @endforeach
        </select>
        -->
        <div class="mb-form">
            <input type="text" class="form-control clock_id in input-lg seal" id="seal" name="seal" value="{{$box->seal}}" required></input>
            <label class="white-text" for="out_signature">Box Seal</label>
        </div>
        <div class="mb-form">
            <input type="text" class="form-control clock_id in input-lg tamper_seal" id="tamper_seal" name="tamper_seal" value="{{$box->tamper_seal}}" required></input>
            <label class="white-text" for="out_signature">Tamper Evident Seal #</label>
        </div>
            <select class="mdb-select md-form" name="drugBag">
                <option value="" disabled selected>Choose your drug bag number.</option>
                @foreach($drugBags as $db)
                    <option value="{{$db->id}}"> {{$db->station->station ?? ''}} {{$db->bag_number}} </option>
                @endforeach
            </select>

            <div class="mb-form">
                <input type="text" class="form-control clock_id" id="bag_seal" name="bag_seal" placeholder="Enter Drug Bag Seal Number" value="" ></input>
                <label class="white-text" for="bag_seal">Drug Bag Seal Number.</label>
            </div>

        <div class="mb-form">
            <input type="password" class="form-control clock_id in input-lg" id="out_signature" name="out_signature" maxlength="10" required></input>
            <label class="white-text" for="out_signature">Scan your ID badge to sign out.</label>
        </div>
        <div class="mb-form">
            <input type="password" class="form-control clock_id" id="witness_out" name="witness_out" maxlength="10" required></input>
            <label class="white-text" for="witness_out">Witness scan your ID badge to sign out.</label>
        </div>



        <input type="hidden" class="form-control clock_id" id="box" name="box" value="{{$box->id}}" ></input>

        <input type="hidden" class="form-control clock_id" id="time_out" name="time_out" value="{{date('Y-m-d H:i:s')}}"></input>

        <input type="hidden" class="form-control clock_id" id="status" name="status" value="2"></input>

        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" id="narc-submit"
                type="submit">
            Sign Out
        </button>
        </form>
        @else

        <!--If box is checked out update the log with whom is checking the box in-->
        <h1 class="white-text">You are signing in narcotics</h1>

        <button type="button" class="btn btn-danger btn-lg btn-block" data-toggle="modal" data-target="#basicExampleModal">Click Here If Narcotics Were Used</button>

        {!! Form::open(['route' => ['narcoticlog.update', $narclog->id], 'id' => 'narc-form']) !!}
        @method('PUT')
        @csrf
        <input type="hidden" name="box" value="{{$box->id}}">
        <input type="hidden" name="seal" value="{{$box->seal}}">
        <input type="hidden" name="tamper_seal" value="{{$box->tamper_seal}}">

        <!-- Commenting this out for now.....
        <select class="mdb-select md-form bg-white colorful-select dropdown-primary white-text" name="unit" required>
            <option value="" disabled selected>Choose your Unit Number</option>
            @foreach($units as $id => $unit)
            <option value="{{$id}}">{{$unit}}</option>
            @endforeach
        </select>
        -->

        <div class="mb-form">
            <input type="text" class="form-control clock_id in input-lg seal_in" id="seal_in" name="seal_in" value="{{$box->seal}}" required></input>
            <label class="white-text" for="seal_in">Box Seal</label>
        </div>
        <div class="mb-form">
            <input type="text" class="form-control clock_id in input-lg tamper_seal_in" id="tamper_seal_in" value="{{$box->tamper_seal}}" name="tamper_seal_in" required></input>
            <label class="white-text" for="tamper_seal_in">Tamper Evident Seal # In</label>
        </div>

            <select class="mdb-select md-form" name="drugBag">
                <option value="" disabled selected>Choose your drug bag number.</option>
                @foreach($drugBags as $db)
                    <option value="{{$db->id}}" @if($narclog->drug_bag_id == $db->id) selected @endif> {{$db->bag_number}} </option>
                @endforeach
            </select>

            <div class="mb-form">
                <input type="text" class="form-control clock_id" id="bag_seal" name="bag_seal" placeholder="Enter Drug Bag Seal Number" value="{{ $narclog->drug_bag_seal_out }}" ></input>
                <label class="white-text" for="bag_seal">Drug Bag Seal Number.</label>
            </div>

        <div class="mb-form">
            <input type="password" class="form-control clock_id" id="in_signature" name="in_signature" maxlength="10" required></input>
            <label class="white-text" for="demo">Scan your ID badge to sign in.</label>
        </div>
        <div class="mb-form">
            <input type="password" class="form-control clock_id" id="witness_in" name="witness_in" maxlength="10" required></input>
            <label class="white-text" for="witness_in">Witness scan your ID badge to sign in.</label>
        </div>
        <input type="hidden" class="form-control clock_id" id="time_in" name="time_in" value="{{date('Y-m-d H:i:s')}}"></input>

        <input type="hidden" class="form-control clock_id" id="status" name="status" value="1"></input>



        <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
               id="narc-submit" type="submit">
            Sign Narcotics In
        </button>
        {!! Form::close() !!}

        @endif
    </div>
</div>
@endif
@if(!$box)

@else
<!-- Modal -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Narcotic Use Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('narcoticwaste.store') }}"  id="narc-waste-form" class="was-validated" method="POST" >
                            {{csrf_field()}}

                            <input type="hidden" name="box" value="{{$box->id}}">
                            <input type="hidden" name="seal" value="{{$box->seal}}">
                            <input type="hidden" name="tamper_seal" value="{{$box->tamper_seal}}">

                            <div class="form-group">
                                <select class="custom-select browser-default" name="station" required>
                                    <option value="" disabled selected>Choose your station.</option>
                                    @foreach($stations as $id => $station)
                                    <option value="{{$id}}">{{$station}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Must select your station.</div>
                            </div>

                            <div class="mb-form">
                                <input type="password" class="form-control" id="attending" name="attending" ></input>
                                <label for="attending" data-error="wrong" data-success="right">Patient attendant scan your ID badge.</label>
                                <div class="invalid-feedback">
                                  Please scan your ID badge.
                                </div>
                            </div>


                            <div class="form-group">
                                <select class="custom-select browser-default" name="vial_id" required>
                                    <option value="" disabled selected>Select Medication Used</option>

                                    @foreach($urx as $id => $urx)

                                    <option value="{{$id}}">{{$urx}}</option>
                                    @endforeach

                                </select>
                                <div class="invalid-feedback">Must select the vial number you used.</div>
                            </div>

                            <div class="mb-form">
                                <input type="text" class="form-control used" id="used" name="used" required></input>
                                <label for="used">Amount of drug used.</label>
                            </div>

                            <div class="mb-form">
                                <input type="text" class="form-control waste" id="waste" name="waste" required></input>
                                <label for="waste">Amount of drug wasted.</label>
                            </div>

                            <div class="mb-form">
                                <input type="text" class="form-control new_seal" id="new_seal" name="new_seal" required></input>
                                <label for="used">New Seal Number</label>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                <button type="submit" class="btn btn-primary" >Save Narcotic Waste Form</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    @endif

     @if($box->status == 1)

    @elseif($box->status == 2)
          <!-- Modal -->
<div class="modal fade" id="checkedOutModal" tabindex="-1" role="dialog" aria-labelledby="checkedOutModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="checkedOutModalLabel">Narcotic Box is Checked Out</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Please be advised that this box is currently checked out to {{$narclog->employees->first_name}} {{$narclog->employees->last_name}}. If this is not you please log the box back into the system and then follow proper procedure to log the box back out.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
    @endif;




    @stop


    @section('styles')

    @stop

    @section('scripts')

    <script>
        (function() {
        'use strict';
        window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        }
        form.classList.add('was-validated');
        }, false);
        });
        }, false);
        })();
    </script>

    <script>
var valid = false;

$("#narc-form").submit(function (e) {
    var $form = $(this);

    if (! $form.valid()) {
        return false;
    }

    as.btn.loading($("#narc-submit"));

    return true;
});
    </script>
    <script>
        document.getElementById("narcoticlog-form").onkeypress = function(e) {
            var key = e.charCode || e.keyCode || 0;
            if (key == 13) {
                e.preventDefault();
            }
        }

    </script>



    <script type="text/javascript">
        $(function() {
            // Set NumPad defaults for jQuery mobile.
            // These defaults will be applied to all NumPads within this document!

            $.fn.numpad.defaults.hidePlusMinusButton = true;
            $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
            $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
            $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control  input-lg" />';
            $.fn.numpad.defaults.buttonNumberTpl = '<button type="button" class="btn btn-dark btn-lg"></button>';
            $.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"></button>';
            $.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-success'); };

            // Instantiate NumPad once the page is ready to be shown
            $(document).ready(function(){

                $('#seal_in').numpad({
                    displayTpl: '<input class="form-control" type="text" />'
                });
                $('#tamper_seal_in').numpad({
                    displayTpl: '<input class="form-control" type="text" />'
                });
                $('#tamper_seal').numpad({
                    displayTpl: '<input class="form-control" type="text" />'
                });
                $('#seal').numpad({
                    displayTpl: '<input class="form-control" type="text" />'
                });
                $('#new_seal').numpad({
                    displayTpl: '<input class="form-control" type="text" />'
                });
                $('#used').numpad({
                    displayTpl: '<input class="form-control" type="text" />'
                });
                $('#waste').numpad({
                    displayTpl: '<input class="form-control" type="text" />'
                });
                $('#bag_seal').numpad({
                    displayTpl: '<input class="form-control" type="text" />'
                });



            });
        });
    </script>

    @if($box->status == 1)

    @elseif($box->status == 2)
      <script type="text/javascript">
    $(window).on('load',function(){
        $('#checkedOutModal').modal('show');
    });
</script>
    @endif;





    @stop
