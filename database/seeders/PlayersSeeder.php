<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use DB;

class PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players_details')->insert([
            [
                'user_id' => '3',
                'player_type' => 'Defensive',
                'dob' => Carbon::create('2000', '01', '01'),
                'snapchat'=>'player_212',
                'whatsapp_no' => '9034423282',
                'match_played' => '33',
                'match_won' => '11',
                'match_loose'=> '19',
                'followers'=> '12',
                'following'=> '19',
                'levels'=> '4',
                'court_side'=> 'Left',
                'best_shot'=> 'Fast Forward Shot',
                'gender'=> 1,
                'status'=> 1,
            ],
            [
                'user_id' => '3',
                'player_type' => 'Defensive',
                'dob' => Carbon::create('1998', '01', '01'),
                'snapchat'=>'anmol_7898',
                'whatsapp_no' => '8950987898',
                'match_played' => '30',
                'match_won' => '12',
                'match_loose'=> '15',
                'followers'=> '29',
                'following'=> '13',
                'levels'=> '6',
                'court_side'=> 'Right',
                'best_shot'=> 'Slow Shot',
                'gender'=> 2,
                'status'=> 1,
                ],
                
        ]); 
    }
}
