@extends('layouts.default')

@section('title', 'Calendar')

@push('css')
    <link href="/assets/plugins/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet"/>
    <link href="/assets/plugins/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"
          rel="stylesheet"/>
    <link rel="stylesheet" href="assets/plugins/bootstrap-select/dist/css/bootstrap-select.min.css"/>




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

    <div class="row mb-3">
        <button type="button" class="btn btn-warning mr-3" data-toggle="modal" data-target="#basicExampleModal2">Add New CPR Class
        </button>
        <a href="/classes/create"><button type="button" class="btn btn-primary mr-3" >Add New EMS Course
        </button></a>

        <a href="#"><button type="button" class="btn btn-info mr-3" >Add New Observer Date
        </button></a>
    </div>
    <div class="row">
        <div class="col-xl-8">
            <div class="row mb-3">
                <!-- begin vertical-box -->
                <div class="vertical-box">

                    <!-- begin calendar -->
                    <div id="calendar" class="vertical-box-column calendar"></div>
                    <!-- end calendar -->
                </div>
                <!-- end vertical-box -->

            </div>
            <div class="row">
                <div class="col-xl-4 col-md-6">
        			<div class="widget widget-stats bg-blue">
        			    <div class="row">
        			       <div class="stats-icon"><i class="fa fa-desktop"></i></div>
            				<div class="stats-info">
            					<h4>TOTAL CALLS TO MAKE</h4>
            					<p>{{ count($qa) }}</p>
            				</div>
        			    </div>


        				<div class="stats-link">
        					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
        				</div>
        			</div>
        		</div>
            </div>

        </div>
        <div class="col-xl-4">
            <div class="col-xl-12">
                <div class="row">
                    <!--Panel-->
        <div class="card text-center">
            <div class="card-header warning-color white-text">
               <div class="col-lg-10"><h3>Open Compliance Issues</h3></div>


            </div>
            <div class="card-body">
                @if(count($encounters))
                <ul class="list-group">
                @foreach($encounters as $erow)
                <a href="compliance/{{$erow->id}} ">


                <li class="list-group-item d-flex justify-content-between align-items-center">

                        {{$erow->employee->first_name}} {{$erow->employee->last_name}} --

                        @if($erow->encounter_type == 1)
                        File Notation
                        @elseif($erow->encounter_type == 2)
                        Corrective Counciling
                        @elseif($erow->encounter_type == 3)
                        Verbal Warning
                        @elseif($erow->encounter_type == 4)
                        Written Warning
                        @elseif($erow->encounter_type == 5)
                        Suspension
                        @elseif($erow->encounter_type == 6)
                        Termination
                        @endif

                    <small>{{$erow->policies->policy_number}} -- {{$erow->policies->title}}.</small>
                </li>
                </a>

                @endforeach

            </ul>
            {{$encounters->links()}}
                @else
                <ul class="list-group">

                <li class="list-group-item d-flex justify-content-between align-items-center">
                    No Pending Compliance Issues
                </li>



            </ul>

                @endif

            </div>
            <div class="card-footer text-muted warning-color white-text">
                <p class="mb-0"><a href="encounters/list">View All</a></p>
            </div>
        </div>
        <!--/.Panel-->



                </div>

                <div class="row">
                    <!--Panel-->
        <div class="card text-center">
            <div class="card-header warning-color white-text">
               <div class="col-lg-10"><h3>My To Do List</h3></div>


            </div>
            <div class="card-body">
               <table class="table table">
                   <tbody>
                       @if($todo)
                       @foreach($todo as $row)
                       <tr >
                           <td style="border:none;">{!! $row->task !!}</td>
                       </tr>
                       <tr >
                           <td style="border:none;">
                           <span class="col"><strong>Due: {{Carbon\Carbon::parse($row->expected_complete)->diffForHumans()}}</strong></span>
                           <span class="col">Total Notes: {{ count($row->notes) }}</span>
                           </td>
                       </tr>
                       <tr>
                           <td>
                               <span class="col"> <a data-toggle="modal" data-target="#newTodoNoteModal" data-tid="{{$row->id}}"><i class="far fa-sticky-note"></i></a> </span>
                               <span class="col"><a href='#'><i class="far fa-edit"></i></a> </span>
                               <span class="col"> <a href="/task/active/{{$row->id}}"><span class="green-text"><i class="fal fa-snowboarding"></i></span></a> </span>
                               <span class="col"> <a href="/task/complete/{{$row->id}}"><span class="green-text"><i class="fas fa-check-double"></i></span></a> </span>
                           </td>
                       </tr>
                       @endforeach
                       @else
                       <tr>
                           <td>No Tasks to Complete</td>
                       </tr>
                       @endif
                   </tbody>
               </table>

            </div>
            <div class="card-footer text-muted warning-color white-text">
                <p class="mb-0"><a href="encounters/list">View All</a></p>
            </div>
        </div>
        <!--/.Panel-->



                </div>


            <div class="row mt-2">
                    <!--Panel-->
        <div class="card text-center">
            <div class="card-header warning-color white-text">
               <div class="col-lg-10"><h3>Open It Problems</h3></div>


            </div>
            <div class="card-body">

                <div class="accordion" id="accordionExample">
                      <div class="card">
                        <div class="card-header" id="headingOne">
                          <h2 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Jobs Currently In Progress
                            </button>
                          </h2>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">
                            <table class="table table-striped">
                                  <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if($it_tickets->where('status', 2))
                                      @foreach($it_tickets->where('status', 2) as $row)
                                      <tr @if($row->priority == 1) class="bg-danger" @elseif($row->priority == 2) class="bg-warning" @elseif($row->priority == 3) class="bg-primary" @elseif($row->priority == 4) class="bg-success"  @endif>
                                          <td>{{ Carbon\Carbon::parse($row->created_at)->format('m-d-Y H:i') }}</td>
                                          <td>@if($row->status == 1) Pending @elseif($row->status == 2) Working @elseif($row->status == 3) Completed @endif</td>
                                      </tr>
                                      <tr>
                                          <td colspan="2">{!! $row->description !!}</td>
                                      </tr>
                                      <tr>
                                          <td colspan="2" class="text-center">
                                              <span class="col">
                                                  <a data-toggle="modal" data-target="#supportNoteInfo" data-ticketId="{{ $row->id }}">
                                                      Total Notes: {{ count($row->notes) }}
                                                  </a>
                                                </span>
                                              <span class="col text-primary"><a data-toggle="modal" data-target="#supportNote" data-ticketId="{{ $row->id }}"><i class="fas fa-sticky-note" data-toggle="tooltip" title="Add note to support ticket."></i></a></span>
                                              @if(!$row->user_id) <span class="col text-warning"><a href="/ticketAssignMe/{{ $row->id }}"><i class="fas fa-user" data-toggle="tooltip" title="Assign the ticket to you."></i></a></span> @endif
                                              @if(!$row->user_id) <span class="col text-primary"><a data-toggle="modal" data-target="#assignTicket" data-ticketid="{{ $row->id }}" ><i class="fas fa-users" data-toggle="tooltip" title="Assign the ticket to another user."></i></a></span> @endif
                                              @if($row->status != 2) <span class="col text-primary"><a class="text-primary"  href="/ticketWorking/{{ $row->id }}"><i class="far fa-house-leave" data-toggle="tooltip" title="Mark the ticket as workin in progress."></i></a></span> @endif
                                              @if($row->status != 3) <span class="col text-success"><a class="text-success" href="/ticketComplete/{{ $row->id }}"><i class="fad fa-check-double" data-toggle="tooltip" title="Mark the ticket complete."></i></a></span> @endif
                                          </td>
                                      </tr>
                                      @endforeach
                                      @else
                                      <tr>
                                          <td col-span="3">No Support Request Recieved for This Asset</td>
                                      </tr>
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div class="card-header" id="headingTwo">
                          <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                              Pending Jobs
                            </button>
                          </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <div class="card-body">
                              <table class="table table-striped">
                                  <thead>
                                      <tr>
                                        <th>Date</th>
                                        <th>Status</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @if($it_tickets->where('status', 1))
                                      @foreach($it_tickets->where('status', 1) as $row)
                                      <tr @if($row->priority == 1) class="bg-danger" @elseif($row->priority == 2) class="bg-warning" @elseif($row->priority == 3) class="bg-primary" @elseif($row->priority == 4) class="bg-success"  @endif>
                                          <td>{{ Carbon\Carbon::parse($row->created_at)->format('m-d-Y H:i') }}</td>
                                          <td>@if($row->status == 1) Pending @elseif($row->status == 2) Working @elseif($row->status == 3) Completed @endif</td>
                                      </tr>
                                      <tr>
                                          <td colspan="2">{!! $row->description !!}</td>
                                      </tr>
                                      <tr>
                                          <td colspan="2" class="text-center">
                                              <span class="col">
                                                  <a data-toggle="modal" data-target="#supportNoteInfo" data-ticketId="{{ $row->id }}">
                                                      Total Notes: {{ count($row->notes) }}
                                                  </a>
                                                </span>
                                              <span class="col text-primary"><a data-toggle="modal" data-target="#supportNote" data-ticketId="{{ $row->id }}"><i class="fas fa-sticky-note" data-toggle="tooltip" title="Add note to support ticket."></i></a></span>
                                              @if(!$row->user_id) <span class="col text-warning"><a href="/ticketAssignMe/{{ $row->id }}"><i class="fas fa-user" data-toggle="tooltip" title="Assign the ticket to you."></i></a></span> @endif
                                              @if(!$row->user_id) <span class="col text-primary"><a data-toggle="modal" data-target="#assignTicket" data-ticketid="{{ $row->id }}" ><i class="fas fa-users" data-toggle="tooltip" title="Assign the ticket to another user."></i></a></span> @endif
                                              @if($row->status != 2) <span class="col text-primary"><a class="text-primary"  href="/ticketWorking/{{ $row->id }}"><i class="far fa-house-leave" data-toggle="tooltip" title="Mark the ticket as workin in progress."></i></a></span> @endif
                                              @if($row->status != 3) <span class="col text-success"><a class="text-success" href="/ticketComplete/{{ $row->id }}"><i class="fad fa-check-double" data-toggle="tooltip" title="Mark the ticket complete."></i></a></span> @endif
                                          </td>
                                      </tr>
                                      @endforeach
                                      @else
                                      <tr>
                                          <td col-span="3">No Support Request Recieved for This Asset</td>
                                      </tr>
                                      @endif
                                  </tbody>
                              </table>
                          </div>
                        </div>
                      </div>

                    </div>


            </div>
            <div class="card-footer text-muted warning-color white-text">
                <p class="mb-0"><a href="#">View All</a></p>
            </div>
        </div>
        <!--/.Panel-->
                </div>
        </div>
                    </div>
    </div>

