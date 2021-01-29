<!-- begin panel -->
<div class="panel panel-inverse" data-sortable-id="index-3">
    <div class="panel-heading">
        <h4 class="panel-title">Recent History</h4>
    </div>
    <div id="schedule-calendar" class="bootstrap-calendar"></div>
    <div class="list-wrapper">
        <ul>
           @if($userHistory)
                @foreach($userHistory as $row)
                    <li>
                        <div class="d-flex">
                            <div class="p-2">{{$row->topic->label ?? ''}} </div>
                            <div class="p-2">
                                @if($row->completed)
                                    Completed
                                @else
                                    Started
                                    @endif
                            </div>
                        </div>


                    </li>
                @endforeach
           @endif

        </ul>
    </div>
</div>
<!-- end panel -->