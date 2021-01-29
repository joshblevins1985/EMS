@extends('layouts.sidebar-fixed')

@section('title', 'Pending Incidents')

@push('css')
    <style>
        .pac-container {

            position: relative;
            z-index: 9999999
        }

        .toggle.ios, .toggle-on.ios, .toggle-off.ios {
            border-radius: 20px;
            background-color: black;
        }
        .has-error .select2-selection {
            border-color: rgb(185, 74, 72) !important;
        }

        .toggle.ios .toggle-handle {
            border-radius: 20px;
            background-color: black;
        }
        .loader{
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/assets/img/loader.gif')
            50% 50% no-repeat rgb(249,249,249);
        }
    </style>
    <link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet"/>

@endpush

@section('content')
    @include('partials.messages')

    <div class="row pb-2">

        <div class="col-lg-6">
            @include('dispatch.partials.filters')
        </div>


        <div class="col-lg-2" onload="startTime()">
            @include('dispatch.partials.clock')
        </div>
        <div class="col-lg-2">
            <a href="/dispatch/alertScreen">
                <button type="button" class="btn btn-info btn-rounded">Search Alerts</button>
            </a>
        </div>
        <div class="col-lg-2">
            <button type="button" class="btn btn-danger btn-rounded" data-toggle="modal" data-target="#modalIncident">
                New Response
            </button>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <h3 class="note note-primary text-center"><strong>Pending Incidents</strong></h3>

                </div>
            </div>

            @include('dispatch.partials.pending.card_pending')

        </div>

    </div>

@endsection

@include('dispatch.partials.modalAlert')



@push('scripts')
    <script src="/assets/dispatch/modalDispatch.js"></script>
    <script src="/assets/dispatch/unitstatusModal.js"></script>
    <script src="/assets/dispatch/pendingDraggable.js"></script>
    <script src="/assets/dispatch/unitModal.js"></script>
    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>
    <script>
        $('#modalAlert').on('show.bs.modal', function (event) {

            var incidentId = $(event.relatedTarget).data('incident_id');
            console.log(incidentId);


            $('#incident_alerts').load('/incident/alerts/' + incidentId);

        })
    </script>

    <script>
        var handleSelect2 = function () {
            $(".default-select2").select2();
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



    <script>
        $(".status").click(function () {
            var anchorValue = $(this).attr("href");
            alert(anchorValue);
        });
    </script>

    <script>
        function fixFieldState(inputField) {
            $(inputField).trigger("focusin");
            $(inputField).trigger("blur");
        }
    </script>

    <script>
        $('html').bind('keypress', function (e) {
            if (e.keyCode == 13) {
                return false;
            }
        });
    </script>

    <script type="text/javascript">

        var path = "{{ route('patient_autocomplete') }}";

        $('input.typeahead').typeahead({

            source: function (query, process, data) {

                objects = [];
                map = {};

                $.each(data, function (i, object) {
                    map[object.first_name] = object;
                    objects.push(object.first_name);
                });
                process(objects);
            },
            updater: function (item) {
                $('patient_id').val(map[item].id);
                return item;
            }


        });

    </script>

    <script>
        var Timer;

        function Start() {
            $("#autocomplete").change(function () {
                clearTimeout(Timer);
                Timer = setTimeout(SendRequest, 800);
            });
        }

        function SendRequest() {
            var house_number = $('#street_number').val();
            var street_name = $('').val();

            $.ajax({
                type: 'POST', //THIS NEEDS TO BE GET
                url: '/dispatch/alert',
                data: {house: house_number, street: street_name},
                success: function (data) {
                    $('#alerts').html(data);
                },
                error: function () {
                    console.log(data);
                }
            });

        }

        $(Start);
    </script>

    <script>
        var handleSelect2 = function () {
            $(".multiple-select2").select2();
            $(".default-select2").select2();
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

<form action="{{ route('dispatch.store') }}" method="post" enctype="multipart/form-data" class="dispatch_form">
    @include('dispatch.partials.modalincident')
</form>
@include('dispatch.partials.modalunitstatus')
@include('dispatch.partials.modalunit')
@include('dispatch.partials.modaldispatchunit')
