@extends('frontend.layouts.app')

@section('content')
<div class="page">
	<div class="mid-area-wrap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-4 playes-col">
					<div class="coach-list-data" data-bs-toggle="modal" data-bs-target="#court-details">
						
					<!-- Calling API->Coach list from api.js -->

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Hashimi Padel Court -->
<div class="modal fade" id="court-details" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
		<div class="modal-content">
			<button type="button" class="btn-close position-absolute top-10 end-10" data-bs-dismiss="modal" aria-label="Close"></button>
			<!--<div class="modal-header">
					 
					
				</div>-->

			<div class="modal-body">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="coach-img"><img src="images/player-coach/a.jpg" alt="" class="w-100"></div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<h5>Abdullah Al Mutairi</h5>
						<p><strong>Paddle Coach</strong></p>
						<p>The quick, brown fox jumps over a lazy dog. DJs flock by when MTV ax quiz prog. Junk MTV quiz graced by fox whelps. Bawds jog, flick quartz, vex nymphs. Waltz, bad nymph.</p>
						<div class="services-wrap-modal">
							<div class="row g-2">
								<div class="col-4 col-sm-4 col-md-4 col-lg-4">
									<div class="services-block-modal">
										<div class="line-a">
											<h4>8</h4>
										</div>
										<div class="line-b">Years<br> Experience</div>
									</div>
								</div>
								<div class="col-4 col-sm-4 col-md-4 col-lg-4">
									<div class="services-block-modal">
										<div class="line-a">
											<h4>57</h4>
										</div>
										<div class="line-b">Completed<br> Bookings</div>
									</div>
								</div>
								<div class="col-4 col-sm-4 col-md-4 col-lg-4">
									<div class="services-block-modal">
										<div class="line-a">
											<h4>5KWD</h4>
										</div>
										<div class="line-b">Charges<br> per Hour</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row model-courts-row">
					<div class="col-12">
						<h3>Courts</h3>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="courts-block">
							<div class="courts-block-img">
								<img src="images/hashimi-padel-court-1.jpg" alt="" class="img-fluid">
								<!--<span class="rating"><i class="bi bi-star-fill"></i> 4.5</span>
									<span class="price"><i class="bi bi-ticket-fill"></i> 30.000 KWD/hr</span>-->
							</div>
							<div class="courts-block-desc">
								<div class="line-a">Hashimi Padel Court</div>
								<!--<div class="line-c"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#court-details">More Details</a></div>-->
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="courts-block">
							<div class="courts-block-img">
								<img src="images/hashimi-padel-court-2.jpg" alt="" class="img-fluid">
								<!--<span class="rating"><i class="bi bi-star-fill"></i> 4.5</span>
									<span class="price"><i class="bi bi-ticket-fill"></i> 30.000 KWD/hr</span>-->
							</div>
							<div class="courts-block-desc">
								<div class="line-a">PANORAMIC Padel Court</div>
								<!--<div class="line-c"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#court-details">More Details</a></div>-->
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6">
						<div class="courts-block">
							<div class="courts-block-img">
								<img src="images/play-padel.jpg" alt="" class="img-fluid">
								<!--<span class="rating"><i class="bi bi-star-fill"></i> 4.5</span>
									<span class="price"><i class="bi bi-ticket-fill"></i> 30.000 KWD/hr</span>-->
							</div>
							<div class="courts-block-desc">
								<div class="line-a">Hashimi Padel Court</div>
								<!--<div class="line-c"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#court-details">More Details</a></div>-->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Hashimi Padel Court -->

@endsection