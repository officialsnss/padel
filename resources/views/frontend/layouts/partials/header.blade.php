<div class="header-area" id="demo-header">
    <div class="header-a">
        <div class="header-a-logo"><a href="/"><img src="{{ asset('frontend/images/logo.svg') }}" alt="" class="img-fluid"></a></div>
        <div class="container">
            <div class="row g-3">
                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="header-a-left">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">{{ (__('home.header.follow_with_us')) }}</li>
                            @php
                            $settings = \App\Models\Setting::where('type', '1')->get();
                            @endphp
                            @foreach ($settings as $setting)
                            @if ($setting->value != '')
                            <li class="list-inline-item"><a href="{{ $setting->value }}">{!! $setting->icon !!}</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- sending notification value for toggle notification  -->
                @php
                $userId = auth()->user()->id ?? '';
                $notification = \App\Models\User::where('id', $userId)->first();
                @endphp

                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="header-a-right">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                @if(!Auth::user())
                                <a href="/login"><i class="bi bi-person-fill"></i>
                                    {{ (__('home.header.login')) }}
                                </a> |
                                <a href="/register"><i class="bi bi-person-fill"></i>
                                    {{ (__('home.header.register')) }}
                                </a>
                                @else
                                <div class="dropdown"><a href="#" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i> {{Auth::user()->name}}</a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                                        <li>
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexSwitchCheckDefault2">Notification</label>
                                                <input class="form-check-input" type="checkbox" onchange="toggleNotification()" role="switch" id="notificationOn" {{  $notification->notification === "1" ? "checked" : "" }}>
                                            </div>
                                        </li>
                                        <li><a class="dropdown-item" href="/change-password">Change password</a></li>
                                        <li><a class="dropdown-item" href="/wallet">Wallet</a></li>
                                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                                    </ul>
                                </div>
                                @endif
                            </li>
                            <li class="list-inline-item"><a href="#"><i class="bi bi-search"></i> {{ (__('home.header.search')) }}</a></li>
                            @if (App::getLocale() == 'ar')
                            <li class="list-inline-item"><a href="{{ url('lang/en') }}"><i class="bi bi-globe2"></i>
                                    EN</a></li>
                            @else
                            <li class="list-inline-item"><a href="{{ url('lang/ar') }}"><i class="bi bi-globe2"></i>
                                    العربية</a></li>
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
                <button class="btn btn-danger navbar-toggler border-3 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><img style="width: 30px" src="{{ asset('frontend/images/text-center.svg') }}" alt="menu icon"></button>

                <div class="offcanvas offcanvas-start-lg bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
                    <div class="offcanvas-header d-flex d-lg-none">
                        <h5 class="offcanvas-title text-white" id="offcanvasExampleLabel"><img src="{{ asset('frontend/images/logo-white.svg') }}" alt="" class="img-fluid"></h5>
                        <a href="javascript:void(0)" class="text-reset p-0" data-bs-dismiss="offcanvas" aria-label="close">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#FFFFFF" class="bi bi-x-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </a>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav mb-0 mx-auto">
                            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">{{ (__('home.menu.Home')) }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/courts') }}">{{ (__('home.menu.Courts')) }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/players') }}">{{ (__('home.menu.Players')) }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/booking') }}">{{ (__('home.menu.Booking')) }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/games') }}">{{ (__('home.menu.Games')) }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/coaches') }}">{{ (__('home.menu.Coaches')) }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/pages/about-us') }}">{{ (__('home.menu.About')) }}</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ url('/contact_us') }}">{{ (__('home.menu.Contact_us')) }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<script>
    function toggleNotification() {
        var check = document.getElementById('notificationOn').checked === true ? 1 : 0;
        console.log(check)

        $.ajax({
            type: "get",
            url: "{{route('notificationSettings')}}",
            data: {
                isNotification: check,
            },
            success: function(data) {
                console.log(data)
            }
        });
    }
</script>