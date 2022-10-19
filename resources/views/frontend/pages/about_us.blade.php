@extends('frontend.layouts.app')

@section('content')
    {{-- Popular Courts Layout --}}
    <section class="popular-courts home-page-section">
        <div class="padding-left-right">
            <div class="container"><br><br><br><br><br>
                @foreach ($abs as $ab)
                    <h2>
                        @if (App::getLocale() == 'kw')
                            {{ $ab->title_arabic }}
                        @else
                            {{ $ab->title }}
                        @endif
                    </h2>
                    <div class="carousel-main wow fadeInUp" data-wow-delay="0.4s">
                        <div class="product-container swiper-container">
                            <div class="swiper-wrapper text-white">


                                @if (App::getLocale() == 'kw')
                                    {!! $ab->content_arabic !!}
                                @else
                                {!! $ab->content !!}
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
