<nav class="navbar fixed-top align-items-start navbar-expand-lg pl-0 pr-0 py-0">

    <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand mr-0" href="{{ url('/') }}">
            <img src="{{ url('public/assets/img/peasi.png') }}" height="35" alt="{{ settings('app_name') }}">
        </a>
    </div>

    <div>
        <!-- SideNav slide-out button -->
        <a href="#" data-activates="slide-out" class=" p-3 button-collapse"><i class="fa fa-bars"></i></a>

        <button class="navbar-toggler button-collapse" data-activates="slide-out" type="button">
            <i class="fas fa-align-right text-muted"></i>
        </button>

        <button class="navbar-toggler mr-3"
                type="button"
                data-toggle="collapse"
                data-target="#top-navigation"
                aria-controls="top-navigation"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <i class="fas fa-bars text-muted"></i>
        </button>
    </div>

    <div class="collapse navbar-collapse" id="top-navigation">
        <div class="row ml-2">
            <div class="col-lg-12 d-flex align-items-center py-3">
                <h4 class="page-header mb-0">
                    @yield('page-heading')
                </h4>

                <ol class="breadcrumb mb-0 text-black">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}" class="text-muted">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>

                    @yield('breadcrumbs')
                </ol>
            </div>
        </div>
        
        <ul class="navbar-nav ml-auto float-right">
            <a data-toggle="modal" data-target="#todoModal">
            <li class="nav-item dropdown">
            <span> <i class="far fa-clipboard-list-check">To Do List </i>
            
            <?php 
                $todo = Vanguard\ToDo::where('assigned_to', auth()->user()->id)->where('status', '<', 4)->orderBy('expected_complete')->get();
                
                $employee = Vanguard\Employee::where('status', 5)->get();
            ?>
                    @if(count($todo) > 0)
                        <span class="badge badge-danger">{{count($todo)}}</span>
                    @endif
                </span>
            </li>
            </a>
        </ul>

        <ul class="navbar-nav ml-auto">
            <a data-toggle="modal" data-target="#notificationModal">
            <li class="nav-item dropdown">
            <span> <i class="fa fa-bell">Notifications </i>
                    @if(auth()->user()->unreadNotifications->count())
                        <span class="badge badge-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                    @endif
                </span>
            </li>
            </a>
        </ul>

        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"
                   href="#"
                   id="navbarDropdown"
                   role="button"
                   data-toggle="dropdown"
                   aria-haspopup="true"
                   aria-expanded="false">
                    <img src="{{asset('storage/employee_photos/'.Auth::user()->employee->eid.'.png')}}"
                         width="50"
                         height="50"
                         class="rounded-circle img-thumbnail img-responsive">
                </a>
                <div class="dropdown-menu dropdown-menu-right position-absolute" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="fas fa-user text-muted mr-2"></i>
                        @lang('app.my_profile')
                    </a>
                    @if (config('session.driver') == 'database')
                        <a href="{{ route('profile.sessions') }}" class="dropdown-item">
                            <i class="fas fa-list text-muted mr-2"></i>
                            @lang('app.active_sessions')
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>

                    <a class="dropdown-item" href="{{ route('auth.logout') }}">
                        <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                        @lang('app.logout')
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

@include('partials.notifications')
@include('partials.todo')
@include('partials.todo_form')
@include('partials.todo_note')



<script>
    $('#newTodoNoteModal').on('show.bs.modal', function(e) {
        var tid = $(e.relatedTarget).data('tid');

        $("#tid").val(tid);
    });
</script>


