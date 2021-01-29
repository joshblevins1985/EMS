<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	@include('includes.head')
</head>

<body>

	
	<div id="page-container" class="container-fluid">

				@yield('content')

	</div>
	
	@include('includes.page-js')
</body>
</html>
