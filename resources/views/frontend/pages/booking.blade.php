@extends('frontend.layouts.app')

@section('content')
<div class="page">
	<div class="mid-area-wrap">
		<div class="container">
			<div class="row">
				@foreach($bookingData as $row)
				<div class="col-lg-4 col-md-4 col-sm-4 booking-col">
					<div class="court-book-row mb-4">
						<input type="hidden" id="matchId-<?php echo $row['id'] ?>" value="{{$row['id']}}">
						{{-- check for no of players < 4 while booking --}}
						<input type="hidden" id="playersIds" value="{{count($row['players'])}}"> 
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
							<?php ++$key; ?>
							<li class="col-auto"><a href="javascript:void(0)">
									<div><img src="{{$player['image']}}" alt="" class="img-fluid"></div><span>{{$player['level']}}</span>
								</a></li>
							@endforeach
							@for($i=0; $i< 4-$key; $i++) <li class="col-auto"><a data-bs-toggle="modal" data-bs-target="#add-player" onClick="playersList('<?php echo $row['id']; ?>')">
									<div><img src="Images/icons/plus.png" alt=""></div>
								</a></li>
								@endfor
						</ul>
						<div class="request-players d-flex w-100 justify-content-between">
							<p>Request From : <strong>{{$row['requestedPlayersCount']}} Players</strong></p>
							<p><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#add-player2" onclick="viewAll('<?php echo $row['id']; ?>')">View All</a></p>
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
						<div class="form-group w-100 search-input mb-1 position-relative">
							<input type="text" id="addPlayerSearch" onkeyup="addPlayerSearch(this.value)" class="form-control" placeholder="Search Players" />
							<button class="btn button position-absolute">Search</button>
						</div>
					</div>
				</div>
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>
	<!--Add Player-->

	<!--Add Player-->
	<div class="modal fade" id="add-player2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
			<div class="modal-content">

			</div>
		</div>
	</div>
	<!--Add Player-->
	@endsection

	<script>
		// Used to append the players list data in the modal
		function playersList(key) {
			let id = $('#matchId-' + key).val();
			// console.log(id)
			$.ajax({
				url: "{{route('playerAddInMatch')}}",
				type: "GET",
				data: {
					match_id: id,
				},
				success: function(response) {
					console.log(response);
					var res = '';
					for (var i = 0; i < response.players.length; i++) {
						res += '<div class="add-player-row">';
						res += '<div class="row g-4 align-items-center">';
						res += '<div class="col-auto"><div class="add-player-img"><img src="' + response.players[i].image + '" alt="" class="img-fluid"></div></div>';
						res += '<div class="col"><h6>' + response.players[i].name + '</h6></div>';
						res += '<div class="col-auto"><a class="btn btn-dark" id="add-remove-btn-' + response.players[i].id + '" onclick="addOrRemove(' + response.players[i].id + ',' + response.match_id + ')" role="button">Add</a></div>';
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

		// Search in add player model
		function addPlayerSearch(str) {
			var player = $('#addPlayerSearch').val();
			
			$.ajax({
				type: 'get',
				url: 'api/get/playersList?searchData=' + player,
				success: function(response) {
					console.log(response)
					var res = '';
					if (response.data) {
						for (var i = 0; i < response.data.length; i++) {
							res += '<div class="add-player-row">';
							res += '<div class="row g-4 align-items-center">';
							res += '<div class="col-auto"><div class="add-player-img"><img src="' + response.data[i].image + '" alt="" class="img-fluid"></div></div>';
							res += '<div class="col"><h6>' + response.data[i].name + '</h6></div>';
							res += '<div class="col-auto"><a class="btn btn-dark" id="add-remove-btn-' + response.data[i].id + '" onclick="addOrRemove(' + response.data[i].id + ')" role="button">Add</a></div>';
							res += '</div>';
							res += '</div>';
							res += '</div>';
							res += '</div>';
							res += '</div>';
						}
					}
					$(".modal-body").html(res);
				}
			});
		}

		function viewAll(id) {


			$.ajax({
				url: "{{route('viewAllPlayers')}}",
				type: "GET",
				data: {
					match_id: id,
				},
				success: function(response) {
					var res = "";
					var time = new Date(response.data.endTime);
					// var time =  (t.getDate() + ' ' + (t.getMonth()+1) + ' ' + t.getFullYear());
					console.log(time)
					// console.log(response.data, id)
					if (response.data) {
						console.log(response.data)

						res += '<div class="modal-header">'
						res += '<h1 class="modal-title fs-5" id="title">' + response.data.club_name + ' </h1>'
						res += '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>'
						res += '</div>'
						res += '<div class="padel-club-row d-flex justify-content-between">'
						res += '<div class="modal-body player-modal">'
						res += '<div class="padel-club-row d-flex justify-content-between">'
						res += '<div class="col-auto">' + time + '</div>'
						res += '<div class="col-auto"><span id="number">' + response.data.minimum_level + '</span>Minimum Level</div>'
						res += '</div>'
						res += '<div class="padel-club-row d-flex justify-content-between">'
						res += '<div class="col-auto">Location</div>'
						res += '<div class="col-auto"><span>' + response.data.distance + '</span> km</div>'
						res += '</div>'
						res += '<p>' + response.data.address + '</p>'
						res += '<ul class="games-ul d-flex">'
						res += '<li class="col-auto"><a href="javascript:void(0)">'
						res += '<div><img src="' + response.data.images[1] + '" alt="" class="img-fluid"></div><span>1</span>'
						res += '</a></li>'
						res += '</ul>'
						res += '<div class="spot-main">'
						res += '<div class="spot-row d-flex w-100 justify-content-between align-items-center">'
						res += '<div class="name-img-level d-flex align-items-center">'
						res += '<div class="name-img">'
						res += '<div class="name-img-sub"><img src="images/player-coach/f.jpg" alt="" class="w-100"></div>'
						res += '</div>'
						res += '<div class="name-level">'
							res += '<h4>' + Object.entries(response.data.players[0].name)+ '</h4>'
						res += ' <div class="d-flex">Level <span>' + response.data.players[1].level + '</span></div>'
						res += ' </div>'
						res += ' </div>'
						res += '<div class="accept-cancel d-flex">'
						res += ' <a href="javascript:void(0);"><img src="images/right-mark.svg" class="w-100" alt=""></a>'
						res += ' <a href="javascript:void(0);"><img src="images/cancel-mark.svg" class="w-100" alt=""></a>'
						res += ' </div>'
						res += '</div>'
						res += '<div class="spot-row d-flex w-100 justify-content-between align-items-center">'
						res += '<div class="name-img-level d-flex align-items-center">'
						res += ' <div class="name-img">'
						res += ' <div class="name-img-sub"><img src="images/player-coach/g.jpg" alt="" class="w-100"></div>'
						res += ' </div>'
						res += ' <a href="javascript:void(0);"><img src="images/cancel-mark.svg" class="w-100" alt=""></a>'
						res += '</div>'
						res += '</div>'
						res += '<div class="gallery-main">'
						res += '<h3>Gallery</h3>'
						res += ' <ul class="gallery">'
						res += ' <li>'
						res += ' <div><a href="javascript:void(0);" data-src="images/gallery1.png" data-fancybox="gallery"><img src="images/gallery1.png" alt="" class="w-100"></a></div>'
						res += ' </li>'
						res += ' </ul>'
						res += '</div>'
						res += '</div>'

					}
					$(".modal-content").html(res);

				}

			});
		}

		

		function addOrRemove(player_id, match_id, count) {

			click++;
			if(click%2 == 0){
				$("#add-remove-btn-" + player_id)[0].innerHTML = "Add";
				var remove = $("#add-remove-btn-" + player_id)[0].className = "btn btn-dark";
			} else {
				var id = $("#add-remove-btn-" + player_id)[0].innerHTML = "Remove";
				var remove = $("#add-remove-btn-" + player_id)[0].className = "btn btn-danger";
			}
			// var dataList = $("#add-remove-btn-" + player_id)[0].id;
			$.ajax({
				type: "get",
				url: "{{route('addOrRemovePlayer')}}",
				data: {
					playerId: player_id,
					matchId: match_id
				},
				success: function(response) {
					$('#add-player').on('hidden.bs.modal', function() {
						location.reload();
					})
				}
			});
		}

		function getClickCount() {
			click++;
		}
	</script>