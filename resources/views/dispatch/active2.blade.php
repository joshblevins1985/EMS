@extends('layouts.default')

@section('page-title', trans('Dispatch'))
@section('page-heading', trans('Dispatch'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Dispatch')
</li>
@stop

@section('content')

@include('partials.messages')

<script type="text/javascript">
    $(function () {
        $("#notFacility").click(function () {
            if ($(this).is(":checked")) {
                $("#address").show();
            } else {
                $("#address").hide();
            }
        });
    });
</script>

<div class="row ">
    <div class="col-lg-4">

        <form class="form-inline" role="search" method="GET" action="{{url('dispatch/active')}}">
            <div class="row">
                <div class="col-6">
                    <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here.." index="station" name="station[]">
                        <option value="" disabled selected>Choose your stations</option>
                        @foreach($stations as $row)
                        <option value="{{$row->id}}">{{$row->station}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <select class="mdb-select colorful-select dropdown-primary md-form" multiple searchable="Search here.." index="care" name="care[]">
                        <option value="" disabled selected>Choose your levels</option>
                        <option value="1">Ambulette / Car</option>
                        <option value="2">Basic</option>
                        <option value="3">Advanced</option>
                        <option value="4">Medic</option>
                        <option value="5">MICU</option>
                    </select>
                </div>
            </div>

    </div>


    <div class="col-lg-2">
        <div class="col-md-12">

            <button class="btn btn-primary" type="submit"><i class="fab fa-searchengin"></i>Set Preference</button>

        </div>
    </div>
    </form>
    <div class="col-lg-4">
        <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
        <div id="txt"></div>
    </div>
    <div class="col-lg-2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   href="#"
                   id="navbarDropdown"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <i class="fa fa-bell">Notifications </i>
                    @if(auth()->user()->unreadNotifications->count())
                    <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">

                    @if(auth()->user()->unreadNotifications->count())
                    <a class="dropdown-item" href="{{ route('markAllRead') }}">
                        <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                        Mark all as Read
                    </a>
                    <div class="dropdown-divider"></div>
                    @endif


                    @foreach(auth()->user()->unreadNotifications as $notification)
                    <a class="dropdown-item" style="background: lightcoral" href="#">
                        {{$notification->data['data']}}
                    </a>
                    @endforeach
                    <!--
                    @foreach(auth()->user()->readNotifications as $notification)
                        <a class="dropdown-item" href="#">
                            {{$notification->data['data']}}
                        </a>
                    @endforeach
                    -->
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" >


        <div class="col-sm-12">
            <h3 class="note note-primary text-center"><strong>Active Incidents</strong></h3>

        </div>
        <div id="active">
            <div class="row">
                @include('dispatch.partials.card_dispatch')
            </div>
        </div>




    </div>

</div>

@include('dispatch.partials.modalunitstatus')
@include('dispatch.partials.modalunit')
@include('dispatch.partials.modaltransport')
@include('dispatch.partials.modalsendmessage')



@stop

@section('styles')
<style>

    .scrollBar {
        overflow-y: scroll;

    }

    .clock {

        color: #17D4FE;
        font-size: 60px;
        font-family: Orbitron;
        letter-spacing: 7px;
    }

    .pac-container { z-index: 10000 !important; }


</style>
@stop

@section('scripts')
<script>
    $('#unitstatusModal').on('show.bs.modal', function(e) {
        var unit = $(e.relatedTarget).data('unit');
        var status = $(e.relatedTarget).data('status');
        var message = $(e.relatedTarget).data('message');
        var call = $(e.relatedTarget).data('call');
        $("#unit").text("unit number is").html(call);
        $("#message").html(message);
        $("#unitInput").val(unit);
        $("#statusInput").val(status);
    });
</script>

<script>
$('#modalSendMessage').on('show.bs.modal', function(e) {
    var unit = $(e.relatedTarget).data('unit');
 
    $('#send_message').attr('action', '/dispatch/message/' + unit);
});
</script>

<script>

    var draggableElements = document.querySelectorAll('[draggable="true"]');

    [].forEach.call(draggableElements, function(element) {
        element.addEventListener('dragstart', handleDragStart, false);
        element.addEventListener('dragenter', handleDragEnter, false);
        element.addEventListener('dragover', handleDragOver, false);
        element.addEventListener('dragleave', handleDragLeave, false);
        element.addEventListener('drop', handleDrop, false);
        element.addEventListener('dragend', handleDragEnd, false);
    });

    function handleDragStart(event) {
        localStorage.setItem('currentDragElement', event.target.dataset.uuid);
        event.dataTransfer.setData("text/plain", event.target.dataset.uuid);
    }


    function handleDragOver(event) {
        event.preventDefault();
        event.dataTransfer.dropEffect = 'move';
        return false;
    }

    function handleDragEnter(event) {
        this.classList.add('over');
    }

    function handleDragLeave(event) {
        this.classList.remove('over');
    }

    function handleDrop(event) {
        event.stopPropagation();
        event.preventDefault();

        if(localStorage.getItem('currentDragElement') == event.target.dataset.uuid) {
            return;
        }

        currentDragElement = document.querySelector('[data-uuid="'+localStorage.getItem('currentDragElement')+'"]');

        console.log('dragged element ', currentDragElement , ' on element ', event.target)

        localStorage.setItem('currentDragElement', null);

        return false;
    }

    function handleDragEnd(event) {
        [].forEach.call(draggableElements, function (element) {
            element.classList.remove('over');
        });
    }


</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'X-Requested-With': 'XMLHttpRequest'
        }
    });
    var search = window.location.search;
    var auto_refresh = setInterval(
        function(){
            $('#active').load('{{url('active')}}/' + search);
        },5000)
</script>



<script>
    function showTime(){
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59




        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s ;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();
</script>

<script>
    function fixFieldState(inputField) {
        $(inputField).trigger("focusin");
        $(inputField).trigger("blur");
    }
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY7nRvFyz8x5OXhkagsIj5MW9g9vsNhlc&libraries=places&callback=initAutocomplete"
        async defer></script>
<script>
    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
                fixFieldState($("#"+addressType));
            }
        }
    }

    // Bias the autocomplete object to the user's geographical location,
    // as supplied by the browser's 'navigator.geolocation' object.
    function geolocate() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var geolocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                var circle = new google.maps.Circle({
                    center: geolocation,
                    radius: position.coords.accuracy
                });
                autocomplete.setBounds(circle.getBounds());
            });
        }
    }
</script>


<script>
    $(document).ready(function() {
        $('#modalTransport').on('show.bs.modal', function () {

            // Get the Add User button's data-id attribute
            var id = $('.show_modal').data('id');
            //console.log("id = " + id); // this shows that I have the id

            $("#runid").val( id ); // but this does not occur
        });
    });
</script>

<script>
    $('html').bind('keypress', function(e)
{
   if(e.keyCode == 13)
   {
      return false;
   }
});
</script>
@stop