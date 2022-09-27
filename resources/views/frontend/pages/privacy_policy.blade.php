@extends('frontend.layouts.app')

@section('content')
    {{-- Popular Courts Layout --}}
    <section class="popular-courts home-page-section">
        <div class="padding-left-right">
            <div class="container"><br><br><br><br><br>
                @foreach ($pps as $pp)
                    <h2>
                        @if (App::getLocale() == 'kw')
                            {{ $pp->title_arabic }}
                        @else
                            {{ $pp->title }}
                        @endif
                    </h2>
                    <div class="carousel-main wow fadeInUp" data-wow-delay="0.4s">
                        <div class="product-container swiper-container">
                            <div class="swiper-wrapper text-white">


                                @if (App::getLocale() == 'kw')
                                    {!! $pp->content_arabic !!}
                                @else
                                {!! $pp->content !!}
                                @endif


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
