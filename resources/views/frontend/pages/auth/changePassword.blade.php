@extends('frontend.layouts.app')

@section('content')
    <div class="page">
        <div class="mid-area-wrap">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center mb-3">Change Password</h1>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 offset-lg-3 offset-md-3">
                        <div class="form-box">
                            <div class="form-control-group"><input class="form-control" placeholder="Old Password" /></div>
                            <div class="form-control-group"><input class="form-control" placeholder="New Password" /></div>
                            <div class="form-control-group"><input class="form-control" placeholder="Confirm Password" /></div>
                            <div class="form-control-group"><button class="btn button w-100 pt-2 pb-2">Change Password</button></div>
                        </div>
                    </div>




                </div>

            </div>
        </div>
    </div>
    @endsection