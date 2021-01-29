@extends('layouts.sidebar-fixed')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet"/>
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"/>

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

    <style>

        .scrollBar {
            overflow-y: scroll;

        }

        .pac-container {
            z-index: 10000 !important;
        }


    </style>
    <link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet"/>
@endpush

@section('content')


    <div class="row ">

        <div class="col-8">
            @include('dispatch.partials.filters')
        </div>


    <div class="col-2">
        @include('dispatch.partials.clock')
    </div>

    <div class="col-2">
        @include('dispatch.partials.dispatch_notification')
    </div>

    </div>
    <div class="row">
        <div class="col-lg-12">

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


@endsection

@include('dispatch.partials.modalunitstatus')
@include('dispatch.partials.modalunit')
@include('dispatch.partials.modaltransport')
@include('dispatch.partials.modalsendmessage')

@push('scripts')

    <script src="/assets/plugins/moment/moment.js"></script>
    <script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>

    <script>
        $('#unitstatusModal').on('show.bs.modal', function (e) {
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
        $('#modalSendMessage').on('show.bs.modal', function (e) {
            var unit = $(e.relatedTarget).data('unit');

            $('#send_message').attr('action', '/dispatch/message/' + unit);
        });
    </script>

    <script>

        var draggableElements = document.querySelectorAll('[draggable="true"]');

        [].forEach.call(draggableElements, function (element) {
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

            if (localStorage.getItem('currentDragElement') == event.target.dataset.uuid) {
                return;
            }

            currentDragElement = document.querySelector('[data-uuid="' + localStorage.getItem('currentDragElement') + '"]');

            console.log('dragged element ', currentDragElement, ' on element ', event.target)

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
            function () {
                $('#active').load('{{url('active')}}/' + search);
            }, 5000)
    </script>





    <script>
        function fixFieldState(inputField) {
            $(inputField).trigger("focusin");
            $(inputField).trigger("blur");
        }
    </script>

    <script type="text/javascript"
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCY7nRvFyz8x5OXhkagsIj5MW9g9vsNhlc&libraries=places&callback=initAutocomplete"
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
                    fixFieldState($("#" + addressType));
                }
            }
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
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
        $(document).ready(function () {
            $('#modalTransport').on('show.bs.modal', function () {

                // Get the Add User button's data-id attribute
                var id = $('.show_modal').data('id');
                //console.log("id = " + id); // this shows that I have the id

                $("#runid").val(id); // but this does not occur
            });
        });
    </script>

    <script>
        $('html').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    </script>

    <script>
        var handleSelect2 = function () {
            $(".multiple-select2").select2();
        };

        var FormPlugins = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleSelect2();
                }
            };
        }();

        $(document).ready(function () {
            FormPlugins.init();
        });
    </script>
@endpush
