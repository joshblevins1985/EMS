<!-- begin panel -->
<div class="panel panel-inverse" data-sortable-id="index-3">
    <div class="panel-heading">
        <h4 class="panel-title">Class Instructors</h4>
    </div>
    <div id="schedule-calendar" class="bootstrap-calendar"></div>
    <div class="list-group">
        @if($classroom->instructors)
            @foreach($classroom->instructors as $row)
                <a href="javascript:;" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center text-ellipsis">
                    {{ $row->employee->first_name or 'Unknown'}} {{ $row->employee->last_name or '' }}
                    <a class="badge badge-primary" href="mailto:{{ $row->employee->email }}?subject=Student Response">Contact</a>
                </a>
            @endforeach
        @else
        
        @endif
        
        
    </div>
</div>
<!-- end panel -->