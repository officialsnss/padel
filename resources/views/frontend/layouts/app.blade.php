<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msapplication-TileColor" content="#da532c">
<meta name="theme-color" content="#ffffff">
<title>Tbaree</title>
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('frontend/images/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('frontend/images/favicon/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('frontend/images/favicon/favicon-16x16.png') }}">
<link rel="manifest" href="{{ asset('frontend/images/favicon/site.webmanifest') }}">
<link rel="mask-icon" href="{{ asset('frontend/images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" rel="stylesheet" type="text/css">
<link href="{{ asset('frontend/css/custom.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('frontend/css/jquery.datetimepicker.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('css/jquery.rateyo.min.css') }}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />

    <link rel="stylesheet" href="{{ asset('css/jquery.rateyo.css') }}"/>
    {{-- <link rel="stylesheet" href="{{ asset('starrr.css') }}"/> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<body>

<div class="page">

    @include('frontend.layouts.partials.header')

    @yield('content')

    @include('frontend.layouts.partials.footer')

</div>




<script src="{{ asset('frontend/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>

<script src="{{ asset('frontend/js/jpreloader.js') }}"></script>
<script>
    // $(document).ready(function() {
    //     $('body').jpreLoader();
    // });
</script>

<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script>
var swiper = new Swiper(".mySwiper", {
	slidesPerView: 1,
	spaceBetween: 0,

	speed: 700,
	loop: true,
	adeEffect: {
		crossFade: true
	},
	autoplay: {
		delay: 5000,
	},
	pagination: {
		el: ".swiper-pagination",
		dynamicBullets: true,
		clickable: true,
	},
});

var swiper2 = new Swiper(".popular-courts", {
	slidesPerView: 1,
	spaceBetween: 10,
	speed: 1000,
	autoplay: {
		delay: 2500,
		disableOnInteraction: false,
	},
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
	breakpoints: {
		640: {
			slidesPerView: 1,
			spaceBetween: 10,
		},
		768: {
			slidesPerView: 2,
			spaceBetween: 10,
		},
		1024: {
			slidesPerView: 3,
			spaceBetween: 30,
		},
	},
});

var swiper3 = new Swiper(".players-swiper", {
	slidesPerView: 2,
	spaceBetween: 10,
	speed: 1000,
	autoplay: {
		delay: 2500,
		disableOnInteraction: false,
	},
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
	breakpoints: {
		640: {
			slidesPerView: 2,
			spaceBetween: 15,
		},
		768: {
			slidesPerView: 3,
			spaceBetween: 15,
		},
		1024: {
			slidesPerView: 4,
			spaceBetween: 30,
		},
	},
});

var swiper4 = new Swiper(".coach-swiper", {
	slidesPerView: 2,
	spaceBetween: 10,
	speed: 1000,
	autoplay: {
		delay: 2500,
		disableOnInteraction: false,
	},
	navigation: {
		nextEl: ".swiper-button-next",
		prevEl: ".swiper-button-prev",
	},
	pagination: {
		el: ".swiper-pagination",
		clickable: true,
	},
	breakpoints: {
		640: {
			slidesPerView: 2,
			spaceBetween: 15,
		},
		768: {
			slidesPerView: 3,
			spaceBetween: 15,
		},
		1024: {
			slidesPerView: 4,
			spaceBetween: 30,
		},
	},
});
</script>


<script src="{{ asset('frontend/js/jquery.stickme.js') }}"></script>
<script>
	$.stickme();
</script>
<script src="{{ asset('frontend/js/jquery.datetimepicker.js') }}"></script>
    <script>
        $('#cb-date-time').datetimepicker();
    </script>
{{-- <script src="{{asset('js/starrr.js')}}"></script> --}}
    {{-- <script src="{{asset('js/rating.js')}}"></script> --}}
    <script src="{{asset('js/jquery.rateyo.js')}}"></script>
    <script src="{{asset('js/jquery.rateyo.min.js')}}"></script>
    <script>
        var language = "{{App::getLocale()}}";
    </script>
    <script src="{{asset('js/api.js')}}"></script>
	<!-- CSS -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

	<!-- JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.16/dist/sweetalert2.all.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
</body>
</html>
