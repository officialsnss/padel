@extends('frontend.layouts.app')

@section('content')
<div class="mid-area-wrap login-register">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-sm-12 col-md-12 col-lg-5">
				<div class="login-register-in">
					<h1 class="mb-3">Reset Password</h1> 
					  @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                            @endif

					<p class="mb-5">You will receive instructions for resetting your password.</p>
					<div class="text-danger"><p>@if($errors->all() != []){{$errors->getMessages()[0][0]}}@endif</p></div>
 					@error('email')
					<div class="form-error text-danger">{{ $message }}</div>
					@enderror

					<form action="{{route('sendMail')}}" method="post">
						@csrf
						<div class="form-floating mb-3">
							<input type="email" class="form-control" name="email" id="forgot-email" placeholder="name@example.com">
							<label for="forgot-email">Your Email</label>
						</div>
						<div class="d-grid mb-5">
							<button class="btn-gradient" type="submit">SEND</button>
						</div>
					</form>

					<p class="mb-0">
						<center>Back to <a href="/login">Login</a></center>
					</p>
				</div>
			</div>
		</div>

	</div>
</div>
@endsection