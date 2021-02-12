<i class="far fa-bell"></i>
<div class="new-messages-count">
    {{ auth()->user()->unreadNotifications->count() }}
</div>
<div class="os-dropdown light message-list">

    @if(auth()->user()->unreadNotifications->count())

    <ul>
        <li>
            <a href="{{ route('markAllRead') }}">
                <div class="user-avatar-w">
                    <i class="fas fa-trash-alt text-danger"></i>
                </div>
                <div class="message-content">
                    <h6 class="message-from">
                        Mark all notifications as read.
                    </h6>
                    <h6 class="message-title">

                    </h6>
                </div>
            </a>
        </li>
        @foreach(auth()->user()->unreadNotifications as $notification)
        <li>
            <a href="#">
                <div class="user-avatar-w">
                    @if(empty($notification->data['img']))	<i class="mdi mdi-bell-ring text-warning"></i> @else <img src="{{ asset($notification->data['img']) }} " alt="Notification" height="42" width="42"> @endif
                </div>
                <div class="message-content">
                    <h6 class="message-from">
                        {!! $notification->data['data'] !!}
                    </h6>
                    <h6 class="message-title">
                        {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                    </h6>
                </div>
            </a>
        </li>
        @endforeach
            </ul>
        @endif
</div>