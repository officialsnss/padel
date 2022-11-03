@extends('frontend.layouts.app')

@section('content')
    <div class="mid-area-wrap login-register">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-12 col-lg-5">
                    <div class="login-register-in">
                        <form metod="post">
                            <div class="alert alert-danger alert-dismissible fade show text-center" id="error-class"><strong id="error-text"></strong></div>
                            <div class="alert alert-success alert-dismissible fade show text-center" id="otp-success-class">We have sent an OTP to your registered mobile</div>
                            <h1 class="mb-3">Verify Account</h1>

                            <div class="form-floating mb-3">
                                <input type="hidden" class="form-control" id="ip" value="{{$ip}}">
                                <input type="hidden" class="form-control" id="phone" value="{{$phone}}">
                                <input type="text" class="form-control" id="otp" placeholder="1234">
                                <label for="forgot-email">Enter OPT</label>
                            </div>

                            <div class="d-grid mb-5"><a class="btn-gradient" type="button" id="verify">Verify</a></div>
                        </form>
                        <p class="mb-0">
                            <center>Back to <a href="login.html">Login</a></center>
                        </p>





                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
