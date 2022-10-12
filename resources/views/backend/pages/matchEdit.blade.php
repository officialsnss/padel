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
                                                value="{{ $matchRes->team1 }}" name="team1">
                                            @error('team1')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputName">Team 2</label>
                                            <input type="text" id="team2" class="form-control"
                                                value="{{ $matchRes->team2 }}" name="team2">
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
                                            <input readonly type="text" id="winner" class="form-control"
                                                value="{{ $matchRes->winner }}" name="winner">
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
                                        <input type="text" id="team1" class="form-control" value=""
                                            name="team1">
                                        @error('team1')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team 2</label>
                                        <input type="text" id="team2" class="form-control" value=""
                                            name="team2">
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
                                            value="" name="no_of_rounds">
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
                                        <input type="text" readonly id="winner" class="form-control" value=""
                                            name="winner">
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
                        score += 'value="'+ScoreArrTeam1[i]+'" name="ts1[]">';
                        score += '@error("ts1")';
                        score += '<div class="form-error">{{ $message }}</div>';
                        score += '@enderror';
                        score += '</div>';
                        score += '</div>';
                        score += '<div class="col-md-6">';
                        score += '<div class="form-group">';
                        score += '<label for="inputName">Team Score 2</label>';
                        score += '<input type="text" id="title" class="form-control"';
                        score += 'value="'+ScoreArrTeam2[i]+'" name="ts2[]">';
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
                    var a = $("#no_of_rounds").val();
                    var team1 = $("#team1").val();
                    var team2 = $("#team2").val();
                    var team1point = 0;
                    var team2point = 0;
                    for(i = 0; i<a; i++){
                        if(team1score[i] > team2score[i]){
                            team1point = team1point+1;
                        } else if(team1score[i] < team2score[i]) {
                            team2point = team2point+1;
                        } else {
                            team1point = team1point+0;
                            team2point = team2point+0;
                        }
                    }

                    if(team1point > team2point){
                        $('#winner').val(team1);
                    } else if(team1point < team2point){
                        $('#winner').val(team2);
                    } else {
                        $('#winner').val(team1+','+team2);
                    }
                    console.log(team2point);
                    console.log(team1point);
                }
        </script>
    @else
    <script>
        $(document).ready(function() {
            $('#no_of_rounds').trigger('change');
        });
        $('#no_of_rounds').change(function() {
                $('#textboxes').empty();
                var score = "";
                var a = $("#no_of_rounds").val();
                for (i = 1; i <= a; i++) {
                    score = '<div class="col-md-6">';
                    score += '<div class="form-group">';
                    score += '<label for="inputName">Team 1 - Round '+[i]+' Score</label>';
                    score += '<input type="text" id="title" class="form-control"';
                    score += 'value="" name="ts1[]">';
                    score += '@error("ts1")';
                    score += '<div class="form-error">{{ $message }}</div>';
                    score += '@enderror';
                    score += '</div>';
                    score += '</div>';
                    score += '<div class="col-md-6">';
                    score += '<div class="form-group">';
                    score += '<label for="inputName">Team 2 - Round '+[i]+' Score</label>';
                    score += '<input type="text" id="title" class="form-control"';
                    score += 'value="" name="ts2[]">';
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
                var a = $("#no_of_rounds").val();
                var team1 = $("#team1").val();
                var team2 = $("#team2").val();
                var team1point = 0;
                var team2point = 0;
                for(i = 0; i<a; i++){
                    if(team1score[i] > team2score[i]){
                        team1point = team1point+1;
                    } else if(team1score[i] < team2score[i]) {
                        team2point = team2point+1;
                    } else {
                        team1point = team1point+0;
                        team2point = team2point+0;
                    }
                }

                if(team1point > team2point){
                    $('#winner').val(team1);
                } else if(team1point < team2point){
                    $('#winner').val(team2);
                } else {
                    $('#winner').val(team1+','+team2);
                }
                console.log(team1);
                console.log(team2);
            }
    </script>
    @endif
    @endsection
