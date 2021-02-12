<ul class="main-menu">
    <li class="sub-header">
        <span>My Quick Links</span>
    </li>
    <li class="selected has-sub-menu">
        <a href="/dashboard">
            <div class="icon-w">
                <div class="os-icon os-icon-layout"></div>
            </div>
            <span>Dashboard</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
               Dashboard
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-layout"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="/dashboard">My Dashboard</a>
                    </li>
                    @permission('admin.menu')
                    <li>
                        <a href="/hrr/admin">Administration Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('administration.index') }}">Daily Statatistics</a>
                    </li>
                    <li>
                        <a href="{{ route('unitreview.index') }}">Unit Camera Review</a>
                    </li>
                    @endpermission

                    @permission('view.eduadmin')
                    <li>
                        <a href="/scholarship">Scholarships</a>
                    </li>
                    @endpermission
                </ul>
            </div>
        </div>
    </li>

    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <i class="fa fa-paperclip" ></i>
            </div>
            <span>Company Forms</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Company Forms
            </div>
            <div class="sub-menu-icon">
                <i class="fa fa-paperclip" ></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="#"> MVC Report </a>
                    </li>
                    <li>
                        <a href="#"> Incident Report </a>
                    </li>
                    <li>
                        <a href="#"> Improper Transport </a>
                    </li>
                    <li>
                        <a href="#"> Unit Repair Request </a>
                    </li>

                </ul>
            </div>
        </div>
    </li>


    <li class="sub-header">
        <span>Departments</span>
    </li>
    @permission('view.badrunsheets')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-package"></div>
            </div>
            <span>Billing</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Billing Menu
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-package"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('badrunsheets.index') }}">Bad Run Sheet File</a>
                    </li>
                    <li>
                        <a href="{{ route('patient.dash') }}">Patient Dashboard</a>
                    </li>
                    <li>
                        <a href="/patients">Patient List</a>
                    </li>

                </ul>

            </div>
        </div>
    </li>
    @endpermission
    @permission('menu.compliance')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <div class="os-icon os-icon-file-text"></div>
            </div>
            <span>Compliance</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Compliance
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-file-text"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('attend.list') }}">Attendance</a>
                    </li>
                    <li>
                        <a href="{{ route('attend.report') }}">Attendance Report</a>
                    </li>
                    <li>
                        <a href="{{ route('unitreview.index') }}">Camera Review</a>
                    </li>
                    <li>
                        <a href="{{ route('compliance.index') }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('policies.index') }}">Policy List</a>
                    </li>
                </ul><ul class="sub-menu">
                    <li>
                        <a href="{{ route('policies.create') }}">Add New Policy</a>
                    </li>

                </ul>
            </div>
        </div>
    </li>
    @endpermission
    @permission('dispatch.menu')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <i class="fas fa-user-headset"></i>
            </div>
            <span>Dispatch</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Dispatch
            </div>
            <div class="sub-menu-icon">
                <i class="fas fa-user-headset"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('dispatch.units') }}">Unit Screen </a>
                    </li>
                    <li>
                        <a href="{{ route('dispatch.active') }}">Active Incidents</a>
                    </li>
                    <li>
                        <a href="{{ route('dispatch.pending') }}">Pending Incidents</a>
                    </li>
                    <li>
                        <a href="/dispatch/alertScreen">Alert Search</a>
                    </li>

                </ul><ul class="sub-menu">
                    <li>
                        <a href="{{ route('patients.index') }}">Patient List</a>
                    </li>
                    <li>
                        <a href="{{ route('facilities.index') }}">Facility List</a>
                    </li>
                    <li>
                        <a href="{{ route('facilities.create') }}">Add New Facility</a>
                    </li>

                </ul>
            </div>
        </div>
    </li>
    @endpermission
    @permission('view.employees')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <i class="fa fa-users"></i>
            </div>
            <span>Employees</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Employee Menu
            </div>
            <div class="sub-menu-icon">
                <i class="fa fa-user"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="/employees">Active Employees </a>
                    </li>
                    <li>
                        <a href="/employee/fema">Response Team</a>
                    </li>
                </ul>

            </div>
        </div>
    </li>
    @endpermission
    @permission('view.employees')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <span>Education</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Education Menu
            </div>
            <div class="sub-menu-icon">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('cprclasses.index') }}">CPR Classes </a>
                    </li>
                    <li>
                        <a href="{{ route('competency.index') }}">Competencies </a>
                    </li>
                    <li>
                        <a href="{{ route('courses.index') }}"> Courses </a>
                    </li>
                    <li>
                        <a href="{{ route('education.index') }}">Dashboard </a>
                    </li>
                    <li>
                        <a href="{{ route('driveassessment.index') }}"> Driver Assessment </a>
                    </li>
                    <li>
                        <a href="{{ route('classes.index') }}"> Instructed Classes </a>
                    </li>
                </ul>
                <ul class="sub-menu">
                    <li>
                        <a href="/classroom">New Classroom Courses </a>
                    </li>
                    <li>
                        <a href="{{ route('observer.index') }}">Observer Schedule </a>
                    </li>
                    <li>
                        <a href="/qaqi"> PCR Quality Assurance </a>
                    </li>
                    <li>
                        <a href="/scholarship">Scholarships </a>
                    </li>
                </ul>

            </div>
        </div>
    </li>
    @endpermission
    @permission('hr.view.menu')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <i class="fas fa-fingerprint"></i>
            </div>
            <span>Human Resources</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Human Resources Menu
            </div>
            <div class="sub-menu-icon">
                <i class="fas fa-fingerprint"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('hr.index') }}">HR Dashboard </a>
                    </li>

                </ul>
            </div>
        </div>
    </li>
    @endpermission

    @permission('admin.menu')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <i class="fas fa-laptop-code"></i>
            </div>
            <span>Info Tech</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Info Tech Menu
            </div>
            <div class="sub-menu-icon">
                <i class="fas fa-laptop-code"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="/assetDashboard">Assets</a>
                    </li>

                    <li>
                        <a href="/supportTickets">Support Ticket</a>
                    </li>

                </ul>
            </div>
        </div>
    </li>
    @endpermission

    @permission('manager')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <i class="fas fa-toolbox"></i>
            </div>
            <span>Manager</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Manager Menu
            </div>
            <div class="sub-menu-icon">
                <i class="fas fa-toolbox"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="/assetDashboard">Assets</a>
                    </li>

                    <li>
                        <a href="/supportTickets">Support Ticket</a>
                    </li>

                </ul>
            </div>
        </div>
    </li>
    @endpermission

    @permission('logistics')
    <li class=" has-sub-menu">
        <a href="#">
            <div class="icon-w">
                <i class="fad fa-ambulance"></i>
            </div>
            <span>Logistics</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Logistics Menu
            </div>
            <div class="sub-menu-icon">
                <i class="fad fa-ambulance"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="{{ route('logistics.index') }}">Dashboard</a>
                    </li>

                    <li>
                        <a href="{{ route('logistic.overview') }}">Overview</a>
                    </li>

                </ul>
            </div>
        </div>
    </li>
    @endpermission
    <li class="sub-header">
        <span>Site Setings</span>
    </li>

    <li class=" has-sub-menu">
        <a href="/user">
            <div class="icon-w">
                <div class="os-icon os-icon-users"></div>
            </div>
            <span>Users</span></a>
        <div class="sub-menu-w">
            <div class="sub-menu-header">
                Users Menu
            </div>
            <div class="sub-menu-icon">
                <i class="os-icon os-icon-users"></i>
            </div>
            <div class="sub-menu-i">
                <ul class="sub-menu">
                    <li>
                        <a href="/user">Users</a>
                    </li>

                </ul>
            </div>
        </div>
    </li>

</ul>