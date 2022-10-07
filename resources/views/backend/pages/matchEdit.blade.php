@extends('backend.layouts.app')
@section('content')
    <div class="row">

        <div class="col-md-12">
            <div class="card card-primary">

                <div class="card-body reset-form">
                    @php
                        if($matchResult->count() == 1){
                    @endphp
                    @foreach ($matchResult as $matchRes)
                        <form method="post" action="{{ route('matches.update', $id) }}" id="cms-pages">
                            {{ csrf_field() }}
                            <input type="hidden" id="title" class="form-control" value="{{$id}}" name="match_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team 1</label>
                                        <input type="text" id="title" class="form-control" value="{{ $matchRes->team1 }}" name="team1">
                                        @error('team1')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team 2</label>
                                        <input type="text" id="title" class="form-control" value="{{ $matchRes->team2 }}" name="team2">
                                        @error('team2')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team Score 1</label>
                                        <input type="text" id="title" class="form-control" value="{{ $matchRes->team1_score }}" name="ts1">
                                        @error('ts1')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team Score 2</label>
                                        <input type="text" id="title" class="form-control" value="{{ $matchRes->team2_score }}" name="ts2">
                                        @error('ts2')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">No of Rounds</label>
                                        <input type="text" id="title" class="form-control" value="{{ $matchRes->no_of_rounds }}"
                                            name="no_of_rounds">
                                        @error('no_of_rounds')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Winner</label>
                                        <input type="text" id="title" class="form-control" value="{{ $matchRes->winner }}" name="winner">
                                        @error('winner')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    @endforeach
                    @php
                    } else {
                    @endphp
                        <form method="post" action="{{ route('matches.result.create', $id) }}" id="cms-pages">
                            {{ csrf_field() }}
                            <input type="hidden" id="title" class="form-control" value="{{$id}}" name="match_id">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team 1</label>
                                        <input type="text" id="title" class="form-control" value="" name="team1">
                                        @error('team1')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team 2</label>
                                        <input type="text" id="title" class="form-control" value="" name="team2">
                                        @error('team2')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team Score 1</label>
                                        <input type="text" id="title" class="form-control" value="" name="ts1">
                                        @error('ts1')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Team Score 2</label>
                                        <input type="text" id="title" class="form-control" value="" name="ts2">
                                        @error('ts2')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">No of Rounds</label>
                                        <input type="text" id="title" class="form-control" value=""
                                            name="no_of_rounds">
                                        @error('no_of_rounds')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="inputName">Winner</label>
                                        <input type="text" id="title" class="form-control" value="" name="winner">
                                        @error('winner')
                                            <div class="form-error">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>



                        </form>
                    @php
                    }
                    @endphp
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
@endsection