@endsection


@include('assets.partials.modalAddSupportNote')
@include('assets.partials.modalSupportNotesInfo')
@include('assets.partials.modalAttachAsset')

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

<!--Attandance Model-->
<div class="modal fade right" id="newTodoNoteModal" tabindex="-1" role="dialog" aria-labelledby="newTodoNoteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-fluid modal-full-height modal-right" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTodoNoteModalLabel">Add Note To Todo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'task.note', 'id' => 'badrunsheets-form']) !!}

                <!--Textarea with icon prefix-->
                <div class="md-form">
                    <i class="fas fa-pencil-alt prefix"></i>
                    <textarea id="task" name="note" class="md-textarea form-control" rows="3"></textarea>
                    <label for="task">Note to be added</label>
                </div>

                <input type="hidden" name="tid" id="tid" value="">

                <button class="btn btn-info btn-block my-4" type="submit">Add Report</button>

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
    $('#newTodoNoteModal').on('show.bs.modal', function(e) {
        var tid = $(e.relatedTarget).data('tid');

        $("#tid").val(tid);
    });
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

<script src="assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="assets/js/demo/form-wysiwyg.demo.js"></script>
	<script src="assets/plugins/select2/dist/js/select2.min.js"></script>

<script>
    var handleSelect2 = function() {
	$(".default-employee").select2();
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

$(document).ready(function() {
	FormPlugins.init();
});
</script>


<script>
$('#supportNote').on('show.bs.modal', function(e) {
    var ticketId = $(e.relatedTarget).data('ticketid');

    console.log("id = " + ticketId); // this shows that I have the id
    $(this).find("#ticketId").val(ticketId)


});
</script>

<script>
$('#attachAsset').on('show.bs.modal', function(e) {
    var assetId = $(e.relatedTarget).data('assetid');

    console.log("id = " + assetId); // this shows that I have the id
    $(this).find("#assetId").val(assetId)


});
</script>

<script>
    $('#supportNoteInfo').on('show.bs.modal', function (event) {

      var ticketId = $(event.relatedTarget).data('ticketid');
      var display = data();
      var modal = $(this)

      $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });

        function data(){
            $('#notes').load('/assetTicketNotes/' + ticketId);
        }

        document.getElementById("notes").innerHTML = display;


    })
</script>
@endpush
