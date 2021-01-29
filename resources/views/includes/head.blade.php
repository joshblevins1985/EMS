
<title>EMSComplete | @yield('title')</title>
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta content="" name="description" />
<meta content="" name="author" />
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- ================== BEGIN BASE CSS STYLE ================== -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
{!! HTML::style('assets/css/transparent/app.min.css') !!}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" integrity="sha256-xykLhwtLN4WyS7cpam2yiUOwr709tvF3N/r7+gOMxJw=" crossorigin="anonymous" />


<style>

    .datepicker .datepicker-switch {
background-color: #fff ;
color: #333 ;
}
.form-control:focus{
    color: white;
    font-width: bolder;
}

@media print {
    table {
    color: black !important;
  }
}
</style>

<script src="https://cdn.syncfusion.com/js/assets/external/jquery-3.1.1.min.js"></script>
<script src="https://cdn.syncfusion.com/16.1.0.24/js/web/ej.web.all.min.js"></script>
<script src="https://kit.fontawesome.com/22694c7a2d.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>

<script type="text/javascript" language="javascript">
    //  var idleMax = 30; // Logout after 30 minutes of IDLE
    //  var idleTime = 0;

    //  var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval
    //  $( "body" ).mousemove(function( event ) {
    //      idleTime = 0; // reset to zero
    //});

    // count minutes
   // function timerIncrement() {
   //     idleTime = idleTime + 1;
   //     if (idleTime > idleMax) {
   //         window.location="/logout";
   //     }
   // }
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
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
</script>
<!-- ================== END BASE CSS STYLE ================== -->

@stack('css')
