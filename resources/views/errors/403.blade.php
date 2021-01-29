@extends('layouts.empty', ['paceTop' => true])

@section('title', '403 Error Page')

@section('content')
	<!-- begin error -->
	<div class="error">
		<div class="error-code">404</div>
		<div class="error-content">
			<div class="error-message">Forbidden!</div>
			<div class="error-desc mb-3 mb-sm-4 mb-md-5">
				You don't have permission to access this page. <br />
				Perhaps, there has been a mistake please go back and try again.
			</div>
			<div>
				<a href="/" class="btn btn-success p-l-20 p-r-20">Go Home</a>
			</div>
		</div>
	</div>
	<!-- end error -->
@endsection
        
