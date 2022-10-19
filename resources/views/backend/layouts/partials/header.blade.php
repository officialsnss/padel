<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ url('/') }}" class="nav-link">{{ (__('backend.menuTop.Home')) }}</a>
        </li>

    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <i class="nav-icon fas fa-globe"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-sm" style="text-decoration: none; padding: 3px; width:auto;">
                <a href="/lang/en"style="text-decoration: none;">
                    <li class="nav-item">
                        <img src="{{ asset('Images/flags/usa.png') }}" class=""
                        alt="User Image" style="width: 23px">
                        <span class="text-secondary">
                            English
                        </span>
                    </li>
                </a>
                <a href="/lang/kw">
                    <li class="nav-item">
                        <img src="{{ asset('Images/flags/uae.png') }}" class=""
                            alt="User Image" style="width: 23px">
                        <span class="text-secondary">
                            عربي
                        </span>
                    </li>
                </a>
            </ul>
        </li>
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/backend/img/user2-160x160.jpg') }}" class="user-image img-circle elevation-2"
                    alt="User Image">
                <span class="d-none d-md-inline">
                    @if(App::getLocale() == 'kw'){{ Auth::user()->name_arabic }}@else{{ Auth::user()->name }}@endif</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <li class="user-header bg-primary">
                    <img src="{{ asset('assets/backend/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                        alt="User Image">
                    <p>
                        {{ Auth::user()->name }}
                        <small>{{ Auth::user()->email }}</small>
                    </p>
                </li>
                <li class="user-footer">
                    <div class="signout">
                        <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                        <a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                            {{ __('Sign out') }}
                        </a>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
    </ul>
</nav>
