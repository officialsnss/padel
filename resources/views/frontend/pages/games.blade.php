@extends('frontend.layouts.app')

@section('content')

<div class="page">
	<div class="mid-area-wrap">
		<div class="container">
			<div class="row">
				<div class="col-12 carousel-cont">
					<div class="tab-pane position-relative">
						<div class="swiper calendar-swiper">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<a href="#">
										<h4>All</h4>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Mon</p>
										<h4>09</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Tue</p>
										<h4>10</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Wed</p>
										<h4>11</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Thu</p>
										<h4>12</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Fri</p>
										<h4>13</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Sat</p>
										<h4>14</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Sun</p>
										<h4>15</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Mon</p>
										<h4>16</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Tue</p>
										<h4>17</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Wed</p>
										<h4>18</h4></div>
									</a>
								</div>
								<div class="swiper-slide">
									<a href="#">
										<div class="cal-date"><p>Thu</p>
										<h4>19</h4></div>
									</a>
								</div>
							</div>
						</div>
						<div class="swiper-button-prev calendar-button-prev"></div>
						<div class="swiper-button-next calendar-button-next"></div>
					</div>
				</div>
				<div class="col-12 filter-main position-relative">
					<ul class="nav nav-pills justify-content-end filter-container" id="pills-tab" role="tablist">
						<li><strong>Filter:</strong></li>
<li class="nav-item" role="presentation">
	<button class="nav-link" id="pills-players-tab" data-bs-toggle="pill" data-bs-target="#pills-players" type="button" role="tab" aria-controls="pills-players" aria-selected="false">Select Level</button>
	<div class="filter-pane fade position-absolute" id="pills-players" role="tabpanel" aria-labelledby="pills-players-tab" tabindex="0">
		<ul class="unstyled checkbox filter-list">
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="one" name="level" type="checkbox" value="">
					<label for="one"><span>1</span><p>Newcomer</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="two" name="level" type="checkbox" value="">
					<label for="two"><span>2</span><p>Beginner</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="three" name="level" type="checkbox" value="">
					<label for="three"><span>3</span><p>Beginner advanced</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="four" name="level" type="checkbox" value="">
					<label for="four"><span>4</span><p>Recreational player</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="five" name="level" type="checkbox" value="">
					<label for="five"><span>5</span><p>Average</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="six" name="level" type="checkbox" value="">
					<label for="six"><span>6</span><p>Average advanced</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="seven" name="level" type="checkbox" value="">
					<label for="seven"><span>7</span><p>Experienced</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="eight" name="level" type="checkbox" value="">
					<label for="eight"><span>8</span><p>Skilled</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="nine" name="level" type="checkbox" value="">
					<label for="nine"><span>9</span><p>Expert</p></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="ten" name="level" type="checkbox" value="">
					<label for="ten"><span>10</span><p>Professional</p></label>
				</div>
			</li>
			
		</ul>
	</div>
</li>
<li class="nav-item" role="presentation">
	<button class="nav-link" id="select-gender-tab" data-bs-toggle="pill" data-bs-target="#select-gender" type="button" role="tab" aria-controls="select-gender" aria-selected="false">Select Gender</button>
	<div class="filter-pane fade position-absolute" id="select-gender" role="tabpanel" aria-labelledby="select-gender-tab" tabindex="0">
		<ul class="unstyled malefemale-list">
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="male" name="gender" type="radio" value="">
					<label for="male"><span>Male</span></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="female" name="gender" type="radio" value="">
					<label for="female"><span>Female</span></label>
				</div>
			</li>
		</ul>
	</div>
</li>
<li class="nav-item" role="presentation">
	<button class="nav-link" id="select-inout-tab" data-bs-toggle="pill" data-bs-target="#select-inout" type="button" role="tab" aria-controls="select-inout" aria-selected="false">Indoor/outdoor</button>
	<div class="filter-pane fade position-absolute" id="select-inout" role="tabpanel" aria-labelledby="select-inout-tab" tabindex="0">
		<ul class="unstyled malefemale-list">
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="indoor" name="gender" type="radio" value="">
					<label for="indoor"><span>Indoor</span></label>
				</div>
			</li>
			<li>
				<div class="address-radio">
					<input class="styled-checkbox" id="outdoor" name="gender" type="radio" value="">
					<label for="outdoor"><span>Outdoor</span></label>
				</div>
			</li>
		</ul>
	</div>
