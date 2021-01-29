<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content= "{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('page-title') - {{ settings('app_name') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="apple-touch-icon-precomposed" sizes="144x144"
          href="{{ url('public/assets/img/icons/apple-touch-icon-144x144.png') }}"/>
    <link rel="apple-touch-icon-precomposed" sizes="152x152"
          href="{{ url('public/assets/img/icons/apple-touch-icon-152x152.png') }}"/>
    <link rel="icon" type="image/png" href="{{ url('public/assets/img/icons/favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ url('public/assets/img/icons/favicon-16x16.png') }}" sizes="16x16"/>
    <meta name="application-name" content="{{ settings('app_name') }}"/>
    <meta name="msapplication-TileColor" content="#FFFFFF"/>
    <meta name="msapplication-TileImage" content="{{ url('public/assets/img/icons/mstile-144x144.png') }}"/>

    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/vendor.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/app.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/mdb.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/style.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/mobiscroll.jquery.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
   
    


    <script src="{{ url('public/assets/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('public/assets/js/modules/toastr.js') }}"></script>
  

    <script src="https://f.vimeocdn.com/js/froogaloop2.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=xtyhuf4jcvx14hba5xdmoird6al6xaza7rz13b4c0ic8po15"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
    <script>tinymce.init({
        selector: "textarea",  // change this value according to your HTML
        plugins: "lists",
        toolbar: "numlist bullist"
    });</script>
    <script src="{{ url('public/assets/js/popper.min.js') }}"></script>

<style>
    @media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
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
<footer class="page-footer text-center font-small elegant-color darken-2 mt-4 wow fadeIn" style="position: fixed; bottom: 0; width: 100%; margin-top: 5px;">



    <!-- Social icons -->
    <div class="pb-4">
        <a href="https://www.facebook.com/mdbootstrap" target="_blank">
          © 2018 Copyright Medidex Soulutions
        </a>

        
    </div>
    

    

</footer>
<!--/.Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script src="{{ url('resources/assets/js/app.js') }}"></script>
<script src="{{ url('public/assets/js/as/app.js') }}"></script>
<script src="{{ url('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('public/assets/js/mdb.min.js') }}"></script>

<script src="{{ url('public/assets/js/mobiscroll.jquery.min.js') }}"></script>

<script src="{{ url('public/assets/js/addons/datatables.min.js') }}"></script>
<script src="{{ url('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

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
Ps.initialize(sideNavScrollbar);
</script>
@yield('scripts')

</body>

</html>