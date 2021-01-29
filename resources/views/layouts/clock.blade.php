<!doctype html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="45;url=/timeclock">


    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page-title') - {{ settings('app_name') }}</title>

     {!! HTML::style('/assets/css/jquery.numpad.css') !!}
    {!! HTML::style('/assets/css/app.css') !!}
    {!! HTML::style('/assets/css/fontawesome-all.min.css') !!}




    @yield('header-scripts')
</head>
<body class="auth">

    <div class="container-fluid">
        @yield('content')
    </div>
    {!! HTML::script('/assets/js/jquery-3.3.1.min.js') !!}
    {!! HTML::script('/assets/js/vendor.js') !!}
    {!! HTML::script('/assets/js/as/app.js') !!}
    {!! HTML::script('/assets/js/as/btn.js') !!}
    {!! HTML::script('/assets/js/mdb.min.js') !!}
    {!! HTML::script('/assets/js/popper.min.js') !!}
    {!! HTML::script('/assets/js/bootstrap.min.js') !!}
     {!! HTML::script('/assets/js/mobiscroll.jquery.min.js') !!}{!! HTML::script('public/assets/js/jquery.numpad.js') !!}




    @yield('scripts')
</body>
</html>