</li>
					</ul>
					<!--<div class="tab-content filter-contents position-absolute" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-players" role="tabpanel" aria-labelledby="pills-players-tab" tabindex="0">
							<p>Select Level </p>
						</div>
						<div class="tab-pane fade" id="select-gender" role="tabpanel" aria-labelledby="select-gender-tab" tabindex="0">
							<p>Select gender </p>
						</div>
						<div class="tab-pane fade" id="select-inout" role="tabpanel" aria-labelledby="select-inout-tab" tabindex="0">
							<p>Select Indoor/outdoor </p>
						</div>
					</div>-->
					 
				</div>	
				<div class="col-lg-4 col-md-4 col-sm-4 booking-col">
					<div class="court-book-row mb-4">
						<h3>Salem Padel Club</h3>
						<p>Salmiya</p>
						<div class="date-game d-flex w-100 justify-content-between">
							<p>Mon 13 Jun, 20:00 - 21:00</p>
							<p>Friendly Game</p>
						</div>	
						<ul class="games-ul d-flex">
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/b.jpg" alt="" class="img-fluid"></div><span>1</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/d.jpg" alt="" class="img-fluid"></div><span>3</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 booking-col">
					<div class="court-book-row mb-4">
						<h3>Salem Padel Club</h3>
						<p>Salmiya</p>
						<div class="date-game d-flex w-100 justify-content-between">
							<p>Mon 13 Jun, 20:00 - 21:00</p>
							<p>Friendly Game</p>
						</div>	
						<ul class="games-ul d-flex">
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/b.jpg" alt="" class="img-fluid"></div><span>1</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/d.jpg" alt="" class="img-fluid"></div><span>3</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 booking-col">
					<div class="court-book-row mb-4">
						<h3>Salem Padel Club</h3>
						<p>Salmiya</p>
						<div class="date-game d-flex w-100 justify-content-between">
							<p>Mon 13 Jun, 20:00 - 21:00</p>
							<p>Friendly Game</p>
						</div>	
						<ul class="games-ul d-flex">
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/b.jpg" alt="" class="img-fluid"></div><span>1</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/d.jpg" alt="" class="img-fluid"></div><span>3</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 booking-col">
					<div class="court-book-row mb-4">
						<h3>Salem Padel Club</h3>
						<p>Salmiya</p>
						<div class="date-game d-flex w-100 justify-content-between">
							<p>Mon 13 Jun, 20:00 - 21:00</p>
							<p>Friendly Game</p>
						</div>	
						<ul class="games-ul d-flex">
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/b.jpg" alt="" class="img-fluid"></div><span>1</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/d.jpg" alt="" class="img-fluid"></div><span>3</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 booking-col">
					<div class="court-book-row mb-4">
						<h3>Salem Padel Club</h3>
						<p>Salmiya</p>
						<div class="date-game d-flex w-100 justify-content-between">
							<p>Mon 13 Jun, 20:00 - 21:00</p>
							<p>Friendly Game</p>
						</div>	
						<ul class="games-ul d-flex">
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/b.jpg" alt="" class="img-fluid"></div><span>1</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/d.jpg" alt="" class="img-fluid"></div><span>3</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 booking-col">
					<div class="court-book-row mb-4">
						<h3>Salem Padel Club</h3>
						<p>Salmiya</p>
						<div class="date-game d-flex w-100 justify-content-between">
							<p>Mon 13 Jun, 20:00 - 21:00</p>
							<p>Friendly Game</p>
						</div>	
						<ul class="games-ul d-flex">
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/b.jpg" alt="" class="img-fluid"></div><span>1</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/d.jpg" alt="" class="img-fluid"></div><span>3</span></a></li>
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
					</div>
				</div> 
				
			</div>
		
		</div>
	</div>

