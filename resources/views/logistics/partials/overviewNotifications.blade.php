<?php
$waste_C = count($waste);
$notice_C = count($narcotic_audit);

$total_notice = $waste_C + $notice_C;
?>
<li class="nav-item dropdown border-left ">
    <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="javascript;" data-toggle="dropdown">
         <i class="mdi mdi-bell"></i> Logistic Notifications
        @if($total_notice) <span class="count bg-danger"> {{$total_notice}} </span> @endif
    </a>

    <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list dropdown-notification" aria-labelledby="notificationDropdown" id="narcnotification" style="width: 50rem;">
        <h6 class="p-3 mb-0">Notifications</h6>
        <div class="dropdown-divider"></div>

            @foreach($waste as $row)
                <a class="dropdown-item preview-item" href="narcoticwaste/{{$row->id}}/edit" >
                    <div class="preview-thumbnail">
                        <div class="preview-icon bg-dark rounded-circle">
                            @if(empty($notification->data['img']))	<i class="mdi mdi-bell-ring text-warning"></i> @else <img src="{{ asset($notification->data['img']) }} " alt="Notification" height="42" width="42"> @endif
                        </div>
                    </div>
                    <div class="preview-item-content">
                        <p class="preview-subject mb-1">Narcotic Use Notification</p>
                        <p class="text-muted text-wrap mb-0"> {{$row->employee->first_name}} {{$row->employee->last_name}} has used Vial ID number {{sprintf('%08d', $row->vial->id )}} - {{$row->vial->medications->trade_name}} </p>
                    </div>
                    <div class="preview-item-content">

                        <p class="text-muted ellipsis mb-0"> {{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }} </p>
                    </div>
                </a>
            @endforeach
        @foreach($narcotic_audit as $row)
            <a class="dropdown-item preview-item" href="narcoticaudit/{{$row->id}}/edit" >
                <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                        @if(empty($notification->data['img']))	<i class="mdi mdi-bell-ring text-warning"></i> @else <img src="{{ asset($notification->data['img']) }} " alt="Notification" height="42" width="42"> @endif
                    </div>
                </div>
                <div class="preview-item-content">
                    <p class="preview-subject mb-1">Narcotic Use Notification</p>
                    <p class="text-muted text-wrap mb-0"> {{$row->employee->first_name}} {{$row->employee->last_name}} {{$row->incident}}</p>
                </div>
                <div class="preview-item-content">

                    <p class="text-muted ellipsis mb-0"> {{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }} </p>
                </div>
            </a>
        @endforeach

            <p class="p-3 mb-0 text-center">See all notifications</p>
    </div>
</li>

