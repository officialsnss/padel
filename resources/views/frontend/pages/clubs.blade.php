@extends('frontend.layouts.app')

@section('content')
<!-- Hashimi model Padel Court -->
<div class="modal fade" id="court-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title m-0" id="exampleModalLabel">Hashimi Padel Court</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="swiper mySwiper mb-4">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide"><img src="{{ asset('frontend/images/court-a.jpg') }}" alt="" class="img-fluid"></div>
                        <div class="swiper-slide"><img src="{{ asset('frontend/images/court-b.jpg') }}" alt="" class="img-fluid"></div>
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

                <p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph.</p>

                <h5>ADDRESS</h5>
                <div class="location-wrap-modal">
                    <div class="row g-2 align-items-center">
                        <div class="col-auto"><div class="modal-icon"><i class="bi bi-geo-alt-fill"></i></div></div>
                        <div class="col">Al Nouf Tower, 11th Floor، Jaber Al-Mubarak St, Kuwait City.</div>
                    </div>
                </div>

                <div class="facilities-wrap-modal">
                    <h5>FACILITIES</h5>
                    <div class="row g-2">
                        <div class="col-6 col-sm-6 col-md-4 col-lg-2">
                            <div class="facilities-block-modal">
                                <div class="line-a"><img src="{{ asset('frontend/images/popular-courts/icon-1.png') }}" alt="" class="img-fluid"></div>
                                <div class="line-b">Rackets</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-2">
                            <div class="facilities-block-modal">
                                <div class="line-a"><img src="{{ asset('frontend/images/popular-courts/icon-2.png') }}" alt="" class="img-fluid"></div>
                                <div class="line-b">Changing Room</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-2">
                            <div class="facilities-block-modal">
                                <div class="line-a"><img src="{{ asset('frontend/images/popular-courts/icon-3.png') }}" alt="" class="img-fluid"></div>
                                <div class="line-b">Fridge</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-2">
                            <div class="facilities-block-modal">
                                <div class="line-a"><img src="{{ asset('frontend/images/popular-courts/icon-4.png') }}" alt="" class="img-fluid"></div>
                                <div class="line-b">Parking</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-2">
                            <div class="facilities-block-modal">
                                <div class="line-a"><img src="{{ asset('frontend/images/popular-courts/icon-5.png') }}" alt="" class="img-fluid"></div>
                                <div class="line-b">Seating area</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-2">
                            <div class="facilities-block-modal">
                                <div class="line-a"><img src="{{ asset('frontend/images/popular-courts/icon-6.png') }}" alt="" class="img-fluid"></div>
                                <div class="line-b">Prayer Area</div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="services-wrap-modal">
                    <h5>SERVICES</h5>
                    <div class="row g-2">
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="services-block-modal">
                                <div class="line-a">Rackets</div>
                                <div class="line-b">Available for Rent</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="services-block-modal">
                                <div class="line-a">Courts</div>
                                <div class="line-b">8 Courts</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="services-block-modal">
                                <div class="line-a">Ratings</div>
                                <div class="line-b">5.8</div>
                            </div>
                        </div>
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                            <div class="services-block-modal">
                                <div class="line-a">Bookings</div>
                                <div class="line-b">552</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <div class="container-fluid">
                <div class="row justify-content-between g-4 align-items-center">
                    <div class="col-auto"><h3 class="mb-0">20 KWD / Hour</h3></div>
                    <div class="col-auto"><a class="modal-button" href="courts-book.html" role="button">BOOK NOW</a></div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Hashimi model Padel Court -->

<!-- Hashimi Padel Court -->
<div class="mid-area-wrap">
    <div class="container">

        <div class="row g-4 all-club-data">

            {{-- <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="courts-block">
                    <div class="courts-block-img">
                        <img src="{{ asset('frontend/images/hashimi-padel-court-1.jpg') }}" alt="" class="img-fluid">
                        <span class="rating"><i class="bi bi-star-fill"></i> 4.5</span>
                        <span class="price"><i class="bi bi-ticket-fill"></i> 30.000 KWD/hr</span>
                    </div>
                    <div class="courts-block-desc">
                        <div class="line-a">Hashimi Padel Court</div>
                        <div class="line-b">
                            <div class="row g-1">
                                <div class="col-2"><div class="courts-icons" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Racket" data-bs-custom-class="custom-tooltip"><img src="{{ asset('frontend/images/popular-courts/icon-1.png') }}" alt="" class="img-fluid"></div></div>
                                <div class="col-2"><div class="courts-icons" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Changing Room" data-bs-custom-class="custom-tooltip"><img src="{{ asset('frontend/images/popular-courts/icon-2.png') }}" alt="" class="img-fluid"></div></div>
                                <div class="col-2"><div class="courts-icons" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Fridge" data-bs-custom-class="custom-tooltip"><img src="{{ asset('frontend/images/popular-courts/icon-3.png') }}" alt="" class="img-fluid"></div></div>
                                <div class="col-2"><div class="courts-icons" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Parking" data-bs-custom-class="custom-tooltip"><img src="{{ asset('frontend/images/popular-courts/icon-4.png') }}" alt="" class="img-fluid"></div></div>
                                <div class="col-2"><div class="courts-icons" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Lounge" data-bs-custom-class="custom-tooltip"><img src="{{ asset('frontend/images/popular-courts/icon-5.png') }}" alt="" class="img-fluid"></div></div>
                                <div class="col-2"><div class="courts-icons" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Prayer Room" data-bs-custom-class="custom-tooltip"><img src="{{ asset('frontend/images/popular-courts/icon-6.png') }}" alt="" class="img-fluid"></div></div>
                            </div>
                        </div>
                        <div class="line-c"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#court-details">More Details</a></div>
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
</div>
<!-- Hashimi Padel Court -->
@endsection
