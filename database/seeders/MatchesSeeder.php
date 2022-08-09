<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MatchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matches')->insert([
            [
                'player_id' => 3,
                'club_id' => 1,
                'match_type' => 1,
                'is_friendly'=> 1,
                'gender_allowed' => 1,
                'status' => 1,
            ],
            [
                'player_id' => 3,
                'club_id' => 2,
                'match_type' => 2,
                'is_friendly'=> 1,
                'gender_allowed' => 1,
                'status' => 2,
            ],
            [
                'player_id' => 6,
                'club_id' => 1,
                'match_type' => 1,
                'is_friendly'=> 2,
                'gender_allowed' => 1,
                'status' => 1,
            ],
            [
                'player_id' => 3,
                'club_id' => 4,
                'match_type' => 2,
                'is_friendly'=> 1,
                'gender_allowed' => 2,
                'status' => 3,
            ],
            [
                'player_id' => 6,
                'club_id' => 3,
                'match_type' => 1,
                'is_friendly'=> 1,
                'gender_allowed' => 1,
                'status' => 2,
            ],
            [
                'player_id' => 6,
                'club_id' => 2,
                'match_type' => 1,
                'is_friendly'=> 1,
                'gender_allowed' => 1,
                'status' => 2,
            ],
            
            
                
        ]); 
    }
}
