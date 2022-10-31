<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bat;
use App\Models\Matches;
use App\Models\Club;
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingSlots;
use App\Models\Levels;
use App\Models\MatchResults;

class MatchController extends Controller
{
    public function index(Request $request)
    {
        try{
            $title = 'Match Listing';
            $matchs = Club::Join('matches','clubs.id', '=', 'matches.club_id')
            ->select('clubs.name as clubname', 'clubs.featured_image as clubimage', 'matches.status as status', 'matches.created_at as date')->get();
            if(request()->ajax()){
                $data = Club::Join('matches','clubs.id', '=', 'matches.club_id');
                if(!empty($request->status)){
                    $data = $data->where('matches.status', $request->status);
                }

                $data = $data->select('clubs.name as clubname', 'clubs.featured_image as clubimage', 'matches.status as status' ,'matches.id as id', 'matches.created_at as date');
                $data =  $data->get();
                return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->status == 2){
                        $btn = '<a href="'.route('matches.edit',$row->id).'" class="btn btn-secondary btn-sm">Edit</a>&nbsp;&nbsp;<a href="'.route('matches.view',$row->id).'" class="btn btn-primary btn-sm">View</a>';
                    } else {
                        $btn = '<a href="'.route('matches.view',$row->id).'" class="btn btn-primary btn-sm">View</a>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }

           return view('backend.pages.matches', compact('title','matchs'));
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return redirect('/admin')->with('error', 'Something went wrong.');
        }
    }

    public function edit($id)
    {
        $team1 = [];
        $team2 = [];
        $winnerName = [];
        $playerName = [];
        try{
            $matchStatus = Matches::where('status',2)->where('id', $id)->get();
            $title = 'Edit Match Result';
            if($matchStatus->count() == 1){
                $matchResult= MatchResults::where('match_id', $id)->get();
                $matchteamIds= MatchResults::where('match_id', $id)->first();
                $matchResults= MatchResults::where('match_id', $id)->get()->toArray();

                if($matchResult->count() > 0){
                    if($matchteamIds->team1 != 'NULL'){
                        $t1lists = explode(',', $matchteamIds->team1);
                        foreach( $t1lists as $team1sID){
                            $team1[] = $this->userName($team1sID);
                        }
                        $team1 = implode(', ', $team1);
                    }
                    if($matchteamIds->team2 != 'NULL'){
                        $t2lists = explode(',', $matchteamIds->team2);
                        foreach( $t2lists as $team2sID){
                            $team2[] = $this->userName($team2sID);
                        }
                        $team2 = implode(', ', $team2);
                    }
                    // dd($matchteamIds->winner);
                    if($matchteamIds->winner != 'NULL'){
                        $wlists = explode(',', $matchteamIds->winner);
                        foreach( $wlists as $wlistsID){
                            $winnerName[] = $this->userName($wlistsID);
                        }
                        $winnerName = implode(', ', $winnerName);
                    }
                } else {
                    $matchteamIds= Matches::where('status',2)->where('id', $id)->first();
                    if($matchteamIds->playersIds != 'NULL'){
                        $plists = explode(',', $matchteamIds->playersIds);
                        foreach($plists as $plistsID){
                            $playerName[$plistsID] = $this->userName($plistsID);
                        }
                    }
                    // dd($playerName);
                    return view('backend.pages.matchEdit', compact('title','id','matchResult','matchResults','playerName'));
                }
                // dd($winnerName);
                return view('backend.pages.matchEdit', compact('title','id','matchResult','matchResults','team1','team2','winnerName'));
            } else {
                return redirect('/admin/matches')->with('error', 'Match is not finished yet.');
            }
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return redirect('/admin/matches')->with('error', 'Something went wrong.');
        }
    }

    public function view($id)
    {
        try{
            $title = 'Match Details';
            $match_details = Matches::Join('clubs','matches.club_id', '=', 'clubs.id')
            ->Join('players_details','matches.player_id', '=', 'players_details.id')
            ->Join('bookings','matches.booking_id', '=', 'bookings.id')
            ->Join('booking_slots','matches.slot_id', '=', 'booking_slots.id')
            // ->Join('levels','matches.level', '=', 'levels.id')
            ->where('matches.id', $id)
            ->select('clubs.name as clubEngName', 'clubs.name_arabic as clubArabicName','matches.id as id','matches.playersIds as playersIds','matches.player_id as player_id','matches.booking_id as booking_id','matches.slot_id as slot_id','matches.level as level','matches.status  as MatchStatus','matches.court_type as court_type','matches.match_type as match_type','matches.game_type as game_type','matches.is_friendly as is_friendly','matches.gender_allowed as gender_allowed')
            ->first();
            $playerList = [];
            $slotList = [];
            $levelList = [];
            $court = '';
            $match = '';
            $game = '';
            $friendly = '';
            $gender = '';
            $MatchStatus = '';
            $playerName = '';
            $BookingStatus = '';
            $MatchStatus = '';
            $MatchStatus = '';

            // if(!empty($match_details)){

                //Get Players name
                if($match_details->playersIds != 'NULL'){
                    $playerList = [];
                    $plists = explode(',', $match_details->playersIds);
                    foreach( $plists as $playersID){
                        $playerList[] = $this->userName($playersID);
                    }
                    $playerList = implode(', ', $playerList);
                }

                $playerName = $this->userName($match_details->player_id);
                $BookingStatus = $this->bookingStatus($match_details->booking_id);

                //Get slot details

                if($match_details->slot_id != 'NULL'){
                    $slotList = [];
                    $slists = explode(',', $match_details->slot_id);
                    foreach( $slists as $slotsID){
                        $slotList[] = $this->bookingSlots($slotsID);
                    }
                    $slotList = implode(',', $slotList);
                }

                //Get level details

                if($match_details->level != 'NULL'){
                    $levelList = [];
                    $llists = explode(',', $match_details->level);
                    foreach( $llists as $levelID){
                        $levelList[] = $this->levels($levelID);
                    }
                    $levelList = implode(', ', $levelList);
                }

                if($match_details->court_type == 1){
                    $court = "Indoor";
                } else {
                    $court = "Outdoor";
                }

                if($match_details->match_type == 1){
                    $match = "Public";
                } else {
                    $match = "Private";
                }

                if($match_details->game_type == 1){
                    $game = "Singles";
                } else {
                    $game = "Doubles";
                }

                if($match_details->is_friendly == 1){
                    $friendly = "Yes";
                } else {
                    $friendly = "No";
                }

                if($match_details->gender_allowed == 1){
                    $gender = "Female";
                }elseif($match_details->gender_allowed == 2){
                    $gender = "Male";
                } else {
                    $gender = "Mix";
                }

                if($match_details->MatchStatus == 1){
                    $MatchStatus = "Upcomming";
                } elseif ($match_details->MatchStatus == 2){
                    $MatchStatus = "Played";
                } else {
                    $MatchStatus = "Cancelled";
                }
            // }

           return view('backend.pages.matchView', compact('slotList','title','court','match','game','friendly','gender','game','MatchStatus','match_details','playerList','playerName','BookingStatus','levelList'));
        }
        catch (\Exception $e) {
            return redirect('/admin/matches')->with('error', 'Something went wrong.');
        }
    }

    //Get User Name
    public function userName($id){
        $res = User::where('id',$id)->first();
        if($res){
            return $res->name;
        }
        else{
            return ;
        }
    }

    //Get Booking Status
    public function bookingStatus($id){
        $res = Booking::where('id',$id)->first();
        if($res){
            if($res->status == 1){
                return "Booked";
            }
            if($res->status == 2){
                return "Pending";
            }
            if($res->status == 1){
                return "Cancelled";
            }
        }
        else{
            return ;
        }
    }

    //Get Booking Slots
    public function bookingSlots($id){
        $res = bookingSlots::where('id',$id)->first();
        if($res){
            return $res->slots;
        }
        else{
            return ;
        }
    }

    //Get Levels Name
    public function levels($id){
        $res = Levels::where('id',$id)->first();
        if($res){
            return $res->name;
        }
        else{
            return ;
        }
    }

    public function create(Request $request)
    {
        try{
            $result = MatchResults::create([
                'team1' => $request->team1,
                'team2' => $request->team2,
                'team1_score' => implode(',', $request->ts1),
                'team2_score' => implode(',', $request->ts2),
                'no_of_rounds' => $request->no_of_rounds,
                'winner' => $request->winner,
                'match_id' => $request->match_id,
            ]);

            if($result){
            return redirect('/admin/matches')->with('success', 'Result Created Successfully.');
            }
        }
        catch (\Exception $e) {
            dd($e->getMessage());
            return redirect('/admin/matches')->with('error', 'Something went wrong.');
        }
    }

    public function update(Request $request)
    {
        try{
            $result = MatchResults::where('match_id',$request->match_id)->update([
                'team1' => $request->team1,
                'team2' => $request->team2,
                'team1_score' => implode(',', $request->ts1),
                'team2_score' => implode(',', $request->ts2),
                'no_of_rounds' => $request->no_of_rounds,
                'winner' => $request->winner,
            ]);

            if($result){
            return redirect('/admin/matches')->with('success', 'Result Created Successfully.');
            }
        }
        catch (\Exception $e) {
            return redirect('/admin/matches')->with('error', 'Something went wrong.');
        }
    }
}
