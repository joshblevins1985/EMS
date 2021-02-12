<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>@yield('title')  | MedidexSolutions</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Joshua Blevins" name="author">
    <meta content="EMS Solutions for all." name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="/assets/light/favicon.png" rel="shortcut icon">
    <link href="/assets/light/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet" type="text/css">
    <link href="/assets/light/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/assets/light/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="/assets/light/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="/assets/light/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/assets/light/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/assets/light/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="/assets/light/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="/assets/light/css/main.css?version=4.5.0" rel="stylesheet">
    <script src="https://kit.fontawesome.com/22694c7a2d.js" crossorigin="anonymous"></script>

    @stack('css')
</head>
<body class="menu-position-side menu-side-left full-screen with-content-panel">
<div class="all-wrapper with-side-panel solid-bg-all">

    <div class="search-with-suggestions-w">
        <div class="search-with-suggestions-modal">
            <div class="element-search">
                <input class="search-suggest-input" placeholder="Start typing to search..." type="text">
                <div class="close-search-suggestions">
                    <i class="os-icon os-icon-x"></i>
                </div>
                </input>
            </div>
            <div class="search-suggestions-group">
                <div class="ssg-header">
                    <div class="ssg-icon">
                        <div class="os-icon os-icon-box"></div>
                    </div>
                    <div class="ssg-name">
                        Projects
                    </div>
                    <div class="ssg-info">
                        24 Total
                    </div>
                </div>
                <div class="ssg-content">
                    <div class="ssg-items ssg-items-boxed">
                        <a class="ssg-item" href="users_profile_big.html">
                            <div class="item-media" style="background-image: url(img/company6.png)"></div>
                            <div class="item-name">
                                Integ<span>ration</span> with API
                            </div>
                        </a><a class="ssg-item" href="users_profile_big.html">
                            <div class="item-media" style="background-image: url(img/company7.png)"></div>
                            <div class="item-name">
                                Deve<span>lopm</span>ent Project
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="search-suggestions-group">
                <div class="ssg-header">
                    <div class="ssg-icon">
                        <div class="os-icon os-icon-users"></div>
                    </div>
                    <div class="ssg-name">
                        Customers
                    </div>
                    <div class="ssg-info">
                        12 Total
                    </div>
                </div>
                <div class="ssg-content">
                    <div class="ssg-items ssg-items-list">
                        <a class="ssg-item" href="users_profile_big.html">
                            <div class="item-media" style="background-image: url(img/avatar1.jpg)"></div>
                            <div class="item-name">
                                John Ma<span>yer</span>s
                            </div>
                        </a><a class="ssg-item" href="users_profile_big.html">
                            <div class="item-media" style="background-image: url(img/avatar2.jpg)"></div>
                            <div class="item-name">
                                Th<span>omas</span> Mullier
                            </div>
                        </a><a class="ssg-item" href="users_profile_big.html">
                            <div class="item-media" style="background-image: url(img/avatar3.jpg)"></div>
                            <div class="item-name">
                                Kim C<span>olli</span>ns
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="search-suggestions-group">
                <div class="ssg-header">
                    <div class="ssg-icon">
                        <div class="os-icon os-icon-folder"></div>
                    </div>
                    <div class="ssg-name">
                        Files
                    </div>
                    <div class="ssg-info">
                        17 Total
                    </div>
                </div>
                <div class="ssg-content">
                    <div class="ssg-items ssg-items-blocks">
                        <a class="ssg-item" href="#">
                            <div class="item-icon">
                                <i class="os-icon os-icon-file-text"></i>
                            </div>
                            <div class="item-name">
                                Work<span>Not</span>e.txt
                            </div>
                        </a><a class="ssg-item" href="#">
                            <div class="item-icon">
                                <i class="os-icon os-icon-film"></i>
                            </div>
                            <div class="item-name">
                                V<span>ideo</span>.avi
                            </div>
                        </a><a class="ssg-item" href="#">
                            <div class="item-icon">
                                <i class="os-icon os-icon-database"></i>
                            </div>
                            <div class="item-name">
                                User<span>Tabl</span>e.sql
                            </div>
                        </a><a class="ssg-item" href="#">
                            <div class="item-icon">
                                <i class="os-icon os-icon-image"></i>
                            </div>
                            <div class="item-name">
                                wed<span>din</span>g.jpg
                            </div>
                        </a>
                    </div>
                    <div class="ssg-nothing-found">
                        <div class="icon-w">
                            <i class="os-icon os-icon-eye-off"></i>
                        </div>
                        <span>No files were found. Try changing your query...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
            <div class="mm-logo-buttons-w">
                <a class="mm-logo" href="index.html"><img src="/assets/light/img/logo.png"><span>PEASI</span></a>
                <div class="mm-buttons">
                    <div class="content-panel-open">
                        <div class="os-icon os-icon-grid-circles"></div>
                    </div>
                    <div class="mobile-menu-trigger">
                        <div class="os-icon os-icon-hamburger-menu-1"></div>
                    </div>
                </div>
            </div>
            <div class="menu-and-user">
                <div class="logged-user-w">
                    <div class="avatar-w">
                        <img alt="" src="{{asset('storage/employee_photos/'.Auth::user()->employee->eid.'.png')}}">
                    </div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">
                            {{Auth::user()->Employee->first_name }} {{Auth::user()->Employee->last_name }}
                        </div>
                        <div class="logged-user-role">
                            {{Auth::user()->Employee->employeepositions->label }}
                        </div>
                    </div>
                </div>
                <!--------------------
                START - Mobile Menu List
                -------------------->
                <ul class="main-menu">
                @include('partials.clean.mobile-left-side-bar')
                <!--------------------
                END - Mobile Menu List
                -------------------->
                    <div class="mobile-menu-magic">
                        <h4>
                            Light Admin
                        </h4>
                        <p>
                            Clean Bootstrap 4 Template
                        </p>
                        <div class="btn-w">
                            <a class="btn btn-white btn-rounded" href="https://themeforest.net/item/light-admin-clean-bootstrap-dashboard-html-template/19760124?ref=Osetin" target="_blank">Purchase Now</a>
                        </div>
                    </div>
            </div>
        </div>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------
        START - Main Menu
        -------------------->
        <div class="menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
            <div class="logo-w">
                <a class="logo" href="/dashboard">
                    <div class="logo-element"></div>
                    <div class="logo-label">
                        PEASI
                    </div>
                </a>
            </div>
            <div class="logged-user-w avatar-inline">
                <div class="logged-user-i">
                    <div class="avatar-w">
                        <img alt="" src="{{asset('storage/employee_photos/'.Auth::user()->employee->eid.'.png')}}">
                    </div>
                    <div class="logged-user-info-w">
                        <div class="logged-user-name">
                            {{Auth::user()->Employee->first_name }} {{Auth::user()->Employee->last_name }}
                        </div>
                        <div class="logged-user-role">
                            {{Auth::user()->Employee->employeepositions->label }}
                        </div>
                    </div>
                    <div class="logged-user-toggler-arrow">
                        <div class="os-icon os-icon-chevron-down"></div>
                    </div>
                    <div class="logged-user-menu color-style-bright">
                        <div class="logged-user-avatar-info">
                            <div class="avatar-w">
                                <img alt="" src="img/avatar1.jpg">
                            </div>
                            <div class="logged-user-info-w">
                                <div class="logged-user-name">
                                    {{Auth::user()->Employee->first_name }} {{Auth::user()->Employee->last_name }}
                                </div>
                                <div class="logged-user-role">
                                    {{Auth::user()->Employee->employeepositions->label }}
                                </div>
                            </div>
                        </div>
                        <div class="bg-icon">
                            <i class="os-icon os-icon-wallet-loaded"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a>
                            </li>
                            <li>
                                <a href="/profile"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                            </li>
                            <li>
                                <a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a>
                            </li>
                            <li>
                                <a href="/logout"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="menu-actions">
                <!--------------------
                START - Messages Link in secondary top menu
                -------------------->
                <div class="messages-notifications os-dropdown-trigger os-dropdown-position-right">
                    <i class="os-icon os-icon-mail-14"></i>

                    <div class="os-dropdown light message-list">
                        <ul>
                            <li>
                                <a href="#">
                                    <div class="user-avatar-w">
                                        <img alt="" src="img/avatar1.jpg">
                                    </div>
                                    <div class="message-content">
                                        <h6 class="message-from">
                                            Messaging Application Coming Soon.
                                        </h6>
                                        <h6 class="message-title">

                                        </h6>
                                    </div>
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
                <!--------------------
                END - Messages Link in secondary top menu
                --------------------><!--------------------
            START - Settings Link in secondary top menu
            -------------------->
                <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-right">
                    <i class="os-icon os-icon-ui-46"></i>
                    <div class="os-dropdown">
                        <div class="icon-w">
                            <i class="os-icon os-icon-ui-46"></i>
                        </div>
                        <ul>
                            <li>
                                <a href="/profile"><i class="os-icon os-icon-ui-49"></i><span>Profile Settings</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--------------------
                END - Settings Link in secondary top menu
                --------------------><!--------------------
            START - Messages Link in secondary top menu
            -------------------->
                <div class="messages-notifications os-dropdown-trigger os-dropdown-position-right">
                    @include('partials.clean.notifications')
                </div>
                <!--------------------
                END - Messages Link in secondary top menu
                -------------------->
            </div>
            <div class="element-search autosuggest-search-activator">
                <input placeholder="Start typing to search..." type="text">
            </div>
            <h1 class="menu-page-header">
                Page Header
            </h1>

            @include('partials.clean.left-side-bar')

        </div>
        <!--------------------
        END - Main Menu
        -------------------->
        <div class="content-w">
            <!--------------------
            START - Top Bar
            -------------------->
            <div class="top-bar color-scheme-transparent">
                <!--------------------
                START - Top Menu Controls
                -------------------->
                <div class="top-menu-controls">

                    <!--------------------
                    START - Messages Link in secondary top menu
                    -------------------->
                    <div class="messages-notifications os-dropdown-trigger os-dropdown-position-left">
                        @include('partials.clean.notifications')
                    </div>
                    <!--------------------
                    END - Messages Link in secondary top menu
                    --------------------><!--------------------
              START - Settings Link in secondary top menu
              -------------------->
                    <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                        @include('partials.clean.settings-right')
                    </div>
                    <!--------------------
                    END - Settings Link in secondary top menu
                    --------------------><!--------------------
              START - User avatar and menu in secondary top menu
              -------------------->
                    <div class="logged-user-w">
                        <div class="logged-user-i">
                            <div class="avatar-w">
                                <img alt="" src="img/avatar1.jpg">
                            </div>
                            <div class="logged-user-menu color-style-bright">
                                <div class="logged-user-avatar-info">
                                    <div class="avatar-w">
                                        <img alt="" src="{{asset('storage/employee_photos/'.Auth::user()->employee->eid.'.png')}}">
                                    </div>
                                    <div class="logged-user-info-w">
                                        <div class="logged-user-name">
                                            {{Auth::user()->Employee->first_name }} {{Auth::user()->Employee->last_name }}
                                        </div>
                                        <div class="logged-user-role">
                                            {{Auth::user()->Employee->employeepositions->label }}
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-icon">
                                    <i class="os-icon os-icon-wallet-loaded"></i>
                                </div>
                                <ul>
                                    <li>
                                        <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--------------------
                    END - User avatar and menu in secondary top menu
                    -------------------->
                </div>
                <!--------------------
                END - Top Menu Controls
                -------------------->
            </div>
            <!--------------------
            END - Top Bar
            --------------------><!--------------------
          START - Breadcrumbs
          -------------------->
            <ul class="breadcrumb">

            </ul>
            <!--------------------
            END - Breadcrumbs
            -------------------->
            <div class="content-panel-toggler">
                <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
            </div>
            <div class="content-i">
                <div class="content-box">
                @yield('content')

                <!--------------------
              START - Color Scheme Toggler
              -------------------->
                    <div class="floated-colors-btn second-floated-btn">
                        <div class="os-toggler-w">
                            <div class="os-toggler-i">
                                <div class="os-toggler-pill"></div>
                            </div>
                        </div>
                        <span>Dark </span><span>Colors</span>
                    </div>
                    <!--------------------
                    END - Color Scheme Toggler
                    --------------------><!--------------------

                    --------------------><!--------------------
              START - Chat Popup Box
              -------------------->

                    <!--------------------
                    END - Chat Popup Box
                    -------------------->
                </div>
                <!--------------------
                START - Sidebar
                -------------------->
            @include('partials.clean.right-side-bar')
                <!--------------------
                END - Sidebar
                -------------------->
            </div>
        </div>
    </div>
    <div class="display-type"></div>
