@extends('frontend.layouts.app')

@section('content')

<div class="banner-area">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            @php
                    $banners = \App\Models\HomeSlider::all();

                @endphp
                @foreach ($banners as $banner)
                    @if ($banner->image != '')
                        <div class="swiper-slide">
                            <div class="swiper-block">
                                <div class="swiper-image"><img src="{{ URL::to('/') }}/Images/homeslider_images/{{ $banner->image }}" alt="{{ $banner->image }}" class="img-fluid"></div>
                                <div class="swiper-caption">
                                    <h1 class="mb-4">
                                        @if(App::getLocale() == 'kw')
                                        {!! $banner->arabic_heading !!}
                                        @else
                                            {!! $banner->heading !!}
                                        @endif
                                    </h1>
                                    <a href="{{ $banner->button_url }}" class="banner-booknow">
                                        @if(App::getLocale() == 'kw')
                                            {{ $banner->arabic_button_label }}
                                        @else
                                            {{ $banner->button_label }}
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>



<div class="upcoming-tournament-wrap">
    <div class="container">
        <h1 class="mb-4">UPCOMMING TOURNAMENT</h1>

        <div class="ut-left-right">
            <div class="ut-left"><img src="{{ asset('frontend/images/ut-left.jpg') }}" class="img-fluid" alt=""></div>
            <div class="ut-right">
                <div class="ut-right-in">
                    <h3>BOUBYAN PEDAL TOURNAMENT</h3>
                    <p>Out of Boubyan Bank’s keenness on keeping pace with all new developments concerning youths’ activities, the bank will be organizing the biggest padel tournament in Kuwait.</p>
                    <p>Padel has started gaining strong grounds among youths in Kuwait, and this tournament will have a total prize money of KD 3,000.</p>
                    <p class="mb-0"><a href="javascript:void(0)" class="ut-button">PARTICIPATE</a> <a href="javascript:void(0)" class="ut-button">FIXTURE</a></p>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="popular-courts-wrap">
    <div class="container">
        <h1 class="mb-4">POPULAR COURTS</h1>


        <div class="swiper popular-courts">
            <div class="swiper-wrapper res-data">

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</div>




<div class="players-coach-wrap">
    <div class="container">

        <ul class="nav nav-pills mb-5 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation"><button class="nav-link active" id="pills-players-tab" data-bs-toggle="pill" data-bs-target="#pills-players" type="button" role="tab" aria-controls="pills-players" aria-selected="true">PLAYERS</button></li>
            <li class="nav-item" role="presentation"><button class="nav-link" id="pills-coach-tab" data-bs-toggle="pill" data-bs-target="#pills-coach" type="button" role="tab" aria-controls="pills-coach" aria-selected="false">COACH</button></li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-players" role="tabpanel" aria-labelledby="pills-players-tab" tabindex="0">
                <div class="swiper players-swiper">
                    <div class="swiper-wrapper player-list-data">



                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="pills-coach" role="tabpanel" aria-labelledby="pills-coach-tab" tabindex="0">
                <div class="swiper coach-swiper">
                    <div class="swiper-wrapper coach-list-data">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
