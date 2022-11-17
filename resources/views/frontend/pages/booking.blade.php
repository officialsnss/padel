
@extends('frontend.layouts.app')

@section('content')
<div class="page">
	
	<div class="header-area" id="demo-header">
		<div class="header-a">
			<div class="header-a-logo"><a href="index.html"><img src="images/logo.svg" alt="" class="img-fluid"></a></div>
			<div class="container">
				<div class="row g-3">
					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
						<div class="header-a-left">
							<ul class="list-inline mb-0">
								<li class="list-inline-item">Follow us</li>
								<li class="list-inline-item"><a href="#"><i class="bi bi-facebook"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="bi bi-twitter"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="bi bi-instagram"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="bi bi-youtube"></i></a></li>
								<li class="list-inline-item"><a href="#"><i class="bi bi-linkedin"></i></a></li>
							</ul>
						</div>
					</div>
					
					<div class="col-12 col-sm-12 col-md-6 col-lg-6">
						<div class="header-a-right">
							<ul class="list-inline mb-0">
								<li class="list-inline-item">
									<div class="dropdown"><a href="#" class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i> My Account</a>
										<ul class="dropdown-menu">
											<li><a class="dropdown-item" href="my-account.html">Profile</a></li>
											<li><div class="form-check form-switch">
													<label class="form-check-label" for="flexSwitchCheckDefault2">Notification</label><input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault2">
												</div>
											</li>
											<li><a class="dropdown-item" href="change-password.html">Change password</a></li>
											<li><a class="dropdown-item" href="wallet.html">Wallet</a></li>
										</ul>
									</div>
								</li>
								<li class="list-inline-item"><a href="#"><i class="bi bi-search"></i> Search</a></li>
								<li class="list-inline-item"><a href="#"><i class="bi bi-globe2"></i> العربية</a></li>	
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="header-b stickme">
			<nav class="navbar navbar-expand-lg bg-light">
				<div class="container">						
					<button class="btn btn-danger navbar-toggler border-3 px-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"><img style="width: 30px" src="images/text-center.svg" alt="menu icon"></button>

					<div class="offcanvas offcanvas-start-lg bg-dark" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
						<div class="offcanvas-header d-flex d-lg-none">
							<h5 class="offcanvas-title text-white" id="offcanvasExampleLabel"><img src="images/logo-white.svg" alt="" class="img-fluid"></h5>
							<a href="javascript:void(0)" class="text-reset p-0" data-bs-dismiss="offcanvas" aria-label="close">
								<svg xmlns="http://www.w3.org/2000/svg" width = "24" height = "24" fill = "#FFFFFF" class = "bi bi-x-circle" viewBox = "0 0 16 16">
									<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
									<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
								</svg>
							</a>
						</div>
						<div class="offcanvas-body">
							<ul class="navbar-nav mb-0 mx-auto">
								<li class="nav-item"><a class="nav-link" href="index.html">HOME</a></li>
								<li class="nav-item"><a class="nav-link" href="courts.html">COURTS</a></li>
								<li class="nav-item"><a class="nav-link" href="players.html">PLAYERS</a></li>
								<li class="nav-item"><a class="nav-link active" href="booking.html">BOOKING</a></li>
								<li class="nav-item"><a class="nav-link" href="games.html">GAMES</a></li>
								<li class="nav-item"><a class="nav-link" href="coaches.html">COACHES</a></li>
								<li class="nav-item"><a class="nav-link" href="about-us.html">ABOUT US</a></li>
								<li class="nav-item"><a class="nav-link" href="contact.us.html">CONTACT US</a></li>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</div>
	</div>
	
	
	
	<div class="mid-area-wrap">
		<div class="container">
			<div class="row">
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
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
						<div class="request-players d-flex w-100 justify-content-between">
							<p>Request From : <strong>3 Players</strong></p>
							<p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2">View All</a></p>
						</div>
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
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
						<div class="request-players d-flex w-100 justify-content-between">
							<p>Request From : <strong>3 Players</strong></p>
							<p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2">View All</a></p>
						</div>
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
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
						<div class="request-players d-flex w-100 justify-content-between">
							<p>Request From : <strong>3 Players</strong></p>
							<p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2">View All</a></p>
						</div>
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
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
						<div class="request-players d-flex w-100 justify-content-between">
							<p>Request From : <strong>3 Players</strong></p>
							<p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2">View All</a></p>
						</div>
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
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
						<div class="request-players d-flex w-100 justify-content-between">
							<p>Request From : <strong>3 Players</strong></p>
							<p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2">View All</a></p>
						</div>
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
							<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player"><div><img src="images/plus.png" alt=""></div></a></li>
						</ul>
						<div class="request-players d-flex w-100 justify-content-between">
							<p>Request From : <strong>3 Players</strong></p>
							<p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2">View All</a></p>
						</div>
					</div>
				</div>
				
			</div>
		
		</div>
	</div>
	
	
	
	<div class="footer-wrap">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-auto">© Copyright Tbaree 2022. All Rights Reserved</div>
				<div class="col-auto term-policy"><a href="terms-and-condition.html">Terms & Condition</a> <a href="refund-policy.html">Refund Policy</a> <a href="privacy-policy.html">Privacy Policy</a></div>
				<div class="col-auto">Designed by <a href="https://www.design-master.com/" target="_blank">Design Master</a></div>
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
					<div class="spot-main">
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
					</div>
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
