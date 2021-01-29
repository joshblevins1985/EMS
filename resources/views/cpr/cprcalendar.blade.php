@extends('layouts.default')

@section('title', 'Calendar')

@push('css')
    <link href="/assets/plugins/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="/assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css"/>




@endpush

@section('content')

    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Calendar</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Calendar
        <small>Education Department Calendar</small>
    </h1>
    <!-- end page-header -->
    <hr/>

    <div class="row">
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#basicExampleModal2">Add New CPR
            Class
        </button>
    </div>
    <!-- begin vertical-box -->
    <div class="vertical-box">
        <!-- begin event-list -->
        <div class="vertical-box-column p-r-30 d-none d-lg-table-cell" style="width: 215px">
            <div id="external-events" class="fc-event-list">
                <h5 class="m-t-0 m-b-15">Pending CPR Classes</h5>
                <div class="fc-event" data-color="#00acac">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-success"></i></div>
                    Meeting with Client
                </div>
                <div class="fc-event" data-color="#348fe2">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-blue"></i></div>
                    IOS App Development
                </div>
                <div class="fc-event" data-color="#f59c1a">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-warning"></i></div>
                    Group Discussion
                </div>
                <div class="fc-event" data-color="#ff5b57">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-danger"></i></div>
                    New System Briefing
                </div>
                <div class="fc-event">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-inverse"></i></div>
                    Brainstorming
                </div>
                <hr class="bg-grey-lighter m-b-15"/>
                <h5 class="m-t-0 m-b-15">Pending Courses</h5>
                <div class="fc-event" data-color="#00acac">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-success"></i></div>
                    Meeting with Client
                </div>
                <div class="fc-event" data-color="#348fe2">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-blue"></i></div>
                    IOS App Development
                </div>
                <div class="fc-event" data-color="#f59c1a">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-warning"></i></div>
                    Group Discussion
                </div>
                <div class="fc-event" data-color="#ff5b57">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-danger"></i></div>
                    New System Briefing
                </div>
                <div class="fc-event">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-inverse"></i></div>
                    Brainstorming
                </div>
                <hr class="bg-grey-lighter m-b-15"/>
                <h5 class="m-t-0 m-b-15">Observers </h5>
                <div class="fc-event" data-color="#b6c2c9">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                    Other Event 1
                </div>
                <div class="fc-event" data-color="#b6c2c9">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                    Other Event 2
                </div>
                <div class="fc-event" data-color="#b6c2c9">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                    Other Event 3
                </div>
                <div class="fc-event" data-color="#b6c2c9">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                    Other Event 4
                </div>
                <div class="fc-event" data-color="#b6c2c9">
                    <div class="fc-event-icon"><i class="fas fa-circle fa-fw f-s-9 text-grey"></i></div>
                    Other Event 5
                </div>
            </div>
        </div>
        <!-- end event-list -->
        <!-- begin calendar -->
        <div id="calendar" class="vertical-box-column calendar"></div>
        <!-- end calendar -->
    </div>
    <!-- end vertical-box -->
@endsection

<!-- Modal -->
<div class="modal fade" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add New CPR Class</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('cprclasses.store'), 'method' => 'POST']) !!}
                @csrf

                <div class="md-form">
                    <input type="text" id="number" name="number" class="form-control">
                    <label for="number">Course Number</label>
                </div>

                <select class="form-control mt-2 mb-2 selectpicker" name="location" data-live-search="true"
                        data-style="btn-inverse" data-styleBase="form-control">
                    <option value="" disabled selected>Choose Facility</option>
                    @foreach($facilities as $id => $facility)
                        <option value="{{$id}}">{{$facility}}</option>
                    @endforeach
                </select>

                <div class="input-group date mb-2 btn-inverse" id="startTime">
                    <label for="startTime">Start Time</label>
                    <input type="text" name="start" id="start" class="form-control" data-parsley-group="step-3"
                           data-parsley-required="true"/>
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>
                <div class="input-group date mb-2" id="endTime">
                    <label for="endTime">Start Time</label>
                    <input type="text" name="end" id="endTime" class="form-control" data-parsley-group="step-3"
                           data-parsley-required="true"/>
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                </div>


                <div class="md-form">
                    <i class="fa fa-envelope prefix"></i>
                    <input type="text" id="inputIconEx2" name="email" class="form-control">
                    <label for="inputIconEx2">E-mail address for Certificates</label>
                </div>

                <select class="form-control mt-2 selectpicker" name="instructor" searchable="Search Instructor">
                    <option value="" disabled selected>Choose Instructor</option>
                    @foreach($instructors as $row)
                        <option value="{{$row->id}}">{{$row->last_name}}, {{$row->first_name}}</option>
                    @endforeach
                </select>

                <select class="form-control mt-2 selectpicker" name="status">
                    <option value="" disabled selected>Choose Facility</option>

                    <option value="1">Scheduled</option>
                    <option value="2">Instructed</option>
                    <option value="3">Invoice Sent</option>
                    <option value="4">Paid</option>
                    <option value="5">Canceled</option>
                    <option value="6">Completed</option>


                </select>


                <button class="btn btn-info btn-block my-4" type="submit">Add New CPR Class</button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

@include('cpr.partials.modalCprClassEdit')
@push('scripts')
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/plugins/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="/assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script>$.fn.selectpicker.Constructor.BootstrapVersion = '4';</script>



    <script>

    </script>


    <script>
        /*
Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Version: 4.4.0
Author: Sean Ngu
Website: http://www.seantheme.com/color-admin/admin/
*/
        var handleDateTimePicker = function () {
            $('#startTime').datetimepicker({
                format: 'YYYY-MM-DD HH:mm'
            });
            $('#endTime').datetimepicker({});

        };

        var handleCalendarDemo = function () {
            $('#external-events .fc-event').each(function () {
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true, // maintain when user navigates (see docs on the renderEvent method)
                    color: ($(this).attr('data-color')) ? $(this).attr('data-color') : ''
                });
                $(this).draggable({
                    zIndex: 999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });
            });

            var date = new Date();
            var currentYear = date.getFullYear();
            var currentMonth = date.getMonth() + 1;
            currentMonth = (currentMonth < 10) ? '0' + currentMonth : currentMonth;

            $('#calendar').fullCalendar({
                height: $(window).height() * 0.83,
                header: {
                    left: 'month,agendaWeek,agendaDay',
                    center: 'title',
                    right: 'prev,today,next '
                },
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function () {
                    $(this).remove();
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end) {
                    var title = prompt('Event Title:');
                    var eventData;
                    if (title) {
                        eventData = {
                            title: title,
                            start: start,
                            end: end
                        };
                        $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
                    }
                    $('#calendar').fullCalendar('unselect');
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: {!! $events !!},


            });
        };

        var Calendar = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleCalendarDemo();
                }
            };
        }();

        var FormPlugins = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDateTimePicker();
                }
            };
        }();

        $(document).ready(function () {
            Calendar.init();
            FormPlugins.init();
        });
    </script>

@endpush
