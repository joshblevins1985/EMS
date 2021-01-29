<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="d76634f5560ee5c81740c501447b270dc9c56d91" content="14c1f0e069b871aa20866ca6f289ac17c7a4eab8" />
    <meta name="google-site-verification" content="d969_DJjwLZbDQAl_rV6KSfP-ZUpIjv9VK-c6hevBGI" />
    
     <link media="all" type="text/css" rel="stylesheet" href="{{ url('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css') }}">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"></script>
    <title>@yield('page-title') - {{ settings('app_name') }}</title>

    {!! HTML::style('public/assets/css/app.css') !!}
    {!! HTML::style('public/assets/css/fontawesome-all.min.css') !!}
    
    {!! HTML::style('public/assets/css/jquery.numpad.css') !!}
    
    {!! HTML::style('public/assets/css/mdb.min.css') !!}
    

    

    @yield('header-scripts')
</head>
<body class="auth">

    <div class="container">
        @yield('content')
    </div>
    {!! HTML::script('public/assets/js/jquery-3.3.1.min.js') !!}
    {!! HTML::script('public/assets/js/bootstrap.min.js') !!}
    {!! HTML::script('public/assets/js/vendor.js') !!}
    {!! HTML::script('public/assets/js/as/app.js') !!}
    {!! HTML::script('public/assets/js/as/btn.js') !!}
    {!! HTML::script('public/assets/js/mdb.min.js') !!}
    {!! HTML::script('public/assets/js/popper.min.js') !!}
    
     
     {!! HTML::script('public/assets/js/jquery.numpad.js') !!}
    <script>

            // Material Select Initialization
            $(document).ready(function () {
                $('.mdb-select').material_select().css('color: white;');
            });
        </script>
    @yield('scripts')
</body>
</html>
