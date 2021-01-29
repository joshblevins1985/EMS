<!--Attandance Model-->
    <div class="modal fade right overflow-auto" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fluid modal-full-height modal-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="notificationModalLabel">My Notifications</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Card-->
        <div class="card">
            
            

            <!--Card content-->
            <div >
                <ul class="list-group">

    @if(auth()->user()->unreadNotifications->count())
    <a class="dropdown-item" href="{{ route('markAllRead') }}">
        <i class="fas fa-sign-out-alt text-muted mr-2"></i>
        Mark all as Read
    </a>
    <div class="dropdown-divider"></div>

                        @foreach(auth()->user()->unreadNotifications as $notification)

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-lg-8">
                                        {!!$notification->data['data']!!}
                                    </div>
                                    <div class="col-lg-2">

                                        @if(empty($notification->data['link'])) @else<a href='{{$notification->data['link']}}'><i class="fas fa-file-chart-pie"></i></a>@endif


                                    </div>
                                    <div class="col-lg-2">

                                        <a href="/notification/read/{{$notification->id}}"><span class="red-text"><i class="fab fa-xbox"></i></span></a>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        {{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
                                    </div>
                                </div>

                            </li>


                        @endforeach
                    @else

    @endif

        <a class="dropdown-item" >
            <i class="fas fa-sign-out-alt text-muted mr-2"></i>
            No Notifications
        </a>

    
            </ul>
    <!--
    @foreach(auth()->user()->readNotifications as $notification)
        <a class="dropdown-item" href="#">
            {{$notification->data['data']}}
        </a>
    @endforeach
    -->
</div>

        </div>
        <!--/.Card-->
      </div>
    
    </div>
  </div>
</div>