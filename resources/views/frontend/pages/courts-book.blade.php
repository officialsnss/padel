@extends('frontend.layouts.app')

@section('content')
<div class="mid-area-wrap">
    <div class="container">
        <div class="row g-0 justify-content-center">
            <div class="col-12 col-sm-12 col-md-12 col-lg-6">

                <div class="court-book-row mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" onchange="privateBooking()">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Private</label>
                    </div>
                </div>

                <h5>Game Type</h5>
                <div class="court-book-wrap mb-4">
                    <div class="row g-2">
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3" onclick="gameTypeSingles()">
                            <div class="court-book-block game-type">
                                <div class="line-a">Single</div>
                                <div class="line-b">2 Player</div>
                            </div>
                        </div>

                        <div class="col-4 col-sm-4 col-md-3 col-lg-3" onclick="gameTypeDoubles()">
                            <div class="court-book-block game-type">
                                <div class="line-a">Doubles</div>
                                <div class="line-b">4 Player</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5>Court Type</h5>
                <div class="court-book-wrap mb-4">
                    <div class="row g-2">
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block court-type">
                                <div class="line-a">Indoor</div>
                                <div class="line-b">Court</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block court-type">
                                <div class="line-a">Outdoor</div>
                                <div class="line-b">Court</div>
                            </div>
                        </div>
                    </div>
                </div>

                <h5>Select Date Time</h5>
                <div class="form-floating mb-4">
                    <input type="datetime" class="form-control" id="cb-date-time" placeholder="Select Date Time">
                    <label for="cb-date-time">Select Date Time</label>
                </div>

                <h5 id="Level_heading">Select level</h5>
                <div class="court-book-wrap mb-4" id="level">
                    <div class="row g-2">
                        @foreach ($matchLevels as $i => $level)
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">{{$level->id}}</div>
                                <div class="line-b">{{$level->name}}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="court-book-row mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="Game">
                        <label class="form-check-label" for="Game">Game</label>
                    </div>
                </div>

                <h5 id="Gender_heading">Select Gender</h5>
                <div class="court-book-wrap mb-4" id="gender">
                    <div class="row g-2">
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-gender">Female</div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-gender">Male</div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-gender">Mix</div>
                        </div>
                    </div>
                </div>

                <h5>Add Player</h5>
                <div class="court-book-row mb-4" id="court-book">
                    <div class="row g-2">
                        <div class="col-auto">
                            @foreach($bookingData as $row)
                            @for($i = 0; $i< 2; $i++) <img src="{{ asset('frontend/images/plus.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#add-player" onclick="playerList('<?php echo $row['id'] ?>')">
                                @endfor
                                @endforeach
                        </div>
                    </div>
                </div>


                <div class="d-grid">
                    <a class="modal-button" href="/courts-book-next" role="button">NEXT</a>
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
                    <h1 class="modal-title w-100 fs-5 mb-3 position-relative" id="exampleModalLabel">
                        @if (App::getLocale() == 'en')
                        Add Player
                        @else
                        اضافة لاعب
                        @endif
                        <button type="button" class="btn-close top-0 end-0 position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
                    </h1>
                    <div class="form-group w-100 search-input mb-1 position-relative">
                        <input type="text" id="checkpost" onkeyup="checkpost(this.value)" class="form-control" placeholder="Search Players" />
                        <button class="btn button position-absolute">
                            @if (App::getLocale() == 'en')
                            Search
                            @else
                            يبحث
                            @endif
                        </button>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                @foreach ($getPlayers as $getPlayer)
                <div class="add-player-row">
                    <div class="row g-4 align-items-center">
                        <div class="col-auto">
                            <div class="add-player-img">
                                <img src="{{$getPlayer->profile_pic}}" alt="" class="img-fluid"></div>
                        </div>
                        <div class="col">
                            @if (App::getLocale() == 'en')
                            <h6>{{$getPlayer->name}}</h6>
                            @else
                            <h6>{{$getPlayer->name_arabic}}</h6>
                            @endif
                        </div>
                        <div class="col-auto"><a class="btn btn-dark" id="add-remove-btn-" onclick="addOrRemove()" data-id=""  role="button">Add</a></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--Add Player-->

<script>
    $(document).ready(function() {
        alert($('.gate-type').selected());
    });
</script>
@endsection

<script>
    // Hides content on toggle of private checkbox...Start
    function privateBooking() {
        if ($('#flexSwitchCheckDefault').is(":checked")) {
            hideGender();
            hideLevel();
        } else {
            showGender();
            showLevel();
        }

        function hideGender() {
            var ele = document.getElementById('gender')
            var Gender_heading = document.getElementById('Gender_heading')
            ele.style.display = "none";
            Gender_heading.style.display = "none";
        }

        function hideLevel() {
            var ele = document.getElementById('level')
            var Level_heading = document.getElementById('Level_heading')
            ele.style.display = "none";
            Level_heading.style.display = "none";
        }

        function showGender() {
            var ele = document.getElementById('gender')
            var Gender_heading = document.getElementById('Gender_heading')
            ele.style.display = "block";
            Gender_heading.style.display = "block";

        }

        function showLevel() {
            var ele = document.getElementById('level')
            var Level_heading = document.getElementById('Level_heading')
            ele.style.display = "block";
            Level_heading.style.display = "block";
        }
    }
    // Hides content on toggle of private checkbox...End

    // Add players in the modal
    function playerList(id) {

        $.ajax({
            url: "{{route('playerList')}}",
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

    // Add or remove player in the modal_Add player
    
    function addOrRemove(player_id, match_id) {
        console.log(player_id);
        console.log(match_id);

        var btn = $("#add-remove-btn-" + player_id)[0].innerHTML = "Remove";
        var remove = $("#add-remove-btn-" + player_id)[0].className = "btn btn-danger";

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

    // Search in add player model
    function checkpost(str) {
        var player = $('#checkpost').val();
        $.ajax({
            type: 'get',
            url: '/api/get/playersList?searchData=' + player,
            success: function(response) {
                console.log(response);
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

    function gameTypeSingles() {

        //    var singleMatch = $(value).attr("value")
        $.ajax({
            success: function(response) {
                var res = "";
                res += '<div class="row g-2">'
                res += '<div class="col-auto">'
                res += '@for($i = 0; $i< 2; $i++)'
                res += '<img src="/frontend/images/plus.png" alt="" data-bs-toggle="modal" data-bs-target="#add-player" />'
                res += '@endfor'
                res += '</div>'
                res += '</div>'

                $("#court-book").html(res);

            }

        });
    }

    function gameTypeDoubles() {

        //    var singleMatch = $(value).attr("value")
        $.ajax({

            success: function(response) {
                var res = "";
                res += '<div class="row g-2">'
                res += '<div class="col-auto">'
                res += '@for($i = 0; $i< 4; $i++)'
                res += '<img src="/frontend/images/plus.png" alt="" data-bs-toggle="modal" data-bs-target="#add-player" />'
                res += '@endfor'
                res += '</div>'
                res += '</div>'

                $("#court-book").html(res);
            }

        });


    }
</script>