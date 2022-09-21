@extends('layouts.app')

@section('content')
    <section class="banner-main home-banner-main">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="slideshow-box position-relative">
                        <!--<picture>
                            <source media="(max-width: 1200px) and (min-width: 992px)" srcset="">
                            <source media="(max-width: 991px) and (min-width: 770px)" srcset="">
                            <source media="(max-width: 769px) and (min-width: 401px)" srcset="">
                            <source media="(max-width: 400px)" srcset="">
                            <img class="imageFill" src="">
                        </picture>-->

                        <div class="slideshow-img">
                            <picture>
                                <source media="(max-width: 1200px) and (min-width:641px)" srcset="http://retalkapp.com/tbaree/01/slideshow/slide-1.jpg" />
                                <source media="(max-width: 640px)" srcset="http://retalkapp.com/tbaree/01/slideshow/slide-1.jpg" />
                                <img class="imageFill" src="http://retalkapp.com/tbaree/01/slideshow/slide-1.jpg" class="img-fluid" alt="" />
                            </picture>
                        </div>
                        <div class="slideshow-contents position-absolute d-flex align-items-center">
                            <div class="w-100">
                                <h1 class="text-uppercase">Ready To<br> Plan Your<br> Next Game ?</h1>
                                <p class="slideshow-links"><a href="javascript:void(0);">Book Now</a></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="slideshow-box position-relative">
                        <!--<picture>
                            <source media="(max-width: 1200px) and (min-width: 992px)" srcset="">
                            <source media="(max-width: 991px) and (min-width: 770px)" srcset="">
                            <source media="(max-width: 769px) and (min-width: 401px)" srcset="">
                            <source media="(max-width: 400px)" srcset="">
                            <img class="imageFill" src="">
                        </picture>-->

                        <div class="slideshow-img">
                            <picture>
                                <source media="(max-width: 1200px) and (min-width:641px)" srcset="http://retalkapp.com/tbaree/01/slideshow/slide-1.jpg" />
                                <source media="(max-width: 640px)" srcset="http://retalkapp.com/tbaree/01/slideshow/slide-1.jpg" />
                                <img class="imageFill" src="http://retalkapp.com/tbaree/01/slideshow/slide-1.jpg" class="img-fluid" alt="" />
                            </picture>
                        </div>
                        <div class="slideshow-contents position-absolute d-flex align-items-center">
                            <div class="w-100">
                                <h1 class="text-uppercase">Ready To<br> Plan Your<br> Next Game ?</h1>
                                <p class="slideshow-links"><a href="javascript:void(0);">Book Now</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="swiper-pagination slideshow-pagination"></div>
            <div class="swiper-button-next slideshow-button-next"></div>
            <div class="swiper-button-prev slideshow-button-prev"></div>-->
        </div>
    </section>

    <section class="upcoming-tournament home-page-section">
        <div class="padding-left-right">
            <div class="container">
                <h2>Upcoming Tournament</h2>
                <div class="row no-gutters">
                    <div class="col-lg-5 col-md-12">
                        <div class="upcoming-img">
                            <img src="http://retalkapp.com/tbaree/01/images/upcoming-img.webp" class="img-fluid" alt="">
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-12">
                        <div class="upcoming-text">
                        </div>
                        <div class="upcoming-main-text">
                            <h3>Boubyan Pedal Tournament</h3>
                            <p>Out of Boubyan Bank’s keenness on keeping pace with all new developments concerning youths’
                                activities, the bank will be organizing the biggest padel tournament in Kuwait.</p>
                            <p>Padel has started gaining strong grounds among youths in Kuwait, and this tournament will
                                have a total prize money of KD 3,000.</p>
                            <div class="upcoming-btn">
                                <a href="javascript:void(0)" class="btn1">Participate</a>
                                <a href="javascript:void(0)" class="btn2">Fixtures</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="popular-courts home-page-section">
        <div class="padding-left-right">
            <div class="container">
                <h2>Popular Courts</h2>
                <div class="carousel-main wow fadeInUp" data-wow-delay="0.4s">
                    <div class="product-container swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="courts-div">
                                    <div class="courts-name-desc">
                                        <h4>Play Padel</h4>
                                        <div class="star-rating">
                                            <input type="radio" id="5-stars" name="rating" value="5" />
                                            <label for="5-stars" class="star">&#9733;</label>
                                            <input type="radio" id="4-stars" name="rating" value="4" />
                                            <label for="4-stars" class="star" style="color: #fc0;">&#9733;</label>
                                            <input type="radio" id="3-stars" name="rating" value="3" />
                                            <label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>
                                            <input type="radio" id="2-stars" name="rating" value="2" />
                                            <label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>
                                            <input type="radio" id="1-star" name="rating" value="1" />
                                            <label for="1-star" class="star" style="color: #fc0;">&#9733;</label>
                                        </div>
                                        <div class="clearfix-space"></div>
                                        <div class="row">
                                            <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                                                <span><img src="http://retalkapp.com/tbaree/01/images/icons/wallet.png" class="img-fluid"
                                                        alt=""> 30KD/hr</span>
                                            </div>
                                            <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                                                <span><img src="http://retalkapp.com/tbaree/01/images/icons/location-pin.png" class="img-fluid"
                                                        alt=""> Salmiya, Kuwait</span>
                                            </div>
                                        </div>
                                        <div class="clearfix-space"></div>
                                        <div class="row">
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-1.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-2.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-3.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-4.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-5.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="http://retalkapp.com/tbaree/01/images/court-img-1.webp" class="img-fluid" alt="">
                                </div>
                                <div class="know-more-arrow">
                                    <a href="javascript:void(0)"><img src="http://retalkapp.com/tbaree/01/images/arrow-next-icon.png" class="img-fluid"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="courts-div">
                                    <div class="courts-name-desc">
                                        <h4>Hashimi Padel Court</h4>
                                        <div class="star-rating">
                                            <input type="radio" id="05-stars" name="rating" value="5" />
                                            <label for="5-stars" class="star">&#9733;</label>
                                            <input type="radio" id="04-stars" name="rating" value="4" />
                                            <label for="4-stars" class="star">&#9733;</label>
                                            <input type="radio" id="03-stars" name="rating" value="3" />
                                            <label for="3-stars" class="star">&#9733;</label>
                                            <input type="radio" id="02-stars" name="rating" value="2" />
                                            <label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>
                                            <input type="radio" id="01-star" name="rating" value="1" />
                                            <label for="1-star" class="star" style="color: #fc0;">&#9733;</label>
                                        </div>
                                        <div class="clearfix-space"></div>
                                        <div class="row">
                                            <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                                                <span><img src="http://retalkapp.com/tbaree/01/images/icons/wallet.png" class="img-fluid"
                                                        alt=""> 30KD/hr</span>
                                            </div>
                                            <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                                                <span><img src="http://retalkapp.com/tbaree/01/images/icons/location-pin.png" class="img-fluid"
                                                        alt=""> Salmiya, Kuwait</span>
                                            </div>
                                        </div>
                                        <div class="clearfix-space"></div>
                                        <div class="row">
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-1.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-2.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-3.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-4.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-5.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="http://retalkapp.com/tbaree/01/images/court-img-2.webp" class="img-fluid" alt="">
                                </div>
                                <div class="know-more-arrow">
                                    <a href="javascript:void(0)"><img src="http://retalkapp.com/tbaree/01/images/arrow-next-icon.png" class="img-fluid"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="courts-div">
                                    <div class="courts-name-desc">
                                        <h4>Jaber Padel Court</h4>
                                        <div class="star-rating">
                                            <input type="radio" id="005-stars" name="rating" value="5" />
                                            <label for="5-stars" class="star">&#9733;</label>
                                            <input type="radio" id="004-stars" name="rating" value="4" />
                                            <label for="4-stars" class="star">&#9733;</label>
                                            <input type="radio" id="003-stars" name="rating" value="3" />
                                            <label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>
                                            <input type="radio" id="002-stars" name="rating" value="2" />
                                            <label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>
                                            <input type="radio" id="001-star" name="rating" value="1" />
                                            <label for="1-star" class="star" style="color: #fc0;">&#9733;</label>
                                        </div>
                                        <div class="clearfix-space"></div>
                                        <div class="row">
                                            <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                                                <span><img src="http://retalkapp.com/tbaree/01/images/icons/wallet.png" class="img-fluid"
                                                        alt=""> 30KD/hr</span>
                                            </div>
                                            <div class="col-6 col-lg-6 col-md-6 col-sm-6">
                                                <span><img src="http://retalkapp.com/tbaree/01/images/icons/location-pin.png" class="img-fluid"
                                                        alt=""> Salmiya, Kuwait</span>
                                            </div>
                                        </div>
                                        <div class="clearfix-space"></div>
                                        <div class="row">
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-1.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-2.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-3.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-4.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                            <div class="col-2 col-lg-2 col-md-2 col-sm-2">
                                                <div class="court-icons">
                                                    <img src="http://retalkapp.com/tbaree/01/images/icons/court-icon-5.png" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="http://retalkapp.com/tbaree/01/images/court-img-3.webp" class="img-fluid" alt="">
                                </div>
                                <div class="know-more-arrow">
                                    <a href="javascript:void(0)"><img src="http://retalkapp.com/tbaree/01/images/arrow-next-icon.png" class="img-fluid"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="swiper-pagination product-pagination wow fadeInUp" data-wow-delay="0.1s"></div>-->
                    <div class="swiper-button-prev product-button-prev"></div>
                    <div class="swiper-button-next product-button-next"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="players-coach home-page-section">
        <div class="padding-left-right">
            <div class="container">
                <div class="players-coach-tab">
                    <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link players-coach-btn active" id="pills-players-tab"
                                data-bs-toggle="pill" data-bs-target="#pills-players" type="button" role="tab"
                                aria-controls="pills-players" aria-selected="true">Players</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link players-coach-btn" id="pills-coach-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-coach" type="button" role="tab" aria-controls="pills-coach"
                                aria-selected="false">Coach</button>
                        </li>
                    </ul>
                </div>
                <div class="clearfix-space-section-2"></div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-players" role="tabpanel"
                        aria-labelledby="pills-players-tab">
                        <div class="carousel-main wow fadeInUp" data-wow-delay="0.4s">
                            <div class="playerscoach-container swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="playerscoach-div">
                                            <img src="http://retalkapp.com/tbaree/01/images/players-coach/pc-1.webp" class="img-fluid players-coach-img"
                                                alt="">
                                        </div>
                                        <div class="playerscoach-details">
                                            <h4>Francisco N.Compan</h4>
                                            <h6>Experience: 12 Years</h6>
                                            <div class="star-rating-players">
                                                <div class="star-rating">
                                                    <input type="radio" id="e5-stars" name="rating"
                                                        value="5" />
                                                    <label for="5-stars" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                    <input type="radio" id="d4-stars" name="rating"
                                                        value="4" />
                                                    <label for="4-stars" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                    <input type="radio" id="c3-stars" name="rating"
                                                        value="3" />
                                                    <label for="3-stars" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                    <input type="radio" id="b2-stars" name="rating"
                                                        value="2" />
                                                    <label for="2-stars" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                    <input type="radio" id="a1-star" name="rating"
                                                        value="1" />
                                                    <label for="1-star" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="playerscoach-div">
                                            <img src="http://retalkapp.com/tbaree/01/images/players-coach/pc-2.webp" class="img-fluid players-coach-img"
                                                alt="">
                                        </div>
                                        <div class="playerscoach-details">
                                            <h4>Juan Lebron Chincoa</h4>
                                            <h6>Experience: 10 Years</h6>
                                            <div class="star-rating">
                                                <input type="radio" id="e05-stars" name="rating" value="5" />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="d04-stars" name="rating" value="4" />
                                                <label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="c03-stars" name="rating" value="3" />
                                                <label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>
                                                <input type="radio" id="b02-stars" name="rating" value="2" />
                                                <label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>
                                                <input type="radio" id="a01-star" name="rating" value="1" />
                                                <label for="1-star" class="star" style="color: #fc0;">&#9733;</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="playerscoach-div">
                                            <img src="http://retalkapp.com/tbaree/01/images/players-coach/pc-3.webp" class="img-fluid players-coach-img"
                                                alt="">
                                        </div>
                                        <div class="playerscoach-details">
                                            <h4>Alejandro Galan Romo</h4>
                                            <h6>Experience: 8 Years</h6>
                                            <div class="star-rating">
                                                <input type="radio" id="e005-stars" name="rating" value="5" />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="d004-stars" name="rating" value="4" />
                                                <label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="c003-stars" name="rating" value="3" />
                                                <label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>
                                                <input type="radio" id="b002-stars" name="rating" value="2" />
                                                <label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>
                                                <input type="radio" id="a001-star" name="rating" value="1" />
                                                <label for="1-star" class="star" style="color: #fc0;">&#9733;</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="playerscoach-div">
                                            <img src="http://retalkapp.com/tbaree/01/images/players-coach/pc-4.webp" class="img-fluid players-coach-img"
                                                alt="">
                                        </div>
                                        <div class="playerscoach-details">
                                            <h4>Carlos Daniel Gutierrez</h4>
                                            <h6>Experience: 7 Years</h6>
                                            <div class="star-rating">
                                                <input type="radio" id="e0005-stars" name="rating" value="5" />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="d0004-stars" name="rating" value="4" />
                                                <label for="4-stars" class="star" style="color: #fc0;">&#9733;</label>
                                                <input type="radio" id="c0003-stars" name="rating" value="3" />
                                                <label for="3-stars" class="star" style="color: #fc0;">&#9733;</label>
                                                <input type="radio" id="b0002-stars" name="rating" value="2" />
                                                <label for="2-stars" class="star" style="color: #fc0;">&#9733;</label>
                                                <input type="radio" id="a0001-star" name="rating" value="1" />
                                                <label for="1-star" class="star" style="color: #fc0;">&#9733;</label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--<div class="swiper-pagination product-pagination wow fadeInUp" data-wow-delay="0.1s"></div>-->
                            <div class="swiper-button-prev playerscoach-button-prev"></div>
                            <div class="swiper-button-next playerscoach-button-next"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="pills-coach" role="tabpanel" aria-labelledby="pills-coach-tab">
                        <div class="carousel-main wow fadeInUp" data-wow-delay="0.4s">
                            <div class="playerscoach-container swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="playerscoach-div">
                                            <img src="http://retalkapp.com/tbaree/01/images/players-coach/pc-4.webp" class="img-fluid players-coach-img"
                                                alt="">
                                        </div>
                                        <div class="playerscoach-details">
                                            <h4>Carlos Daniel Gutierrez</h4>
                                            <h6>Experience: 7 Years</h6>
                                            <div class="star-rating">
                                                <input type="radio" id="e20005-stars" name="rating" value="5" />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="d20004-stars" name="rating" value="4" />
                                                <label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="c20003-stars" name="rating" value="3" />
                                                <label for="3-stars" class="star">&#9733;</label>
                                                <input type="radio" id="b20002-stars" name="rating" value="2" />
                                                <label for="2-stars" class="star">&#9733;</label>
                                                <input type="radio" id="a20001-star" name="rating" value="1" />
                                                <label for="1-star" class="star">&#9733;</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="playerscoach-div">
                                            <img src="http://retalkapp.com/tbaree/01/images/players-coach/pc-3.webp" class="img-fluid players-coach-img"
                                                alt="">
                                        </div>
                                        <div class="playerscoach-details">
                                            <h4>Alejandro Galan Romo</h4>
                                            <h6>Experience: 8 Years</h6>
                                            <div class="star-rating">
                                                <input type="radio" id="e2005-stars" name="rating" value="5" />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="d2004-stars" name="rating" value="4" />
                                                <label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="c2003-stars" name="rating" value="3" />
                                                <label for="3-stars" class="star">&#9733;</label>
                                                <input type="radio" id="b2002-stars" name="rating" value="2" />
                                                <label for="2-stars" class="star">&#9733;</label>
                                                <input type="radio" id="a2001-star" name="rating" value="1" />
                                                <label for="1-star" class="star">&#9733;</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="playerscoach-div">
                                            <img src="http://retalkapp.com/tbaree/01/images/players-coach/pc-2.webp" class="img-fluid players-coach-img"
                                                alt="">
                                        </div>
                                        <div class="playerscoach-details">
                                            <h4>Juan Lebron Chincoa</h4>
                                            <h6>Experience: 10 Years</h6>
                                            <div class="star-rating">
                                                <input type="radio" id="e205-stars" name="rating" value="5" />
                                                <label for="5-stars" class="star">&#9733;</label>
                                                <input type="radio" id="d204-stars" name="rating" value="4" />
                                                <label for="4-stars" class="star">&#9733;</label>
                                                <input type="radio" id="c203-stars" name="rating" value="3" />
                                                <label for="3-stars" class="star">&#9733;</label>
                                                <input type="radio" id="b202-stars" name="rating" value="2" />
                                                <label for="2-stars" class="star">&#9733;</label>
                                                <input type="radio" id="a201-star" name="rating" value="1" />
                                                <label for="1-star" class="star">&#9733;</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="playerscoach-div">
                                            <img src="http://retalkapp.com/tbaree/01/images/players-coach/pc-1.webp" class="img-fluid players-coach-img"
                                                alt="">
                                        </div>
                                        <div class="playerscoach-details">
                                            <h4>Francisco N.Compan</h4>
                                            <h6>Experience: 12 Years</h6>
                                            <div class="star-rating-players">
                                                <div class="star-rating">
                                                    <input type="radio" id="e25-stars" name="rating"
                                                        value="5" />
                                                    <label for="5-stars" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                    <input type="radio" id="d24-stars" name="rating"
                                                        value="4" />
                                                    <label for="4-stars" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                    <input type="radio" id="c23-stars" name="rating"
                                                        value="3" />
                                                    <label for="3-stars" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                    <input type="radio" id="b22-stars" name="rating"
                                                        value="2" />
                                                    <label for="2-stars" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                    <input type="radio" id="a21-star" name="rating"
                                                        value="1" />
                                                    <label for="1-star" class="star"
                                                        style="color: #fc0;">&#9733;</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--<div class="swiper-pagination product-pagination wow fadeInUp" data-wow-delay="0.1s"></div>-->
                            <div class="swiper-button-prev playerscoach-button-prev"></div>
                            <div class="swiper-button-next playerscoach-button-next"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
