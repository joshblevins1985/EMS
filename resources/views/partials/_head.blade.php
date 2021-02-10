<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')  | EMSComplete</title>
<!-- plugins:css -->
<link rel="stylesheet" href="/assets/corona/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="/assets/corona/vendors/css/vendor.bundle.base.css">
<!-- endinject -->
<!-- Plugin css for this page -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
<link rel="stylesheet" href="/assets/corona/vendors/select2/select2.min.css">
<link rel="stylesheet" href="/assets/corona/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
<link rel="stylesheet" href="/assets/corona/vendors/select2/select2-adminlte.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<!-- End plugin css for this page -->
@stack('css')
<!-- inject:css -->
<!-- endinject -->
<!-- Layout styles -->
<link rel="stylesheet" href="/assets/corona/css/modern-vertical/style.css">
<!-- End layout styles -->
<link rel="shortcut icon" href="/assets/corona/images/favicon-16x16.png" />
<link rel="apple-touch-icon" sizes="180x180" href="/assets/corona/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/assets/corona/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/assets/corona/images/favicon-16x16.png">

<!-- Script Files For Head -->
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/22694c7a2d.js" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>

    <script>
    toastr.options.closeButton =  {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "3000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
</script>
    <!-- End Scripts -->