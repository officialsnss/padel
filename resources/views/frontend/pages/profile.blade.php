@extends('frontend.layouts.app')

@section('content')
	<div class="mid-area-wrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 profile-col">
					<div class="profile-box">
						<ul class="games-ul d-flex justify-content-start">
							<li>
								<div class="user-img"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></div>
							</li>
							<li>
								<div class="date-game">
									<h2>Mohammed Al Khandari</h2>
									<div><a href="profile.html" class="w-100 h-auto btn button">TELL US ABOUT YOURSELF</a></div>
								</div>
							</li>	
						</ul>
						<ul class="user-social">
							<li>
								<a href="javascript:void(0)"><img src="images/instagram.svg" alt="" class="w-100"></a>
							</li>
							<li>
								<a href="javascript:void(0)"><img src="images/whatsapp.svg" alt="" class="w-100"></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 profile-col">
					<div class="profile-box">
						<div class="services-wrap-modal">
							<div class="row g-2">
								<div class="col-4 col-sm-4 col-md-4 col-lg-4">
									<div class="services-block-modal text-center">
										<div class="line-a"><h4>24</h4></div>
										<div class="line-b">Follower</div>
									</div>
								</div>
								<div class="col-4 col-sm-4 col-md-4 col-lg-4">
									<div class="services-block-modal text-center">
										<div class="line-a"><h4>3</h4></div>
										<div class="line-b">Level</div>
									</div>
								</div>
								<div class="col-4 col-sm-4 col-md-4 col-lg-4">
									<div class="services-block-modal text-center">
										<div class="line-a"><h4>24</h4></div>
										<div class="line-b">Following</div>
									</div>
								</div>							
							</div>
						</div>
						<div class="upcoming-game d-flex justify-content-between">
							<div class="upcoming-game-text">Upcoming Game</div>
							<div class="upcoming-game-number">5</div>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="wdl-games">
						<div class="wdl-games-sub">
							<ul>
								<li style="width:17.6056338028%"></li>
								<li style="width:17.6056338028%"></li>
								<li style="width:64.5845070423%"></li>
							</ul>
						</div>
					</div>
					<div class="wdl-game-text d-flex justify-content-between">
						<div><span></span> Win Games</div><div><span></span> Draw Games</div><div><span></span> Lost Games</div>
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
					<h1 class="modal-title fs-5" id="exampleModalLabel">Add Player</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
					<div class="games-ul d-flex">
						<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/b.jpg" alt="" class="img-fluid"></div><span>1</span></a></li>
						<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/e.jpg" alt="" class="img-fluid"></div><span>5</span></a></li>
						<li class="col-auto"><a href="javascript:void(0)"><div><img src="images/player-coach/d.jpg" alt="" class="img-fluid"></div><span>3</span></a></li>
						<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player"><div><img src="images/plus.png" alt=""></div></a></li>
					</div>
					<div class="col-auto mt-4 mb-4"><a class="btn send-request-btn w-100" href="#" role="button">Send Request</a></div>
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
@endsection

