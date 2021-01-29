@extends('layouts.auth')


@section('page-title', 'Time Clock Login')


@section('content')
@include('partials.messages')
<style>
    body {
        background-color: #05304d !important;
    }
</style>
<div class="row">

    <div class="col-sm-2">

    </div>

    <div class="col-sm-12 align-self-center">
        <div class="row">
            <div class="col">
                <img src="{{ url('/assets/img/peasi.png') }}" alt="{{ settings('app_name') }}" height="200">
            </div>
        </div>
        <div class="row">
            <div class="col">

                <ul class="nav md-pills nav-justified pills-blue white-text" id="pills-tab" role="tablist">

                    <li class="nav-item white-text">
                        <a class="nav-link white-text active" id="pills-profile-tab" data-toggle="pill"
                           href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Narcotic
                            Logging</a>
                    </li>

                    <li class="nav-item white-text">
                        <a class="nav-link white-text" id="pills-home-tab" data-toggle="pill"  href="#pills-home"
                           role="tab" aria-controls="pills-home" aria-selected="false">Clock In</a>
                    </li>


                </ul>


                <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form  method="GET" action="{{ route('timeclock.punch') }}" autocomplete="off">
                            <div class="mb-form">
                                <input type="password" class="form-control form-control-lg clock_id" id="clock_id"
                                       name="eid" autocomplete="off"></input>
                                <label class="white-text" for="demo">Employee Clock In Id</label>
                            </div>

                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                    type="submit">
                                Clock In / Out
                            </button>
                        </form>
                    </div>
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel"
                         aria-labelledby="pills-profile-tab">
                        <form role="search" method="GET" id="narcoticForm" action="{{ route('narcoticlog.create') }}" autocomplete="off">

                            <div class="mb-form">
                                       <input type="text"
                       name="rfid"
                       id="rfidInput"
                       autocomplete="off"
                       autofocus
                       class="form-control"
                       placeholder="@lang('Scan RFID Badge')">
                                <label class="white-text" for="box_id">Narcotic Box Scan</label>
                            </div>

                            <button
                            class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                            id="next"
                            type="submit" disabled>
                                Log Narcotic Box
                            </button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>


</div>

</div>

@stop


@section('styles')
<style>
    .vertical-center {
        min -height: 100%; /* Fallback for browsers do NOT support vh unit */
        min -height: 100vh; /* These two lines are counted as one :-)       */

        display: flex;
        align -items: center;
    }

    .nmpd-grid {
        border: none;
        padding: 20px;
    }

    .nmpd-grid > tbody > tr > td {
        border: none;
    }

    /* Some custom styling for Bootstrap */
    .qtyInput {
        display: block;
        width: 100%;
        padding: 6px 12px;
        color: #556;
        background -color: blue;
        border: 1px solid #ccc;
        border -radius: 4px;
        -webkit -box
        -shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box -shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        -webkit -transition: border -color ease -in -out .15s, -webkit -box -shadow ease -in -out .15s;
        -o -transition: border -color ease -in -out .15s, box -shadow ease -in -out .15s;
        transition: border -color ease -in -out .15s, box -shadow ease -in -out .15s;
    }


</style>

@stop

@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>



<script>
    $(document).ready(function() {
        var x_timer;
        $("#rfidInput").keyup(function (e){
            clearTimeout(x_timer);
            var rfidInput = $(this).val();
            x_timer = setTimeout(function(){
                check_username_ajax(rfidInput);
            }, 1000);
        });

        $('#narcoticForm').on('keyup keypress', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) {
            e.preventDefault();
            return false;
          }
        });

        function check_username_ajax(rfidInput){
            $("#rfid").html('<img height="20 px" src="{{url('/assets/img/loader.gif')}}" />');

            $.post('/narcotic/verifyBox',
                {'rfid':rfidInput, _token: '{{csrf_token()}}'},
                function(data) {

                const json = JSON.parse(data);

                    $("#rfid").html(json.message);

                    if(json.status == 1){
                        $("#next").prop('disabled', false);
                        Swal.fire({
                          title: 'Match Found',
                          text: json.message,
                          icon: 'success',
                          confirmButtonText: 'Continue'
                        }).then(function() {
                                window.location.href = json.link;
                            })
                    }else if (json.status == 0){
                        $("#next").prop('disabled', true);
                        Swal.fire({
                          title: 'Error!',
                          text: json.message ,
                          icon: 'error',
                          confirmButtonText: 'Try Again',
                        }).then(function() {
                                window.location.href = json.link;
                                $('#rfidInput').val('');
                            })
                    }

                });
        }
    });



</script>


<script>
    //Call the yourAjaxCall() function every 1000 millisecond
    setInterval("yourAjaxCall()",30000);
    function yourAjaxCall(){



        var request = $.ajax({
            url: "/narcoticStatus",
            type: "GET",

        });

        request.done(function(msg) {
            console.log( msg );
        });

        request.fail(function(jqXHR, textStatus) {
            console.log( "Request failed: " + textStatus );
        });


    }
</script>



@stop
