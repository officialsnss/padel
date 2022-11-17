@extends('frontend.layouts.app')

@section('content')
    <div class="mid-area-wrap login-register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                    <div class="login-register-in">
                        <form method="POST">
                            @csrf
                            <h1 class="mb-5">Sign in</h1>
                            <div class="text-danger" id="error-class"><p id="error-text"></p></div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="login-email" placeholder="name@example.com"
                                    name="email">
                                <label for="login-email">Email</label>
                                @error('email')
                                    <div class="form-error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-1">
                                <input type="password" class="form-control" id="login-password" placeholder="Password"
                                    name="password">
                                <label for="login-password">Password</label>
                                @error('password')
                                    <div class="form-error text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <p class="mb-3" style="text-align: right;"><small><a href="/forgot-password">Forgot your
                                        Password</a></small></p>

                            <div class="d-grid mb-5"><button class="btn-gradient" type="button" id="login">LOGIN</button></div>
                        </form>
                        <p>
                            <center>EASILY USING</center>
                        </p>

                        <div class="row g-3 justify-content-center mb-5">
                            <div class="col-auto"><a class="social-media google-media" href="javascript:void(0)"><i
                                        class="bi bi-google"></i></a></div>
                            <div class="col-auto"><a class="social-media apple-media" href="javascript:void(0)"><i
                                        class="bi bi-apple"></i></a></div>
                            <div class="col-auto"><a class="social-media facebook-media" href="javascript:void(0)"><i
                                        class="bi bi-facebook"></i></a></div>
                        </div>

                        <p class="mb-0">
                            <center>Not registered yet? <a href="/register">Create account</a></center>
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
