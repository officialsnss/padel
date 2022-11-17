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
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block game-type">
                                <div class="line-a">Single</div>
                                <div class="line-b">2 Player</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
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
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">1</div>
                                <div class="line-b">Newcomer</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">2</div>
                                <div class="line-b">Beginner</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">3</div>
                                <div class="line-b">Beginner Advanced</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">4</div>
                                <div class="line-b">Recreational Player</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">5</div>
                                <div class="line-b">Average</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">6</div>
                                <div class="line-b">Average Advanced</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">7</div>
                                <div class="line-b">Experienced</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">8</div>
                                <div class="line-b">Skilled</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">9</div>
                                <div class="line-b">Expert</div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-4 col-md-3 col-lg-3">
                            <div class="court-book-block select-level">
                                <div class="line-a">10</div>
                                <div class="line-b">Professional</div>
                            </div>
                        </div>
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
                <div class="court-book-row mb-4">
                    <div class="row g-2">
                        <div class="col-auto"><a href="javascript:void(0)"><img src="{{ asset('frontend/images/plus.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#add-player"></a></div>
                        <div class="col-auto"><a href="javascript:void(0)"><img src="{{ asset('frontend/images/plus.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#add-player"></a></div>
                        <div class="col-auto"><a href="javascript:void(0)"><img src="{{ asset('frontend/images/plus.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#add-player"></a></div>
                        <div class="col-auto"><a href="javascript:void(0)"><img src="{{ asset('frontend/images/plus.png') }}" alt="" data-bs-toggle="modal" data-bs-target="#add-player"></a></div>
                    </div>
                </div>


                <div class="d-grid"><a class="modal-button" href="/courts-book-next" role="button">NEXT</a>
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
                            <button type="button" class="btn-close top-0 end-0 position-absolute"
                                data-bs-dismiss="modal" aria-label="Close"></button></h1>
                        <div class="form-group w-100 search-input mb-1 position-relative"><input type="text"
                                class="form-control" placeholder="Search Players" />
                                <button class="btn button position-absolute">
                                @if (App::getLocale() == 'en')
                                    Search
                                @else
                                    يبحث
                                @endif
                            </button></div>
                    </div>

        </div>
        <div class="modal-body">
            @foreach ($getPlayers as $getPlayer)
                <div class="add-player-row">
                    <div class="row g-4 align-items-center">
                        <div class="col-auto">
                            <div class="add-player-img"><img src="{{ asset('/images/player_images') }}/{{$getPlayer->profile_pic}}" alt=""
                                    class="img-fluid"></div>
                        </div>
                        <div class="col">
                            @if (App::getLocale() == 'en')
                                <h6>{{$getPlayer->name}}</h6>
                            @else
                                <h6>{{$getPlayer->name_arabic}}</h6>
                            @endif
                        </div>
                        <div class="col-auto"><a class="btn btn-dark" href="#" role="button">Add</a></div>
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
   
    function addPlayer(playerData) {
        
        console.log(playerData)
    }

</script>

