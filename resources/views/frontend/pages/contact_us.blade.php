@extends('frontend.layouts.app')

@section('content')
    <div class="mid-area-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 contact-column">
                    <div class="form-box contact-box">
                        <h2><img src="{{ asset('frontend/images/address_location_map_icon.svg') }}" alt="address" />Address
                        </h2>
                        <div class="form-control-group">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                            blanditiis praesentium voluptatum</div>
                        <h2><img src="{{ asset('frontend/images/phone_icon.svg') }}" alt="Phone" />Phone</h2>
                        <div class="form-control-group">+965 98989898</div>
                        <h2><img src="{{ asset('frontend/images/email_icon.svg') }}" alt="Email" />Email</h2>
                        <div class="form-control-group">info@tabree.com</div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 contact-column">
                    <div class="alert alert-success alert-dismissible fade show text-center" id="success-class"><strong id="success-text"></strong></div>
                    <div class="alert alert-danger alert-dismissible fade show text-center" id="error-class"><strong id="error-text"></strong></div>
                    <div class="form-box">
                        <form method="POST">
                            @csrf
                            <h2>Feedback</h2>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-control-group"><input class="form-control" placeholder="First Name"
                                            name="first_name" id="first_name" />
                                        @error('first_name')
                                            <div class="form-error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-control-group"><input class="form-control" name="last_name"
                                            placeholder="Last Name" id="last_name" /></div>
                                    @error('last_name')
                                        <div class="form-error text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-control-group"><input class="form-control" name="mobile"
                                            placeholder="Mobile Number" id="mobile" />
                                        @error('mobile')
                                            <div class="form-error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="form-control-group"><input class="form-control" name="email"
                                            placeholder="Email Address" id="email" />
                                        @error('email')
                                            <div class="form-error text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-control-group">
                                <textarea class="form-control" rows="5" name="message" placeholder="Comments..." id="message"></textarea>
                                @error('message')
                                    <div class="form-error text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-md-6 col-sm-6">
                                    <div class="form-control-group"><button class="button" type="button" id="sendcontactus">Submit</button></div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="clickloader"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d162108.44647046697!2d47.85697641257192!3d29.277973624765604!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1666593470110!5m2!1sen!2sin"
                        width="100%" height="650" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>


            </div>

        </div>
    </div>
    @php
    $var = $_SERVER['REQUEST_URI'];
@endphp
@endsection

