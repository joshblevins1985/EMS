<!doctype html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('public/assets/img/icons/apple-touch-icon-144x144.png') }}" />
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ url('public/assets/img/icons/apple-touch-icon-152x152.png') }}" />
        <link rel="icon" type="image/png" href="{{ url('public/assets/img/icons/favicon-32x32.png') }}" sizes="32x32" />
        <link rel="icon" type="image/png" href="{{ url('public/assets/img/icons/favicon-16x16.png') }}" sizes="16x16" />
        <meta name="application-name" content="{{ settings('app_name') }}"/>
        <meta name="msapplication-TileColor" content="#FFFFFF" />
        <meta name="msapplication-TileImage" content="{{ url('public/assets/img/icons/mstile-144x144.png') }}" />

        <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/vendor.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/app.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/mdb.min.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/style.min.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/mobiscroll.jquery.min.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/addons/datatables.min.css') }}">
        <link media="all" type="text/css" rel="stylesheet" href="{{ url('https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}">
        <script src="{{ url('public/assets/js/jquery-3.3.1.min.js') }}"></script> 
        <script src="{{ url('public/assets/js/modules/toastr.js') }}"></script>





        @yield('styles')
    </head>
    <body>
        

        <div class="container">
            
                        @yield('content')
            
        </div>

        <script src="{{ url('public/assets/js/vendor.js') }}"></script>
        <script src="{{ url('public/assets/js/as/app.js') }}"></script>
        <script src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('public/assets/js/mdb.min.js') }}"></script>
        <script src="{{ url('public/assets/js/popper.min.js') }}"></script>
        <script src="{{ url('public/assets/js/mobiscroll.jquery.min.js') }}"></script>

        <script src="{{ url('public/assets/js/addons/datatables.min.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone.min.js"></script>
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
        @yield('scripts')
    </body>
</html>
