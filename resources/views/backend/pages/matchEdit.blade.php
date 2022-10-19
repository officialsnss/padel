@extends('backend.layouts.app')
@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card card-primary">

                <div class="card-body reset-form">
                    @if ($matchResult->count() == 1)
                        @foreach ($matchResult as $matchRes)
                            <form method="post" action="{{ route('matches.update', $id) }}" id="cms-pages">
                                {{ csrf_field() }}
                                <input type="hidden" id="title" class="form-control" value="{{ $id }}"
                                    name="match_id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Team 1</label>
                                            <input type="text" id="team1" class="form-control"
                                                value="{{ $matchRes->team1 }}" name="team1" hidden>
                                            <input readonly type="text" id="team1name" class="form-control" value="{{ $team1 }}" name="team1name">
                                            @error('team1')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Team 2</label>
                                            <input type="text" id="team2" class="form-control"
                                                value="{{ $matchRes->team2 }}" name="team2" hidden>
                                            <input readonly type="text" id="team2name" class="form-control" value="{{ $team2 }}" name="team2name">
                                            @error('team2')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputName">No of Rounds</label>
                                            <input type="text" id="no_of_rounds" class="form-control"
                                                value="{{ $matchRes->no_of_rounds }}" name="no_of_rounds">
                                            @error('no_of_rounds')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="textboxes">

                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Team Score 1</label>
                                            <input type="text" id="title" class="form-control"
                                                value="{{ $matchRes->team1_score }}" name="ts1">
                                            @error('ts1')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Team Score 2</label>
                                            <input type="text" id="title" class="form-control"
                                                value="{{ $matchRes->team2_score }}" name="ts2">
                                            @error('ts2')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Winner</label>
                                            <input readonly type="hidden" id="winner" class="form-control"
                                                value="{{ $matchRes->winner }}" name="winner">

                                            <input readonly type="text" id="winnerName" class="form-control"
                                                value="{{ $winnerName }}" name="winnerName" readonly>
                                            @error('winner')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-1">
                                        <button type="button"  class="btn btn-warning" onclick="fetchResult()">Run</button>
                                    </div>

                                    <div class="form-group col-md-1">
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    @else
                        <form method="post" action="{{ route('matches.result.create', $id) }}" id="cms-pages">
                            {{ csrf_field() }}
                            <input type="hidden" id="title" class="form-control" value="{{ $id }}"
                                name="match_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team 1</label>
                                        <input type="hidden" id="team1" class="form-control" value=""
                                            name="team1">
                                            <select data-live-search="true" name="team1Id[]" multiple class="form-control selectpicker" required>
                                                <option disabled>Select Players</option>
                                                @foreach ($playerName as $key =>  $playerNames)
                                                <option value="{{ $key }}">{{ $playerNames }}</option>
                                                @endforeach
                                            </select>
                                        @error('team1')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team 2</label>
                                        <input type="hidden" id="team2" class="form-control" value=""
                                            name="team2">
                                            <select data-live-search="true" name="team2Id[]" multiple class="form-control selectpicker" required>
                                                <option disabled>Select Players</option>
                                                @foreach ($playerName as $key =>  $playerNames)
                                                <option value="{{ $key }}">{{ $playerNames }}</option>
                                                @endforeach
                                            </select>
                                        @error('team2')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="inputName">No of Rounds</label>
                                        <input type="text" id="no_of_rounds" class="form-control"
                                            value="" name="no_of_rounds" required>
                                        @error('no_of_rounds')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="textboxes">

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Winner</label>
                                        <input type="hidden" readonly id="winner" class="form-control" value=""
                                            name="winner">
                                            <input type="text" readonly id="winnerName" class="form-control" value=""
                                            name="winnerName">
                                        @error('winner')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-1">
                                    <button type="button"  class="btn btn-warning" onclick="fetchResult()">Run</button>
                                </div>

                                <div class="form-group col-md-1">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>



                        </form>
                    @endif
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
    @if ($matchResult->count() == 1)
        <script>
            $(document).ready(function() {
                $('#no_of_rounds').trigger('change');
            });
            $('#no_of_rounds').change(function() {
                    $('#textboxes').empty();
                    var score = "";
                    var a = $("#no_of_rounds").val();
                    var scoreValTeam1 = "{{ $matchRes->team1_score }}";
                    var ScoreArrTeam1 = scoreValTeam1.split(',');
                    var scoreValTeam2 = "{{ $matchRes->team2_score }}";
                    var ScoreArrTeam2 = scoreValTeam2.split(',');
                    for (i = 0; i < a; i++) {
                        score = '<div class="col-md-6">';
                        score += '<div class="form-group">';
                        score += '<label for="inputName">Team Score 1</label>';
                        score += '<input type="text" id="title" class="form-control"';
                        score += 'value="'+ScoreArrTeam1[i]+'" name="ts1[]" required>';
                        score += '@error("ts1")';
                        score += '<div class="form-error">{{ $message }}</div>';
                        score += '@enderror';
                        score += '</div>';
                        score += '</div>';
                        score += '<div class="col-md-6">';
                        score += '<div class="form-group">';
                        score += '<label for="inputName">Team Score 2</label>';
                        score += '<input type="text" id="title" class="form-control"';
                        score += 'value="'+ScoreArrTeam2[i]+'" name="ts2[]" required>';
                        score += '@error("ts2")';
                        score += '<div class="form-error">{{ $message }}</div>';
                        score += '@enderror';
                        score += '</div>';
                        score += '</div>';
                        $("#textboxes").append(score) ;
                    }
                });

                function fetchResult(){

                    var team1score = $("input[name='ts1[]']").map(function(){return $(this).val();}).get();
                    var team2score = $("input[name='ts2[]']").map(function(){return $(this).val();}).get();

                    var team1name = $('#team1name').val();
                    var team2name = $('#team2name').val();

                    var a = $("#no_of_rounds").val();
                    var team1 = $("#team1").val();
                    var team2 = $("#team2").val();
                    var team1point = 0;
                    var team2point = 0;
                    for(i = 0; i<a; i++){
                        // alert(team1score[i]);
                        // alert(team2score[i]);
                        if(parseInt(team1score[i]) > parseInt(team2score[i])){
                            // console.log('1team');
                            team1point = team1point+1;
                        } else if(parseInt(team1score[i]) < parseInt(team2score[i])) {
                            team2point = team2point+1;
                            // console.log(team1score[i]);
                            // console.log(team2score[i]);
                            // console.log('2team');
                        } else {
                            team1point = team1point+0;
                            team2point = team2point+0;
                        }
                       console.log(team1point);
                   console.log(team2point);

                    }

                    if(team1point > team2point){
                        $('#winner').val(team1);
                        $('#winnerName').val('');
                        $('#winnerName').val("Team 1 ("+team1name+")");
                    } else if(team1point < team2point){
                        $('#winner').val(team2);
                        $('#winnerName').val('');
                        $('#winnerName').val("Team 2 ("+team2name+")");
                    } else {
                        $('#winner').val(team1+','+team2);
                        $('#winnerName').val('');
                        $('#winnerName').val('Team 1 ('+team1name+'), Team 2('+team2name+')');
                    }

                }
        </script>
    @else
    <script>
        $(document).ready(function() {
            $('#no_of_rounds').trigger('change');
        });
        $('#no_of_rounds').keyup(function() {
                $('#textboxes').empty();
                var score = "";
                var a = $("#no_of_rounds").val();
                for (i = 1; i <= a; i++) {
                    score = '<div class="col-md-6">';
                    score += '<div class="form-group">';
                    score += '<label for="inputName">Team 1 - Round '+[i]+' Score</label>';
                    score += '<input type="text" id="title" class="form-control"';
                    score += 'value="" name="ts1[]" required>';
                    score += '@error("ts1")';
                    score += '<div class="form-error">{{ $message }}</div>';
                    score += '@enderror';
                    score += '</div>';
                    score += '</div>';
                    score += '<div class="col-md-6">';
                    score += '<div class="form-group">';
                    score += '<label for="inputName">Team 2 - Round '+[i]+' Score</label>';
                    score += '<input type="text" id="title" class="form-control"';
                    score += 'value="" name="ts2[]" required>';
                    score += '@error("ts2")';
                    score += '<div class="form-error">{{ $message }}</div>';
                    score += '@enderror';
                    score += '</div>';
                    score += '</div>';
                    $("#textboxes").append(score) ;
                }
            });

            function fetchResult(){

                var team1score = $("input[name='ts1[]']").map(function(){return $(this).val();}).get();
                var team2score = $("input[name='ts2[]']").map(function(){return $(this).val();}).get();
                var team1Id = $("select[name='team1Id[]']").map(function(){return $(this).val();}).get();
                var team2Id = $("select[name='team2Id[]']").map(function(){return $(this).val();}).get();

                $('#team1').val(team1Id);
                $('#team2').val(team2Id);
                var team1Name = $("select[name='team1Id[]'] :selected").map(function () {
                    return $(this).text();
                }).get().join(',');
                var team2Name = $("select[name='team2Id[]'] :selected").map(function () {
                    return $(this).text();
                }).get().join(',');

                if(team1Id.length == team2Id.length){
                    for(j=0; j<team1Id.length; j++){
                        if(team1Id[j] === team2Id[j]){
                            alert('Team 1 and Team 2 player names cannot be same.');
                            exit(0);
                        }
                    }
                } else if(team1Id.length > team2Id.length) {
                    alert('Please select Team 2 Players');
                    exit(0);
                } else if(team1Id.length < team2Id.length) {
                    alert('Please select Team 1 Players');
                    exit(0);
                } else {
                    alert('Please select Team 1 & Team 2 Players');
                    exit(0);
                }

                var a = $("#no_of_rounds").val();
                var team1 = $("#team1").val();
                var team2 = $("#team2").val();


                // alert(team1Name);
                var team1point = 0;
                var team2point = 0;
                for(i = 0; i<a; i++){
                    if(parseInt(team1score[i]) > parseInt(team2score[i])){
                        team1point = team1point+1;
                    } else if(parseInt(team1score[i]) < parseInt(team2score[i])) {
                        team2point = team2point+1;
                    } else {
                        team1point = team1point+0;
                        team2point = team2point+0;
                    }
                    // console.log('v'+i+team1point);
                    // console.log('v'+team2point);
                }

                if(team1point > team2point){
                    $('#winner').val(team1);
                    $('#winnerName').val("Team 1 ("+team1Name+")");
                } else if(team1point < team2point){
                    $('#winner').val(team2);
                    $('#winnerName').val("Team 2 ("+team2Name+")");
                } else {
                    $('#winner').val(team1+','+team2);
                    $('#winnerName').val('Team 1 ('+team1Name+'), Team 2('+team2Name+')');
                }

            }
    </script>
    @endif
    @endsection
