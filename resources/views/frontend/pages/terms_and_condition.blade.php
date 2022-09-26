@extends('frontend.layouts.app')

@section('content')
    {{-- Popular Courts Layout --}}
    <section class="popular-courts home-page-section">
        <div class="padding-left-right">
            <div class="container"><br><br><br><br><br>
                @foreach ($tncs as $tnc)
                    <h2>
                        @if (App::getLocale() == 'kw')
                            {{ $tnc->title_arabic }}
                        @else
                            {{ $tnc->title }}
                        @endif
                    </h2>
                    <div class="carousel-main wow fadeInUp" data-wow-delay="0.4s">
                        <div class="product-container swiper-container">
                            <div class="swiper-wrapper">


                                @if (App::getLocale() == 'kw')
                                    {!! $tnc->content_arabic !!}
                                @else
                                {!! $tnc->content !!}
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
