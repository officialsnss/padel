<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TBAREE</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <link rel="apple-touch-icon" sizes="57x57" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="http://retalkapp.com/tbaree/01/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="http://retalkapp.com/tbaree/01/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://retalkapp.com/tbaree/01/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="http://retalkapp.com/tbaree/01/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://retalkapp.com/tbaree/01/favicon/favicon-16x16.png">
    <link rel="manifest" href="http://retalkapp.com/tbaree/01/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="http://retalkapp.com/tbaree/01/css/jpreloader.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="http://retalkapp.com/tbaree/01/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" type="text/css" href="http://retalkapp.com/tbaree/01/fancybox-master/jquery.fancybox.min.css" />
    <link href="http://retalkapp.com/tbaree/01/swiper/swiper.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet" />
    <!--<link href="css/mouse.css" rel="stylesheet" type="text/css" media="all" />-->
    <link href="http://retalkapp.com/tbaree/01/scrollbar/jquery.mCustomScrollbar.min.css" rel="stylesheet" type="text/css" media="all" />
    <link href="http://retalkapp.com/tbaree/01/css/scroll.css" rel="stylesheet" type="text/css" media="all" />
    <link href="http://retalkapp.com/tbaree/01/css/jquery-ui.css" rel="stylesheet" type="text/css" media="all" />
    <link href="http://retalkapp.com/tbaree/01/css/webslidemenu.css" rel="stylesheet" type="text/css" media="all" />
    <link href="http://retalkapp.com/tbaree/01/css/tbaree.css" rel="stylesheet" type="text/css" media="all" />
    <link href="http://retalkapp.com/tbaree/01/css/responsive.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('css/jquery.rateyo.min.css') }}"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/rating.js')}}"></script>
    <script src="{{asset('js/jquery.rateyo.js')}}"></script>
</head>

<body>
    @include('frontend.layouts.partials.header')

    <div id="viewport">
        <div id="scroll-container">
            <div class="tbaree-logo tbaree-logo-mobile text-center">
                <img src="http://retalkapp.com/tbaree/01/images/tbaree-logo.png" class="img-fluid" alt="Tbaree">
            </div>

            @yield('content')

            @include('frontend.layouts.partials.footer')

        </div>
    </div>
    <div class="shape-quick-wrapper"></div>

    <script src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
    <script src="http://retalkapp.com/tbaree/01/js/bootstrap.bundle.min.js"></script>
    <script src="http://retalkapp.com/tbaree/01/js/jpreloader.js"></script>
    <script src="http://retalkapp.com/tbaree/01/js/loader.js"></script>
    <script src="http://retalkapp.com/tbaree/01/js/webslidemenu.js"></script>
    <script src="http://retalkapp.com/tbaree/01/js/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="http://retalkapp.com/tbaree/01/swiper/swiper.js"></script>
    <script type="text/javascript" src="http://retalkapp.com/tbaree/01/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="http://retalkapp.com/tbaree/01/fancybox-master/jquery.fancybox.min.js"></script>
    <script src="http://retalkapp.com/tbaree/01/fancybox-master/fancybox.js"></script>
    <script src="http://retalkapp.com/tbaree/01/js/jquery.lavalamp.min.js"></script>
    <script src="http://retalkapp.com/tbaree/01/js/custom.js"></script>

    <script src="{{asset('js/api.js')}}"></script>
</body>

</html>