</div>
<script src="/assets/light/bower_components/jquery/dist/jquery.min.js"></script>
<script src="/assets/light/bower_components/popper.js/dist/umd/popper.min.js"></script>
<script src="/assets/light/bower_components/moment/moment.js"></script>
<script src="/assets/light/bower_components/chart.js/dist/Chart.min.js"></script>
<script src="/assets/light/bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="/assets/light/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
<script src="/assets/light/bower_components/ckeditor/ckeditor.js"></script>
<script src="/assets/light/bower_components/bootstrap-validator/dist/validator.min.js"></script>
<script src="/assets/light/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/light/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
<script src="/assets/light/bower_components/dropzone/dist/dropzone.js"></script>
<script src="/assets/light/bower_components/editable-table/mindmup-editabletable.js"></script>
<script src="/assets/light/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/light/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="/assets/light/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="/assets/light/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
<script src="/assets/light/bower_components/tether/dist/js/tether.min.js"></script>
<script src="/assets/light/bower_components/slick-carousel/slick/slick.min.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/util.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/alert.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/button.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/carousel.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/collapse.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/dropdown.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/modal.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/tab.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/tooltip.js"></script>
<script src="/assets/light/bower_components/bootstrap/js/dist/popover.js"></script>
<script src="/assets/light/js/demo_customizer.js"></script>
<script src="/assets/light/js/main.js"></script>
@stack('scripts')
</body>
</html>
