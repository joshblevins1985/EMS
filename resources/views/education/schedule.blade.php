@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.messages')

    <link media="all" type="text/css" rel="stylesheet" href="https://unpkg.com/@fullcalendar/core@4.3.1/main.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.css">
    
    <style>
.fc-day-grid-event > .fc-content {
    white-space: normal;
}
</style>

    <script type="text/javascript" src='https://unpkg.com/@fullcalendar/core@4.3.1/main.min.js'></script>
    <script type="text/javascript" src='https://unpkg.com/@fullcalendar/interaction@4.3.0/main.min.js'></script>
    <script type="https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js"></script>
    <script type="text/javascript" src='https://unpkg.com/@fullcalendar/daygrid@4.3.0/main.min.js'></script>
    <script type="text/javascript" src='https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js'></script>
    <script type="text/javascript" src='https://unpkg.com/@fullcalendar/resource-common@4.3.0/main.min.js'></script>
    <script type="text/javascript" src='https://unpkg.com/@fullcalendar/resource-daygrid@4.3.0/main.min.js'></script>
    <script type="text/javascript" src='https://unpkg.com/@fullcalendar/resource-timegrid@4.3.0/main.min.js'></script>
  

    <script>

document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');
  var event = <?php echo $events ?>

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'resourceTimeGrid' ],
    timeZone: 'UTC',
    defaultView: 'resourceTimeGridFourDay',
    header: {
      left: 'prev,next',
      center: 'title',
      right: 'resourceTimeGridDay,resourceTimeGridFourDay'
    },
    views: {
      resourceTimeGridFourDay: {
        type: 'resourceTimeGrid',
        duration: { days: 2 },
        buttonText: '4 days'
      }
    },
    resources: [
      { id: '450', title: 'Joshua Blevins' },
      { id: '511', title: 'Betsy Chapman' },
      { id: '455', title: 'Adam Stone' },
      { id: '2450', title: 'Pam Bradshaw' }
    ],
    events: event
  });

  calendar.render();
});


    </script>
    
<div id='calendar'></div>

@stop

@section('styles')

@stop
@section('scripts')





@stop