<link href="/public/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />

<!-- begin panel -->
<div class="panel panel-inverse" data-sortable-id="index-3">
    <div class="panel-heading">
        <h4 class="panel-title">Today's Schedule</h4>
    </div>
    <div id="schedule-calendar" class="bootstrap-calendar"></div>
    <div class="list-group">
        @if($classroom->schedule)
        @foreach($classroom->schedule as $row)
        <a href="javascript:;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-ellipsis">
            {{ $row->label }}
            <span class="badge bg-teal f-s-10">{{ Carbon\Carbon::parse($row->start_time)->format('m/d H:i') }}</span>
        </a>
        @endforeach
        @else
        <a href="javascript:;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-ellipsis">
            No Scheduled Activities
            
        </a>
        @endif
  
    </div>
</div>
<!-- end panel -->

<script src="/public/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
<script>
    var handleScheduleCalendar = function() {
        var monthNames = ["January", "February", "March", "April", "May", "June",  "July", "August", "September", "October", "November", "December"];
        var dayNames = ["S", "M", "T", "W", "T", "F", "S"];

        var now = new Date(),
            month = now.getMonth() + 1,
            year = now.getFullYear();

        var events = [[
            '2/' + month + '/' + year,
            'Popover Title',
            '#',
            COLOR_GREEN,
            'Some contents here'
        ], [
            '5/' + month + '/' + year,
            'Tooltip with link',
            'http://www.seantheme.com/',
            COLOR_BLACK
        ], [
            '18/' + month + '/' + year,
            'Popover with HTML Content',
            '#',
            COLOR_BLACK,
            'Some contents here <div class="text-right"><a href="http://www.google.com">view more >>></a></div>'
        ], [
            '28/' + month + '/' + year,
            'Color Admin V1.3 Launched',
            'http://www.seantheme.com/color-admin-v1.3',
            COLOR_BLACK,
        ]];

        var calendarTarget = $('#schedule-calendar');
        $(calendarTarget).calendar({
            months: monthNames,
            days: dayNames,
            events: events,
            popover_options:{
                placement: 'top',
                html: true
            }
        });
        $(calendarTarget).find('td.event').each(function() {
            var backgroundColor = $(this).css('background-color');
            $(this).removeAttr('style');
            $(this).find('a').css('background-color', backgroundColor);
        });
        $(calendarTarget).find('.icon-arrow-left, .icon-arrow-right').parent().on('click', function() {
            $(calendarTarget).find('td.event').each(function() {
                var backgroundColor = $(this).css('background-color');
                $(this).removeAttr('style');
                $(this).find('a').css('background-color', backgroundColor);
            });
        });
    };

    var Dashboard = function () {
        "use strict";
        return {
            //main function
            init: function () {
                handleScheduleCalendar();
            }
        };
    }();

    $(document).ready(function() {
        Dashboard.init();
    });
</script>