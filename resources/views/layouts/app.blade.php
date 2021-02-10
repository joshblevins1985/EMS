<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page-title') - {{ settings('app_name') }}</title>
    <!-- Font Awesome -->

    <link rel="stylesheet" type="text/css"
          href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ url('assets/img/icons/apple-touch-icon-144x144.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
          href="{{ url('assets/img/icons/apple-touch-icon-152x152.png') }}"/>
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ url('assets/img/icons/favicon-16x16.png') }}" sizes="16x16"/>
    <meta name="application-name" content="{{ settings('app_name') }}"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="{{ url('assets/img/icons/mstile-144x144.png') }}"/>

    <link media="all" type="text/css" rel="stylesheet" href="{{ url('assets/css/vendor.css') }}">

    <link media="all" type="text/css" rel="stylesheet" href="{{ url('assets/css/app.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('assets/css/mdb.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('assets/css/style.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('assets/css/mobiscroll.jquery.min.css') }}">
    <link type="text/css" href="{{ url('assets/css/addons-pro/stepper.css') }}" rel="stylesheet">
    <!--
    Stepper CSS - minified-->
    <link type="text/css" href="{{ url('assets/css/addons-pro/stepper.min.css') }}" rel="stylesheet">

    <link media="all" type="text/css" rel="stylesheet"
          href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


    <script type="text/javascript"
            src="{{ url('https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/jquery-3.3.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/delete.handler.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/js/modules/toastr.js') }}"></script>


    <script type="text/javascript" src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script type="text/javascript"
            src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xtyhuf4jcvx14hba5xdmoird6al6xaza7rz13b4c0ic8po15"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>tinymce.init({
            selector: "textarea",  // change this value according to your HTML
            plugins: "lists",
            toolbar: "numlist bullist"
        });</script>
    <script type="text/javascript" src="{{ url('assets/js/popper.min.js') }}"></script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script type="text/javascript" src="{{ url('assets/js/addons-pro/stepper.js') }}"></script>
    <!-- Stepper JavaScript - minified -->
    <script type="text/javascript" src="{{ url('assets/js/addons-pro/stepper.min.js') }}"></script>

    <script type="text/javascript" src="https://kit.fontawesome.com/6c1803817f.js"></script>

    <style>
        @media print {
            .no-print, .no-print * {
                display: none !important;
            }
        }
    </style>
    <style>
        .chat {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .chat li {
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 1px dotted #B3A9A9;
        }

        .chat li .chat-body p {
            margin: 0;
            color: #777777;
        }

        .panel-body {
            overflow-y: scroll;
            height: 350px;
        }

        ::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar {
            width: 12px;
            background-color: #F5F5F5;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
            background-color: #555;
        }
    </style>
    @yield('styles')
</head>

<body class="grey lighten-3 fixed-sn">

<!--Main Navigation-->
<header>

    <!-- Navbar -->
@include('partials.navbar')
<!-- Navbar -->

    <!-- Sidebar -->
@include('partials.sidebar')
<!-- Sidebar -->

</header>
<!--Main Navigation-->

<!--Main layout-->
<main class="pt-5 mx-lg-5">
    <div class="container-fluid mt-5">

        @yield('content')

    </div>
    <div>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
        <p>&nbsp</p>
    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small elegant-color darken-2 mt-4 wow fadeIn"
        style="position: fixed; bottom: 0; width: 100%; margin-top: 5px;">


    <!-- Social icons -->
    <div class="pb-4">
        <a href="https://www.facebook.com/mdbootstrap" target="_blank">
            © 2020 Copyright Medidex Soulutions
        </a>


    </div>


</footer>
<!--/.Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->

<script type="text/javascript" src="{{ url('resourcesassets/js/app.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/as/app.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('assets/js/mdb.min.js') }}"></script>

<script type="text/javascript" src="{{ url('assets/js/mobiscroll.jquery.min.js') }}"></script>

<script type="text/javascript" src="{{ url('assets/js/addons/datatables.min.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>

<script>
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 2000,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
<script>

    // Material Select Initialization
    $(document).ready(function () {
        $('.mdb-select').material_select();
    });
</script>
<script>
    // Data Picker Initialization
    $('.datepicker').pickadate({
        // Escape any “rule” characters with an exclamation mark (!).
        format: 'mm/dd/yyyy',
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: 'intime',
    })
</script>


<script>
    // SideNav Button Initialization
    $(".button-collapse").sideNav();
    // SideNav Scrollbar Initialization
    var sideNavScrollbar = document.querySelector('.custom-scrollbar');
    var ps = new PerfectScrollbar(sideNavScrollbar);
</script>


@yield('scripts')

</body>

</html>
