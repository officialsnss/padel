@extends('frontend.layouts.app')

@section('content')
    <div class="mid-area-wrap login-register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                    <div class="login-register-in">
                        <div class="alert alert-danger alert-dismissible fade show text-center" id="error-class"><strong id="error-text"></strong></div>
                        <h1 class="mb-5">Sign Up</h1>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="signup-name" placeholder="Name">
                            <label for="signup-name">Name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="signup-email" placeholder="name@example.com">
                            <label for="signup-email">Email</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="signup-password" placeholder="Password">
                            <label for="signup-password">Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="signup-confirm-password"
                                placeholder="Confirm Password">
                            <label for="signup-confirm-password">Confirm Password</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="signup-mobile" placeholder="Mobile">
                            <label for="signup-mobile">Mobile</label>
                        </div>
                        <input type="hidden" class="form-control" name="ipAddress" placeholder="Email Address" id="ip" value="{{ $_SERVER['REMOTE_ADDR'] }}" />
                        <div class="d-grid mb-5"><button class="btn-gradient" type="button" id="register">SIGNUP</button></div>

                        <p class="mb-0">
                            <center>Don't have an account? <a href="/login">login</a></center>
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
