<header>
    <div class="top-header">
        <div class="container">
            <div class="row">
                <div class="col-12 topnnavi">
                    <h5 class="top-follow-head">Follow With Us : </h5>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex justify-content-between">
                                <ul class="list-inline mb-0 top-social">
                                    @php

                                    $settings = \App\Models\Setting::where('type', '1')->get();

                                    @endphp
                                    @foreach($settings as $setting)
                                         @if($setting->value != '')
                                         <li class="list-inline-item"><a href="{{ $setting->value }}">@php echo $setting->icon @endphp</a></li>
                                         @endif
                                    @endforeach
                                    {{-- @if(!empty($settings))
                                            <li class="list-inline-item"><a href="#"></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="bi bi-twitter"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="bi bi-instagram"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="bi bi-youtube"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i
                                                    class="bi bi-linkedin"></i></a></li>

                                    @endif --}}
                                </ul>
                            </div>
                            <div class="col-lg-4 col-md-4 tbaree-col-mobile">
                                <div class="tbaree-logo text-center">
                                    <img src="http://retalkapp.com/tbaree/01/images/tbaree-logo.png" class="img-fluid" alt="Tbaree">
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="login-wish-account">
                                    <ul>
                                        <li class="account-main">
                                            <a href="javascript:void(0);" class="account-link"><img
                                                    src="http://retalkapp.com/tbaree/01/images/my-account.svg" alt="My Account"><span>My
                                                    Account</span></a>
                                            <div class="account-div">
                                                <ul class="account-ul">
                                                    <li><a href="javscript:void(0)">Login</a></li>
                                                    <li><a href="javscript:void(0)">Register</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <div class="search-main">
                                                <a href="javascript:void(0);" class="search-link"><img
                                                        class="icon-close" src="http://retalkapp.com/tbaree/01/images/icon-close.png"
                                                        alt="close"><img class="icon-search"
                                                        src="http://retalkapp.com/tbaree/01/images/icon-search.svg" alt="search"> Search</a>
                                                <form name="Searchform" action="searchresults.php"
                                                    method="post">
                                                    <div class="search-sub" style="display: none;">
                                                        <div class="search-div">
                                                            <div class="search-input">
                                                                <input required="" name="searchword"
                                                                    type="search" class="form-control"
                                                                    placeholder="Search here..." value=""
                                                                    minlength="3">
                                                                <button type="submit"
                                                                    name="submitsearch">GO</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="ar/index.php" class="arabic-lang">العربية </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 navibar">
        <div class="navigation container-fluid">
            <div class="wsmenucontainer clearfix">
                <div class="overlapblackbg"></div>
                <div class="wsmobileheader clearfix">
                    <a id="wsnavtoggle" class="animated-arrow"><span></span></a>
                </div>
                <div class="wsmain">
                    <nav class="wsmenu clearfix">
                        <ul class="mobile-sub wsmenu-list">
                            <li><a href="javascript:void(0);" class="active">Home</a></li>
                            <li><a href="javascript:void(0);">Players</a></li>
                            <li><a href="javascript:void(0);">Booking</a></li>
                            <li><a href="javascript:void(0);">Games</a></li>
                            <li><a href="javascript:void(0);">Coaches</a></li>
                            <li><a href="javascript:void(0);">About Us</a></li>
                            <li><a href="javascript:void(0);">Contact Us</a></li>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
