
@extends('frontend.layouts.app')

@section('content')
<div class="page">
	<div class="mid-area-wrap">
		<div class="container">
			<div class="row">
				@foreach($bookingData as $row)
					<div class="col-lg-4 col-md-4 col-sm-4 booking-col">
						<div class="court-book-row mb-4">
							<input type="hidden" id="matchId-<?php echo $row['id']?>" value="{{$row['id']}}">
							<h3>{{$row['name']}}</h3>
							<p>{{$row['address']}}</p>
							<div class="date-game d-flex w-100 justify-content-between">
								<?php 
									$date = date('d M', $row['startTime']); 
									$day = date('D', $row['startTime']);
									$startTime = date('H:i', $row['startTime']);
									$endTime = date('H:i', $row['endTime']);
								?>
								<p>{{$day}} {{$date}}, {{$startTime}} - {{$endTime}}</p>
								<p>{{$row['isFriendly']}}</p>
							</div>
							<ul class="games-ul d-flex">
								<?php $key = 0; ?>
								@foreach($row['players'] as $player)
								<?php ++$key;?>
								<li class="col-auto"><a href="javascript:void(0)"><div><img src="{{$player['image']}}" alt="" class="img-fluid"></div><span>{{$player['level']}}</span></a></li>
								@endforeach
								@for($i=0; $i< 4-$key; $i++)
								<li class="col-auto"><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player" onClick="playersList('<?php echo $row['id'];?>')"><div><img src="Images/icons/plus.png" alt=""></div></a></li>
								@endfor
							</ul>
							<div class="request-players d-flex w-100 justify-content-between">
								<p>Request From : <strong>{{$row['requestedPlayersCount']}} Players</strong></p>
								<p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2">View All</a></p>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
	
<!-- This modal is going to replace with the javascript used below. We are going to replace the static data in the modal with dynamic data -->
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
								<div class="col-auto"><div class="add-player-img"><img src="" alt="" class="img-fluid"></div></div>
								<div class="col"><h6></h6></div>
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

	<script>
		// Used to append the players list data in the modal
		function playersList(key) {
			let id = $('#matchId-' + key).val();
			console.log(id)
			$.ajax({
            url: "{{route('playerAddInMatch')}}",
            type: "GET",
            data: {
                match_id: id,
            },
            success: function(response) {
				var res = '';
					for (var i = 0; i < response.length; i++) {
						res += '<div class="add-player-row">';
						res += '<div class="row g-4 align-items-center">';
						res += '<div class="col-auto"><div class="add-player-img"><img src="'+response[i].image+'" alt="" class="img-fluid"></div></div>';
						res += '<div class="col"><h6>'+ response[i].name+'</h6></div>';
						res += '<div class="col-auto"><a class="btn btn-dark" href="#" role="button">Add</a></div>';
						res += '</div>';
						res += '</div>';
						res += '</div>';
						res += '</div>';
						res += '</div>';
					}
				$(".modal-body").html(res);
            },
        });
		}
	</script>
