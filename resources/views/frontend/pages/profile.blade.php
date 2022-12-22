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
									<h2>{{$user->name}}</h2>
									<div><a href="/editProfile" class="w-100 h-auto btn button">TELL US ABOUT YOURSELF</a></div>
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
@endsection

