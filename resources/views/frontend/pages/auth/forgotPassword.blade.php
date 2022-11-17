
@extends('frontend.layouts.app')

@section('content')
	<div class="mid-area-wrap login-register">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 col-sm-12 col-md-12 col-lg-5">
					<div class="login-register-in">
						<h1 class="mb-3">Reset Password</h1>
						
						<p class="mb-5">You will receive instructions for resetting your password.</p>
						
						<div class="form-floating mb-3">
							<input type="email" class="form-control" id="forgot-email" placeholder="name@example.com">
							<label for="forgot-email">Your Email</label>
						</div>
						<div class="d-grid mb-5"><a class="btn-gradient" type="button">SEND</a></div>
						
						<p class="mb-0"><center>Back to <a href="/login">Login</a></center></p>
					</div>
				</div>
			</div>
		
		</div>
	</div>
@endsection