<!--Add Player-->
	<div class="modal fade" id="add-player" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<div class="w-100">
					<h1 class="modal-title w-100 fs-5 mb-3 position-relative" id="exampleModalLabel">Add Player <button type="button" class="btn-close top-0 end-0 position-absolute" data-bs-dismiss="modal" aria-label="Close"></button></h1>
					<div class="form-group w-100 search-input mb-1 position-relative"><input type="text" class="form-control" placeholder="Search Players" /><button class="btn button position-absolute">Search</button></div>
					</div>
					
				</div>
				<div class="modal-body">
					<div class="add-player-row">
						<div class="row g-4 align-items-center">
							<div class="col-auto"><div class="add-player-img"><img src="images/add-player-a.jpg" alt="" class="img-fluid"></div></div>
							<div class="col"><h6>Player Name</h6></div>
							<div class="col-auto"><a class="btn btn-dark" href="#" role="button">Add</a></div>
						</div>
					</div>
					<div class="add-player-row">
						<div class="row g-4 align-items-center">
							<div class="col-auto"><div class="add-player-img"><img src="images/add-player-a.jpg" alt="" class="img-fluid"></div></div>
							<div class="col"><h6>Player Name</h6></div>
							<div class="col-auto"><a class="btn btn-dark" href="#" role="button">Add</a></div>
						</div>
					</div>
					<div class="add-player-row">
						<div class="row g-4 align-items-center">
							<div class="col-auto"><div class="add-player-img"><img src="images/add-player-a.jpg" alt="" class="img-fluid"></div></div>
							<div class="col"><h6>Player Name</h6></div>
							<div class="col-auto"><a class="btn btn-dark" href="#" role="button">Add</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Add Player-->	
