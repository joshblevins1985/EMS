<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle"
           href="#"
           id="navbarDropdown"
           role="button"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false">
            <i class="fa fa-bell">Notifications </i>
            @if(auth()->user()->unreadNotifications->count())
                <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">

            @if(auth()->user()->unreadNotifications->count())
                <a class="dropdown-item" href="{{ route('markAllRead') }}">
                    <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                    Mark all as Read
                </a>
                <div class="dropdown-divider"></div>
            @endif


            @foreach(auth()->user()->unreadNotifications as $notification)
                <a class="dropdown-item" style="background: lightcoral" href="#">
                    {{$notification->data['data']}}
                </a>
        @endforeach
        <!--
                    @foreach(auth()->user()->readNotifications as $notification)
            <a class="dropdown-item" href="#">
{{$notification->data['data']}}
                    </a>
@endforeach
                -->
        </div>
    </li>
</ul>