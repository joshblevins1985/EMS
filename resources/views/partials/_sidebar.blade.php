<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
    <a class="sidebar-brand brand-logo" href="index.html"><img src="{{ url('/assets/img/peasi_lg.png') }}" alt="logo" /></a>
    <a class="sidebar-brand brand-logo-mini" href="index.html"><b class="text-blue">EMS</b></a>
  </div>
  <ul class="nav">
    <li class="nav-item profile">
      <div class="profile-desc">
        <div class="profile-pic">
          <div class="count-indicator">
            <img class="img-xs rounded-circle " src="{{asset('storage/employee_photos/'.Auth::user()->employee->eid.'.png')}}" alt="">
            <span class="count bg-success"></span>
          </div>
          <div class="profile-name">
            <h5 class="mb-0 font-weight-normal">{{Auth::user()->Employee->first_name }} {{Auth::user()->Employee->last_name }}</h5>
            <span>{{Auth::user()->Employee->employeepositions->label }}</span>
          </div>
        </div>
        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i class="mdi mdi-dots-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list" aria-labelledby="profile-dropdown">
          <a href="/profile" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-settings text-primary"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Account settings</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="/profile" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-onepassword  text-info"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">Change Password</p>
            </div>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item preview-item">
            <div class="preview-thumbnail">
              <div class="preview-icon bg-dark rounded-circle">
                <i class="mdi mdi-calendar-today text-success"></i>
              </div>
            </div>
            <div class="preview-item-content">
              <p class="preview-subject ellipsis mb-1 text-small">To-do list</p>
            </div>
          </a>
        </div>
      </div>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Navigation</span>
    </li>
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ route('dashboard') }}">
        <span class="menu-icon">
          <i class="mdi mdi-speedometer"></i>
        </span>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    @permission('admin.menu')
    <li class="nav-item menu-items">
      <a class="nav-link" href="/hrr/admin">
        <span class="menu-icon">
          <i class="mdi mdi-forum"></i>
        </span>
        <span class="menu-title">Admin Dashboard</span>
      </a>
    </li>
    @endpermission
    @permission('admin.menu')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#administration" aria-expanded="false" aria-controls="administration">
        <span class="menu-icon">
          <i class="fad fa-user-unlock"></i>
        </span>
        <span class="menu-title">Administration</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="administration">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('administration.index') }}">Daily Stats</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('unitreview.index') }}">Camera Review</a></li>
          @permission('view.eduadmin')
          <li class="nav-item"> <a class="nav-link" href="/scholarship">Scholarships</a></li>
          @endpermission
        </ul>
      </div>
    </li>
    @endpermission
    @permission('view.employees')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#sidebar-layouts" aria-expanded="false" aria-controls="sidebar-layouts">
        <span class="menu-icon">
          <i class="fa fa-user"></i>
        </span>
        <span class="menu-title">Employees</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="sidebar-layouts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/employees">Active Employees</a></li>
        </ul>
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/employee/fema">Response Team</a></li>
        </ul>
      </div>
    </li>
    @endpermission
    @permission('view.badrunsheets')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <span class="menu-icon">
          <i class="fad fa-file-medical-alt"></i>
        </span>
        <span class="menu-title">Billing</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('badrunsheets.index') }}">Bad Run Sheet File</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('patient.dash') }}">Patient Dashboard</a></li>
          <li class="nav-item"> <a class="nav-link" href="/patients">Patient List</a></li>

        </ul>
      </div>
    </li>
    @endpermission
    @permission('menu.compliance')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false" aria-controls="ui-advanced">
        <span class="menu-icon">
          <i class="fas fa-siren-on"></i>
        </span>
        <span class="menu-title">Compliance</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-advanced">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('attend.list') }}">Attendance</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('attend.report') }}">Attendance Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('unitreview.index') }}">Camera Review</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('compliance.index') }}">Dashboard</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('policies.index') }}">Policy List</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('policies.create') }}">Add New Policy</a></li>
        </ul>
      </div>
    </li>
    @endpermission
    @permission('dispatch.menu')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
        <span class="menu-icon">
          <i class="fas fa-user-headset"></i>
        </span>
        <span class="menu-title">Dispatch</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          @permission('dispatch.active') <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.units') }}">Unit Screen</a></li> @endpermission
          @permission('dispatch.pending') <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.active') }}">Active Incidents</a></li> @endpermission
          @permission('dispatch.active') <li class="nav-item"> <a class="nav-link" href="{{ route('dispatch.pending') }}">Pending Incidents</a></li> @endpermission
          @permission('dispatch.alerts') <li class="nav-item"> <a class="nav-link" href="/dispatch/alertScreen">Alert Search</a></li> @endpermission
          @permission('patient.show')
          <li class="nav-item"> <a class="nav-link" href="{{ route('patients.index') }}">Patient list</a></li>
          @endpermission
          @permission('view.facilities')
          <li class="nav-item"> <a class="nav-link" href="{{ route('facilities.index') }}">Facility list</a></li>
          @endpermission
          @permission('add.facilities')
          <li class="nav-item"> <a class="nav-link" href="{{ route('facilities.create') }}">Add New Facility</a></li>
          @endpermission
        </ul>
      </div>
    </li>
    @endpermission
    @permission('education')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
        <span class="menu-icon">
          <i class="fas fa-graduation-cap"></i>
        </span>
        <span class="menu-title">Education</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('cprclasses.index') }}">CPR Classes</a></li>
          @permission('view.eduadmin')
          <li class="nav-item"> <a class="nav-link" href="{{ route('unitreview.index') }}">Camera Review</a></li>
          @endpermission
          @permission('view.eduadmin')
          <li class="nav-item"> <a class="nav-link" href="{{ route('competency.index') }}">Competencies</a></li>
          @endpermission
          @permission('view.courses')
          <li class="nav-item"> <a class="nav-link" href="{{ route('courses.index') }}">Courses</a></li>
          @endpermission
          @permission('view.eduadmin')
          <li class="nav-item"> <a class="nav-link" href="{{ route('education.index') }}">Dashboard</a></li>
          @endpermission
          @permission('view.eduadmin')
          <li class="nav-item"> <a class="nav-link" href="{{ route('driveassessment.index') }}">Driver Assessment</a></li>
          @endpermission
          @permission('view.classes')
          <li class="nav-item"> <a class="nav-link" href="{{ route('classes.index') }}">Instructed Classes</a></li>
          @endpermission
          @permission('view.classes')
          <li class="nav-item"> <a class="nav-link" href="/classroom">New Classroom Courses</a></li>
          @endpermission
          @permission('view.qa')
          <li class="nav-item"> <a class="nav-link" href="{{ route('observer.index') }}">Observer Schedule</a></li>
          @endpermission
          @permission('view.qa')
          <li class="nav-item"> <a class="nav-link" href="/qaqi">PCR Quality Assurance</a></li>
          @endpermission
          @permission('view.eduadmin')
          <li class="nav-item"> <a class="nav-link" href="/scholarship">Scholarships</a></li>
          @endpermission
          @permission('unitreview')
          <li class="nav-item"> <a class="nav-link" href="{{ route('unitreview.index') }}">Camera Review</a></li>
          @endpermission
        </ul>
      </div>
    </li>
    @endpermission

    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#editors" aria-expanded="false" aria-controls="editors">
        <span class="menu-icon">
          <i class="fa fa-paperclip" ></i>
        </span>
        <span class="menu-title">Company Forms</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="editors">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('mvc.create') }}">MVC Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('incidentreport') }}">Incident Report</a></li>
          <li class="nav-item"> <a class="nav-link" href="#">Improper Transport</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('maintanance.create') }}">Unit Malfunction</a></li>
        </ul>
      </div>
    </li>
    @permission('hr.view.menu')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
        <span class="menu-icon">
          <i class="fas fa-fingerprint"></i>
        </span>
        <span class="menu-title">Human Resources</span>
        <i class="fas fa-fingerprint"></i>
      </a>
      <div class="collapse" id="charts">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('hr.index') }}">HR Dashboard</a></li>
        </ul>
      </div>
    </li>
    @endpermission
    @permission('admin.menu')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#info-tech" aria-expanded="false" aria-controls="form-elements">
        <span class="menu-icon">
          <i class="fas fa-server"></i>
        </span>
        <span class="menu-title">Info Tech</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="info-tech">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="/assetDashboard">Assets</a></li>
          <li class="nav-item"> <a class="nav-link" href="/supportTickets">Support Ticket</a></li>
        </ul>
      </div>
    </li>
    @endpermission
    @permission('manager')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#maps" aria-expanded="false" aria-controls="maps">
        <span class="menu-icon">
          <i class="mdi mdi-map-marker-radius"></i>
        </span>
        <span class="menu-title">Manager</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="maps">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('manager.index') }}">Manager Dashboard</a></li>
        </ul>
      </div>
    </li>
    @endpermission
    @permission('mechanic')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#mechanics" aria-expanded="false" aria-controls="mechanics">
        <span class="menu-icon">
          <i class="fa fa-wrench"></i>
        </span>
        <span class="menu-title">Mechanics</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="mechanics">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('mechanic.index') }}">Task Dashboard</a></li>
          <li class="nav-item"> <a class="nav-link" href="garage/mechanic/dash">Mechanic Dashboard</a></li>
          <li class="nav-item"> <a class="nav-link" href="/available_parts">Available Parts</a></li>
        </ul>
      </div>
    </li>
    @endpermission
    @permission('logistics')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
        <span class="menu-icon">
          <i class="fa fa-ambulance"></i>
        </span>
        <span class="menu-title">Logistics</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="icons">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{ route('logistics.index') }}">Dashboard</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ route('logistic.overview') }}">Overview</a></li>
        </ul>
      </div>
    </li>
    @endpermission
    @permission('menu.compliance')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#risk-management" aria-expanded="false" aria-controls="risk-management">
        <span class="menu-icon">
          <i class="fa fa-ambulance"></i>
        </span>
        <span class="menu-title">Risk Management</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="risk-management">
        <ul class="nav flex-column sub-menu">

          <li class="nav-item"> <a class="nav-link" href="/covid">COVID Exposures</a></li>

        </ul>
      </div>
    </li>
    @endpermission
    @permission('accounting')
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#accounting" aria-expanded="false" aria-controls="accounting">
        <span class="menu-icon">
          <i class="fa fa-ambulance"></i>
        </span>
        <span class="menu-title">Accounting</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="accounting">
        <ul class="nav flex-column sub-menu">
          @permission('accounting')
          <li class="nav-item"> <a class="nav-link" href="{{ route('accounting.index') }}">Dashboard</a></li>
          @endpermission
          @permission('payperiods')
          <li class="nav-item"> <a class="nav-link" href="{{ route('payperiod.index') }}">Pay Periods</a></li>
          @endpermission
          @permission('list.timepunch')
          <li class="nav-item"> <a class="nav-link" href="{{ route('timeclock.list') }}">Time Clock</a></li>
          @endpermission
        </ul>
      </div>
    </li>
    @endpermission
    <li class="nav-item nav-category">
      <span class="nav-link">More</span>
    </li>
    @permission('users.activity')
    <li class="nav-item menu-items">
      <a class="nav-link" href="{{ route('activity.index') }}">
        <span class="menu-icon">
          <i class="mdi mdi-forum"></i>
        </span>
        <span class="menu-title">User Activity</span>
      </a>
    </li>
    @endpermission
    @permission(['roles.manage', 'permissions.manage'])
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <span class="menu-icon">
          <i class="mdi mdi-security"></i>
        </span>
        <span class="menu-title">User Pages</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          @permission('roles.manage')
          <li class="nav-item"> <a class="nav-link" href="{{route('role.index') }}"> Roles </a></li>
          @endpermission
          @permission('permissions.manage')
          <li class="nav-item"> <a class="nav-link" href="{{ route('permission.index') }}"> Permissions </a></li>
          @endpermission

        </ul>
      </div>
    </li>
    @endpermission
    @permission(['settings.general', 'settings.auth', 'settings.notifications'], false)
    <li class="nav-item menu-items">
      <a class="nav-link" data-toggle="collapse" href="#general-pages" aria-expanded="false" aria-controls="general-pages">
        <span class="menu-icon">
          <i class="mdi mdi-earth"></i>
        </span>
        <span class="menu-title">Settings</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="general-pages">
        <ul class="nav flex-column sub-menu">
          @permission('settings.general')
          <li class="nav-item"> <a class="nav-link" href="{{ route('settings.general') }}"> General </a></li>
          @endpermission
          @permission('settings.auth')
          <li class="nav-item"> <a class="nav-link" href="{{ route('settings.auth') }}"> Auth and Registration </a></li>
          @endpermission
          @permission('settings.notifications')
          <li class="nav-item"> <a class="nav-link" href="{{ route('settings.notifications') }}"> Notifications </a></li>
          @endpermission
        </ul>
      </div>
    </li>
    @endpermission
  </ul>
</nav>