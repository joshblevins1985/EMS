@php
	$headerClass = (!empty($headerInverse)) ? 'navbar-inverse ' : 'navbar-default ';
	$headerMenu = (!empty($headerMenu)) ? $headerMenu : '';
	$headerMegaMenu = (!empty($headerMegaMenu)) ? $headerMegaMenu : '';
	$headerTopMenu = (!empty($headerTopMenu)) ? $headerTopMenu : '';
@endphp
<!-- begin #header -->
<div id="header" class="header {{ $headerClass }}">
	<!-- begin navbar-header -->
	<div class="navbar-header">
		@if ($sidebarTwo)
		<button type="button" class="navbar-toggle pull-left" data-click="right-sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		@endif
		<a href="#" class="navbar-brand"><span class="fa fa-asterisk text-blue m-3"></span> <b class="text-blue">EMS</b> <span class="text-blue">C</span><span class="text-yellow">omplete</span></a>
		<img src="{{ url('/assets/img/peasi.png') }}" height="35" alt="{{ settings('app_name') }}">
		@if ($headerMegaMenu)
			<button type="button" class="navbar-toggle pt-0 pb-0 mr-0" data-toggle="collapse" data-target="#top-navbar">
				<span class="fa-stack fa-lg text-inverse">
					<i class="far fa-square fa-stack-2x"></i>
					<i class="fa fa-cog fa-stack-1x"></i>
				</span>
			</button>
		@endif
		@if (!$sidebarHide && $topMenu)
			<button type="button" class="navbar-toggle pt-0 pb-0 mr-0 collapsed" data-click="top-menu-toggled">
				<span class="fa-stack fa-lg text-inverse">
					<i class="far fa-square fa-stack-2x"></i>
					<i class="fa fa-cog fa-stack-1x"></i>
				</span>
			</button>
		@endif
		@if (!$sidebarHide && !$headerTopMenu)
		<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		@endif
		@if ($headerTopMenu)
			<button type="button" class="navbar-toggle" data-click="top-menu-toggled">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		@endif
	</div>
	<!-- end navbar-header -->

	@includeWhen($headerMegaMenu, 'includes.header-mega-menu')

	<!-- begin header-nav -->
	<ul class="navbar-nav navbar-right">
		<li class="navbar-form">
			<form action="" method="POST" name="search_form">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Enter keyword" />
					<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
				</div>
			</form>
		</li>

		@if(auth()->user()->unreadNotifications->count())
		<li class="dropdown dropdown-notifications">
			<a href="#" data-toggle="dropdown" class="dropdown-toggle fs-14">
				<i data-count="0" class="fa fa-bell data-count"></i>
				@if(auth()->user()->unreadNotifications->count()) <span class="label notif-count">{{ auth()->user()->unreadNotifications->count() }}</span> @endif
			</a>
			<div class="dropdown-menu media-list dropdown-menu-right" style="width: 600px !important;">
				<div class="dropdown-header">NOTIFICATIONS @if(auth()->user()->unreadNotifications->count()) <span class="notif-count">{{ auth()->user()->unreadNotifications->count() }}</span> @endif  </div>
				<ul class="notifications list-group">
                    @if(auth()->user()->unreadNotifications->count())
                    <a class="dropdown-item" href="{{ route('markAllRead') }}">
                        <i class="fas fa-sign-out-alt text-muted mr-2"></i>
                        Mark all as Read
                    </a>
                    <div class="dropdown-divider"></div>
                    @endif
                    @foreach(auth()->user()->unreadNotifications as $notification)

                    <a @if(empty($notification->data['link'])) href="javascript:;" @else href='{{$notification->data['link']}}' @endif class="dropdown-item media">
    					<div class="media-left">
    					@if(empty($notification->data['img']))	<i class="fa fa-bug media-object bg-silver-darker"></i> @else <img src="{{ asset($notification->data['img']) }} " alt="Notification" height="42" width="42"> @endif
    					</div>
    					<div class="media-body">
    						<h6 class="media-heading text-wrap">{!! $notification->data['data'] !!}<i class="fa fa-exclamation-circle text-danger"></i></h6>
    						<div class="text-muted f-s-10">3 minutes ago</div>
    					</div>
    					<div class="media-right">
    					    {{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}
    					    <a href="/notification/read/{{$notification->id}}"><span class="red-text"><i class="fab fa-xbox"></i></span></a>
    					</div>
				    </a>


                @endforeach
                </ul>


				<div class="dropdown-footer text-center">
					<a href="javascript:;">View more</a>
				</div>
			</div>
		</li>
		@endif

		@isset($headerLanguageBar)
		<li class="dropdown navbar-language">
			<a href="#" class="dropdown-toggle pr-1 pl-1 pr-sm-3 pl-sm-3" data-toggle="dropdown">
				<span class="flag-icon flag-icon-us" title="us"></span>
				<span class="name d-none d-sm-inline">EN</span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu">
				<a href="javascript:;" class="dropdown-item"><span class="flag-icon flag-icon-us" title="us"></span> English</a>
				<a href="javascript:;" class="dropdown-item"><span class="flag-icon flag-icon-cn" title="cn"></span> Chinese</a>
				<a href="javascript:;" class="dropdown-item"><span class="flag-icon flag-icon-jp" title="jp"></span> Japanese</a>
				<a href="javascript:;" class="dropdown-item"><span class="flag-icon flag-icon-be" title="be"></span> Belgium</a>
				<div class="dropdown-divider"></div>
				<a href="javascript:;" class="dropdown-item text-center">more options</a>
			</div>
		</li>
		@endisset
		<li class="dropdown navbar-user">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				<img src="{{asset('storage/employee_photos/'.Auth::user()->employee->eid.'.png')}}" alt="" />
				<span class="d-none d-md-inline">{{Auth::user()->employee->first_name}} {{Auth::user()->employee->last_name}}</span> <b class="caret"></b>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<a href="javascript:;" class="dropdown-item">Edit Profile</a>
				<a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
				<a href="javascript:;" class="dropdown-item">Calendar</a>
				<a href="javascript:;" class="dropdown-item">Setting</a>
				<div class="dropdown-divider"></div>
				<a href="/logout" class="dropdown-item">Log Out</a>
			</div>
		</li>
		@if($sidebarTwo)
		<li class="divider d-none d-md-block"></li>
		<li class="d-none d-md-block">
			<a href="javascript:;" data-click="right-sidebar-toggled" class="f-s-14">
				<i class="fa fa-th"></i>
			</a>
		</li>
		@endif
	</ul>
	<!-- end header navigation right -->
</div>
<!-- end #header -->