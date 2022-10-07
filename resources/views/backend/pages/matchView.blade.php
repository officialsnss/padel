@extends('backend.layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <table class="details">
                        <tr>
                            <td><strong>Club Name</strong></td>
                            <td>{{ $match_details->clubEngName }}</td>
                        </tr>
                        <tr>
                            <td><strong>Match Slot</strong></td>
                            <td>{{ $match_details->slotList }}</td>
                        </tr>
                        <tr>
                            <td><strong>Booked by</strong></td>
                            <td>{{ $playerName }}</td>
                        </tr>
                        <tr>
                            <td><strong>Players</strong></td>
                            <td>{!! $playerList !!}<br>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Levels</strong></td>
                            <td>{{ $levelList }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Booking Status</strong></td>
                            <td>{{ $BookingStatus }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Court</strong></td>
                            <td>{{ $court }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Match</strong></td>
                            <td>{{ $match }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Game</strong></td>
                            <td>{{ $game }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Friendly</strong></td>
                            <td>{{ $friendly }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Gender</strong></td>
                            <td>{{ $gender }}<br>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Match Status</strong></td>
                            <td>
                                @php
                                            if ($match_details->MatchStatus == 1) {
                                                $status = 'Upcomming';
                                            } elseif ($match_details->MatchStatus == 2) {
                                                $status = 'Played';
                                            } else {
                                                $status = 'Cancelled';
                                            }
                                            echo $status;
                                        @endphp
                                {{-- {{ $MatchStatus }}<br> --}}
                            </td>
                        </tr>
                    </table>

                    <div class="bk-btn">

                        <a href="#" onclick="history.go(-1)" class="btn btn-info">BACK</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
