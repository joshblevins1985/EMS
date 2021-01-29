@extends('layouts.empty', ['paceTop' => true])

@section('title', 'Login Page')

@section('content')

	<div class="login-cover">
		<div class="login-cover-image" style="background-image: url(assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
		<div class="login-cover-bg"></div>
	</div>
	<!-- begin login -->
	<div class="login login-v2" data-pageload-addclass="animated fadeIn">
		<!-- begin brand -->
		<div class="login-header">
			<div class="brand text-center">
				<img src="{{ url('assets/img/peasi.png') }}" alt="{{ settings('app_name') }}" height="50">
				<small>Brought to you by:</small>
			</div>

		</div>
		<div class="login-header">
			<div class="brand">
				<span class="fa fa-asterisk text-blue m-3"></span> <b class="text-blue">EMS</b> <span class="text-blue">C</span><span class="text-yellow">omplete</span>
				<small>a portal to make the job simple!</small>
			</div>
			<div class="icon">
				<i class="fa fa-lock"></i>
			</div>
		</div>
		@include('partials.messages')
		<!-- end brand -->
		<!-- begin login-content -->
		<div class="login-content">
			<form role="form" action="<?= url('login') ?>" method="POST" id="login-form" autocomplete="off" class="mt-3">
				<input type="hidden" value="<?= csrf_token() ?>" name="_token">
				@if (Input::has('to'))
					<input type="hidden" value="{{ Input::get('to') }}" name="to">
				@endif
				<div class="form-group m-b-20">
					<input type="text"
						   name="username"
						   id="username"
						   class="form-control"
						   placeholder="@lang('app.email_or_username')">
				</div>
				<div class="form-group m-b-20">
					<input type="password"
						   name="password"
						   id="password"
						   class="form-control"
						   placeholder="@lang('app.password')">
				</div>
				<div class="checkbox checkbox-css m-b-20">
					<input type="checkbox" class="custom-control-input" name="remember" id="remember" value="1"/>
					<label for="remember_checkbox">
						Remember Me
					</label>
				</div>
				<div class="login-buttons">
					<button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
				</div>
				<div class="m-t-20">
					@if (settings('reg_enabled'))
						@lang('app.dont_have_an_account') <a class="font-weight-bold" href="<?= url("register") ?>">Sign Up</a>
					@endif
				</div>
			</form>
			@if (settings('forgot_password'))
				<a href="<?= url('password/remind') ?>" class="forgot">@lang('app.i_forgot_my_password')</a>
			@endif
		</div>
		<!-- end login-content -->
	</div>
	<!-- end login -->

	<ul class="login-bg-list clearfix">
		<li class="active"><a href="javascript:;" data-click="change-bg" data-img="assets/img/login-bg/login-bg-17.jpg" style="background-image: url(assets/img/login-bg/login-bg-17.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="assets/img/login-bg/login-bg-16.jpg" style="background-image: url(assets/img/login-bg/login-bg-16.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="assets/img/login-bg/login-bg-15.jpg" style="background-image: url(assets/img/login-bg/login-bg-15.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="assets/img/login-bg/login-bg-14.jpg" style="background-image: url(assets/img/login-bg/login-bg-14.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="assets/img/login-bg/login-bg-13.jpg" style="background-image: url(assets/img/login-bg/login-bg-13.jpg)"></a></li>
		<li><a href="javascript:;" data-click="change-bg" data-img="assets/img/login-bg/login-bg-12.jpg" style="background-image: url(assets/img/login-bg/login-bg-12.jpg)"></a></li>
	</ul>
@endsection

@push('scripts')
	<script src="assets/js/demo/login-v2.demo.js"></script>
	<script>
		$(document).ready(function() {
			LoginV2.init();
		});
	</script>
	{!! HTML::script('/assets/js/as/login.js') !!}
	{!! JsValidator::formRequest('Vanguard\Http\Requests\Auth\LoginRequest', '#login-form') !!}
@endpush
