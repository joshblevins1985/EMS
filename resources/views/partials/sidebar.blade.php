

    <!-- SideNav slide-out button -->
    <a href="#" data-activates="slide-out" class="btn btn-primary p-3 button-collapse"><i class="fa fa-bars"></i></a>

    <!-- Sidebar navigation -->
    <div id="slide-out" class="side-nav fixed no-print">
        <ul class="elegant-color custom-scrollbar">
            <!-- Logo -->
            <li>
                <div class="logo-wrapper waves-light">
                    <a href="#"><img src="{{ url('public/assets/img/peasi.png') }}" class="img-fluid flex-center"></a>
                </div>
            </li>
            <!--/. Logo -->
            <!--Social-->
            <div class="user-box text-center pt-5 pb-3">
                <div class="user-img">
                    <img src="{{ auth()->user()->present()->avatar }}"
                         width="90"
                         height="90"
                         alt="user-img"
                         class="rounded-circle img-thumbnail img-responsive">
                </div>
                <li>
                    <ul class="social">
                        <li><a href="{{ route('profile') }}" class="icons-sm gplus-ic" title="@lang('app.my_profile')">
                            <i class="fas fa-cog"></i>
                        </a></li>
                        <li><a href="{{ route('auth.logout') }}" class="icons-sm gplus-ic" title="@lang('app.logout')">
                            <i class="fas fa-sign-out-alt"></i>
                        </a></li>
                    </ul>
                </li>
            </div>

            <!--/Social-->
            <!--Search Form-->
            <li>
                <form class="search-form" role="search">
                    <div class="form-group md-form mt-0 pt-1 waves-light">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                </form>
            </li>
            <!--/.Search Form-->
            <!-- Side navigation links -->
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li><a class="nav-link {{ Request::is('/') ? 'active' : ''  }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-home"></i>
                        <span>@lang('app.dashboard')</span>
                    </a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="#" class="waves-effect">Submit listing</a>
                                </li>
                                <li><a href="#" class="waves-effect">Registration form</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @permission('admin.menu')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-unlock-alt"></i>
                        Administration<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('administration.index') }}" class="waves-effect">Daily Statistics</a>
                                </li>
                            </ul>
                            
                            <ul>
                                <li><a href="{{ route('unitreview.index') }}" class="waves-effect">Camera Review</a>
                                </li>
                            </ul>
                            <ul>
                            @permission('view.eduadmin')
                                <li><a href="/scholarship" class="waves-effect">Scholarships</a>
                                </li>
                                @endpermission
                            </ul>
                                
                            
                        </div>
                    </li>
                    @endpermission
                    @permission('view.employees')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-user"></i>
                        Employees<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('employees.index') }}" class="waves-effect">Active Employees</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endpermission

                    @permission('view.badrunsheets')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-bullseye"></i>
                        Billing<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('badrunsheets.index') }}" class="waves-effect">View List</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endpermission

                    @permission('menu.compliance')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-times"></i>
                        Compliance<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('compliance.index') }}" class="waves-effect">Dashboard</a>
                                </li>
                                @permission('view.attend')
                                <li><a href="{{ route('attend.list') }}" class="waves-effect">Attendance</a>
                                </li>
                                @endpermission
                                @permission('view.attend')
                                <li><a href="{{ route('attend.report') }}" class="waves-effect">Attendance Report</a>
                                </li>
                                @endpermission
                                @permission('add.policy')
                                <li><a href="{{ route('policies.create') }}" class="waves-effect">Add New Policy</a>
                                </li>
                                @endpermission
                                @permission('menu.compliance')
                                <li><a href="{{ route('unitreview.index') }}" class="waves-effect">Camera Review</a>
                                </li>
                                @endpermission
                                @permission('view.policies')
                                <li><a href="{{ route('policies.index') }}" class="waves-effect">Policy List</a>
                                </li>
                                @endpermission
                            </ul>
                        </div>
                    </li>
                    @endpermission

                    @permission('admin.menu')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fas fa-headset"></i>
                        Dispatch<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('dispatch.view1') }}" class="waves-effect">Dispatch Screen</a>
                                </li>
                            </ul>
                            <ul>
                                <li><a href="{{ route('dispatch.units') }}" class="waves-effect">Unit Screen</a>
                                </li>
                            </ul>
                            <ul>
                                <li><a href="{{ route('dispatch.active') }}" class="waves-effect">Active Screen</a>
                                </li>
                            </ul>
                            <ul>
                                <li><a href="{{ route('dispatch.pending') }}" class="waves-effect">Pending Screen</a>
                                </li>
                            </ul>
                            @permission('patient.show')
                            <ul>
                                <li><a href="{{ route('patients.index') }}" class="waves-effect">Patients</a>
                                </li>
                            </ul>    
                            @endpermission
                        </div>
                    </li>
                    @endpermission

                    @permission('education')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-book"></i>
                        Education<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                               
                                @permission('view.cpr')
                                <li><a href="{{ route('cprclasses.index') }}" class="waves-effect">CPR Classes</a>
                                </li>
                                @endpermission
                                
                                @permission('view.eduadmin')
                                <li><a href="{{ route('unitreview.index') }}" class="waves-effect">Camera Review</a>
                                </li>
                                @endpermission
                                
                                @permission('view.eduadmin')
                                <li><a href="{{ route('competency.index') }}" class="waves-effect">Competencies</a>
                                </li>
                                @endpermission

                                @permission('view.courses')
                                <li><a href="{{ route('courses.index') }}" class="waves-effect">Courses</a>
                                </li>
                                @endpermission

                                @permission('view.eduadmin')
                                <li><a href="{{ route('education.index') }}" class="waves-effect">Dashboard</a>
                                </li>
                                @endpermission
                                
                                @permission('view.eduadmin')
                                <li><a href="{{ route('driveassessment.index') }}" class="waves-effect">Driver Assessments</a>
                                </li>
                                @endpermission
                                
                                 @permission('view.classes')
                                <li><a href="{{ route('classes.index') }}" class="waves-effect">Insturcted Classes</a>
                                </li>
                                @endpermission

                                @permission('view.qa')
                                <li><a href="{{ route('qaqi.index') }}" class="waves-effect">PCR Quality Assurance</a>
                                </li>
                                @endpermission

                                @permission('view.observer')
                                <li><a href="{{ route('observer.index') }}" class="waves-effect">Observer Schedule</a>
                                </li>
                                @endpermission
                                @permission('view.eduadmin')
                                <li><a href="/scholarship" class="waves-effect">Scholarships</a>
                                </li>
                                @endpermission
                                 @permission('unitreview')
                                <li><a href="{{ route('unitreview.index') }}" class="waves-effect">Unit Camera Review</a>
                                </li>
                                @endpermission


                            </ul>
                        </div>
                    </li>
                    @endpermission
                    
                    @permission('education')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-building-o"></i>
                        Facilities<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                               
                                @permission('view.facilities')
                                <li><a href="{{ route('facilities.index') }}" class="waves-effect">Facility List</a>
                                </li>
                                @endpermission
                                @permission('add.facilities')
                                <li><a href="{{ route('facilities.create') }}" class="waves-effect">Add New Facility</a>
                                </li>
                                @endpermission

                                


                            </ul>
                        </div>
                    </li>
                    @endpermission
                    
                    
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-paperclip" aria-hidden="true"></i>

                        Company Forms<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('mvc.create') }}" class="waves-effect">Crash Report</a>
                                </li>
                                <li><a href="{{ route('incidentreport') }}" class="waves-effect">Incident Report</a>
                                </li>
                                <li><a href="#" class="waves-effect">Improper Transport</a>
                                </li>
                                <li><a href="{{ route('maintanance.create') }}" class="waves-effect">Unit Malfunction</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    
                    
                    @permission('hr.view.menu')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-users-o"></i>
                        Human Resources<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                               
                                @permission('view.hr.dashboard')
                                <li><a href="{{ route('hr.index') }}" class="waves-effect">Dashboard</a>
                                </li>
                                @endpermission
                                

                                


                            </ul>
                        </div>
                    </li>
                    @endpermission
                    
                    @permission('manager')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-building-o"></i>
                        Manager<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                               
                                @permission('manager')
                                <li><a href="{{ route('manager.index') }}" class="waves-effect">Manager Dashboard</a>
                                </li>
                                @endpermission

                            </ul>
                        </div>
                    </li>
                    @endpermission
                    
                     @permission('mechanic')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-wrench"></i>
                        Mechanic<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                               
                                @permission('mechanic')
                                <li><a href="{{ route('mechanic.index') }}" class="waves-effect">Mechanic Dashboard</a>
                                </li>
                                @endpermission

                            </ul>
                        </div>
                    </li>
                    @endpermission

                    @permission('logistics')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-ambulance"></i>
                        Logistics<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ route('logistics.index') }}" class="waves-effect">Dashboard</a>
                                </li>

                                <li><a href="{{ route('logistic.overview') }}" class="waves-effect">Overview</a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @endpermission

                    @permission('menu.accounting')
                    <li><a class="collapsible-header waves-effect arrow-r"><i class="fa fa-usd"></i>
                        Accounting<i class="fa fa-angle-down rotate-icon"></i></a>
                        <div class="collapsible-body">
                            <ul>
                                @permission('accounting')
                                <li><a href="{{ route('accounting.index') }}" class="waves-effect">Dashboard</a>
                                </li>
                                @endpermission

                                @permission('payperiods')
                                <li><a href="{{ route('payperiod.index') }}" class="waves-effect">Pay Periods</a>
                                </li>
                                @endpermission

                                @permission('list.timepunch')
                                <li><a href="{{ route('timeclock.list') }}" class="waves-effect">Time Clock</a>
                                </li>
                                @endpermission

                            </ul>
                        </div>
                    </li>
                    @endpermission

                    @permission('users.manage')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('user*') ? 'active' : ''  }}" href="{{ route('user.list') }}">
                            <i class="fas fa-users"></i>
                            <span>@lang('app.users')</span>
                        </a>
                    </li>
                    @endpermission

                    @permission('users.activity')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('activity*') ? 'active' : ''  }}" href="{{ route('activity.index') }}">
                            <i class="fas fa-server"></i>
                            <span>@lang('app.activity_log')</span>
                        </a>
                    </li>
                    @endpermission

                    @permission(['roles.manage', 'permissions.manage'])
                    <li class="nav-item">
                        <a href="#roles-dropdown"
                           class="nav-link"
                           data-toggle="collapse"
                           aria-expanded="{{ Request::is('role*') || Request::is('permission*') ? 'true' : 'false' }}">
                            <i class="fas fa-users-cog"></i>
                            <span>@lang('app.roles_and_permissions')</span>
                        </a>
                        <ul class="{{ Request::is('role*') || Request::is('permission*') ? '' : 'collapse' }} list-unstyled sub-menu" id="roles-dropdown">
                            @permission('roles.manage')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('role*') ? 'active' : '' }}"
                                   href="{{route('role.index') }}">@lang('app.roles')</a>
                            </li>
                            @endpermission
                            @permission('permissions.manage')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('permission*') ? 'active' : '' }}"
                                   href="{{ route('permission.index') }}">@lang('app.permissions')</a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                    @endpermission

                    @permission(['settings.general', 'settings.auth', 'settings.notifications'], false)
                    <li class="nav-item">
                        <a href="#settings-dropdown"
                           class="nav-link"
                           data-toggle="collapse"
                           aria-expanded="{{ Request::is('settings*') ? 'true' : 'false' }}">
                            <i class="fas fa-cogs"></i>
                            <span>@lang('app.settings')</span>
                        </a>
                        <ul class="{{ Request::is('settings*') ? '' : 'collapse' }} list-unstyled sub-menu"
                            id="settings-dropdown">

                            @permission('settings.general')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('settings') ? 'active' : ''  }}"
                                   href="{{ route('settings.general') }}">
                                    @lang('app.general')
                                </a>
                            </li>
                            @endpermission

                            @permission('settings.auth')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('settings/auth*') ? 'active' : ''  }}"
                                   href="{{ route('settings.auth') }}">@lang('app.auth_and_registration')</a>
                            </li>
                            @endpermission

                            @permission('settings.notifications')
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('settings/notifications*') ? 'active' : ''  }}"
                                   href="{{ route('settings.notifications') }}">@lang('app.notifications')</a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                    @endpermission
                </ul>
            </li>
            <!--/. Side navigation links -->
        </ul>
        <div class="sidenav-bg elegant-color"></div>
    </div>
    <!--/. Sidebar navigation -->