<!--Add Player-->
	<div class="modal fade" id="add-player2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel2">Salem Padel Club</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body player-modal">
					<!--<h4>Salem Padel Club</h4>-->
					<div class="padel-club-row d-flex justify-content-between">
						<div class="col-auto">Mon 13 Jun, 20:00 - 21:00</div>
						<div class="col-auto"><span class="number">5</span>Minimum Level</div>
					</div>
					<div class="padel-club-row d-flex justify-content-between">
						<div class="col-auto">Location</div>
						<div class="col-auto"><span>1</span>6 km</div>
					</div>
					<p>Al Nouf Tower, 11th Floor، Jaber Al-Mubarak St, Kuwait City</p>
					<ul class="games-ul d-flex">
						<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/b.jpg" alt="" class="img-fluid"></div><span>1</span></a></li>
						<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></li>
						<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/d.jpg" alt="" class="img-fluid"></div><span>3</span></a></li>
						<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player"><div><img src="images/plus.png" alt=""></div></a></li>
					</ul>
					<div class="col-auto mt-4 mb-2"><a class="btn send-request-btn w-100" href="#" role="button">Send Request</a></div>
					<!--<div class="spot-main">
						<div class="spot-row d-flex w-100 justify-content-between align-items-center">
							<div class="name-img-level d-flex align-items-center">
								<div class="name-img"><div class="name-img-sub"><img src="images/player-coach/f.jpg" alt="" class="w-100"></div></div>
								<div class="name-level">
									<h4>Mohammed A</h4>
									<div class="d-flex">Level <span>1</span></div>
								</div>
							</div>
							<div class="accept-cancel d-flex">
								<a href="javascript:void(0);"><img src="images/right-mark.svg" class="w-100" alt=""></a>
								<a href="javascript:void(0);"><img src="images/cancel-mark.svg" class="w-100" alt=""></a>
							</div>
						</div>
						<div class="spot-row d-flex w-100 justify-content-between align-items-center">
							<div class="name-img-level d-flex align-items-center">
								<div class="name-img"><div class="name-img-sub"><img src="images/player-coach/g.jpg" alt="" class="w-100"></div></div>
								<div class="name-level">
									<h4>Khadija</h4>
									<div class="d-flex">Level <span>4</span></div>
								</div>
							</div>
							<div class="accept-cancel d-flex">
								<a href="javascript:void(0);"><img src="images/right-mark.svg" class="w-100" alt=""></a>
								<a href="javascript:void(0);"><img src="images/cancel-mark.svg" class="w-100" alt=""></a>
							</div>
						</div>
						<div class="spot-row d-flex w-100 justify-content-between align-items-center">
							<div class="name-img-level d-flex align-items-center">
								<div class="name-img"><div class="name-img-sub"><img src="images/player-coach/h.jpg" alt="" class="w-100"></div></div>
								<div class="name-level">
									<h4>Fatimah</h4>
									<div class="d-flex">Level <span>8</span></div>
								</div>
							</div>
							<div class="accept-cancel d-flex">
								<a href="javascript:void(0);"><img src="images/right-mark.svg" class="w-100" alt=""></a>
								<a href="javascript:void(0);"><img src="images/cancel-mark.svg" class="w-100" alt=""></a>
							</div>
						</div>
						<div class="search-payer">
							<div class="form-group search-input mb-4 position-relative"><input type="text" class="form-control" placeholder="Search Players" /><button class="btn button position-absolute">Search</button></div>
							<div class="spot-row d-flex w-100 justify-content-between align-items-center">
								<div class="name-img-level d-flex align-items-center">
									<div class="name-img"><div class="name-img-sub"><img src="images/player-coach/f.jpg" alt="" class="w-100"></div></div>
									<div class="name-level">
										<h4>Mohammed A</h4>
										<div class="d-flex">Level <span>1</span></div>
									</div>
								</div>
								<div class="accept-cancel d-flex">
									<a href="javascript:void(0);" class="btn button">Follow</a>
								</div>
							</div>
							<div class="spot-row d-flex w-100 justify-content-between align-items-center">
								<div class="name-img-level d-flex align-items-center">
									<div class="name-img"><div class="name-img-sub"><img src="images/player-coach/g.jpg" alt="" class="w-100"></div></div>
									<div class="name-level">
										<h4>Khadija</h4>
										<div class="d-flex">Level <span>4</span></div>
									</div>
								</div>
								<div class="accept-cancel d-flex">
									<a href="javascript:void(0);" class="btn button">Follow</a>
								</div>
							</div>
							<div class="spot-row d-flex w-100 justify-content-between align-items-center">
								<div class="name-img-level d-flex align-items-center">
									<div class="name-img"><div class="name-img-sub"><img src="images/player-coach/h.jpg" alt="" class="w-100"></div></div>
									<div class="name-level">
										<h4>Fatimah</h4>
										<div class="d-flex">Level <span>8</span></div>
									</div>
								</div>
								<div class="accept-cancel d-flex">
									<a href="javascript:void(0);" class="btn button">Follow</a>
								</div>
							</div>
						</div>	
					</div>-->
					<div class="gallery-main">
					<h3>Gallery</h3>
					<ul class="gallery">
						<li><div><a href="javascript:void(0);" data-src="images/gallery1.png" data-fancybox="gallery"><img src="images/gallery1.png" alt="" class="w-100"></a></div></li>
						<li><div><a href="javascript:void(0);" data-src="images/gallery2.png" data-fancybox="gallery"><img src="images/gallery2.png" alt="" class="w-100"></a></div><div><a href="javascript:void(0);" data-src="images/gallery3.png" data-fancybox="gallery"><img src="images/gallery3.png" alt="" class="w-100"></a></div></li>
					</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--Add Player-->	
@endsection
</body>
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
<script src="fancybox-master/jquery.fancybox.min.js"></script>
<script src="fancybox-master/fancybox.js"></script>	
<script src="js/jpreloader.js"></script>
<script>
    $(document).ready(function() {
        $('body').jpreLoader();
    });
</script>

<script src="js/jquery.stickme.js"></script>
<script>
	$.stickme();
</script>	
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="js/swiper.js"></script>

	
	