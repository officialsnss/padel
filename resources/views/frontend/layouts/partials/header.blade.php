<div class="header-area" id="demo-header">
    <div class="header-a">
        <div class="header-a-logo"><a href="index.html"><img src="{{ asset('frontend/images/logo.svg') }}" alt="" class="img-fluid"></a></div>
        <div class="container">
            <div class="row g-3">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="header-a-left">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">Follow us</li>
                            <li class="list-inline-item"><a href="#"><i class="bi bi-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="bi bi-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="bi bi-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="bi bi-youtube"></i></a></li>
                            <li class="list-inline-item"><a href="#"><i class="bi bi-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="header-a-right">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item"><a href="login.html"><i class="bi bi-person-fill"></i> Login</a> | <a href="register.html"><i class="bi bi-person-fill"></i> Register</a></li>
                            <li class="list-inline-item"><a href="#"><i class="bi bi-search"></i> Search</a></li>
                            @if(App::getLocale() == 'ar')
                                <li class="list-inline-item"><a href="{{url('lang/en')}}"><i class="bi bi-globe2"></i> EN</a></li>
                            @else
                                <li class="list-inline-item"><a href="{{url('lang/ar')}}"><i class="bi bi-globe2"></i> العربية</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="header-b stickme">
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container">
                <button class="btn btn-danger navbar-toggler border-3 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><img style="width: 30px" src="images/text-center.svg" alt="menu icon"></button>

                <div class="offcanvas offcanvas-start-lg bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header d-flex d-lg-none">
                        <h5 class="offcanvas-title text-white" id="offcanvasExampleLabel"><img src="images/logo-white.svg" alt="" class="img-fluid"></h5>
                        <a href="javascript:void(0)" class="text-reset p-0" data-bs-dismiss="offcanvas" aria-label="close">
                            <svg xmlns="http://www.w3.org/2000/svg" width = "24" height = "24" fill = "#FFFFFF" class = "bi bi-x-circle" viewBox = "0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav mb-0 mx-auto">
                            <li class="nav-item"><a class="nav-link" href="index.html">HOME</a></li>
                            <li class="nav-item"><a class="nav-link" href="courts.html">COURTS</a></li>
                            <li class="nav-item"><a class="nav-link" href="players.html">PLAYERS</a></li>
                            <li class="nav-item"><a class="nav-link" href="booking.html">BOOKING</a></li>
                            <li class="nav-item"><a class="nav-link" href="games.html">GAMES</a></li>
                            <li class="nav-item"><a class="nav-link" href="coaches.html">COACHES</a></li>
                            <li class="nav-item"><a class="nav-link" href="about-us.html">ABOUT US</a></li>
                            <li class="nav-item"><a class="nav-link" href="contact.us.html">CONTACT US</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
