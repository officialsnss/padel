<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class ClubRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('club_rating')->insert([
            [
                'club_id' => '1',
                'user_id' => '3',
                'rate' => '4',
            ],
            [
                'club_id' => '1',
                'user_id' => '6',
                'rate' => '3',
            ],
            [
                'club_id' => '2',
                'user_id' => '6',
                'rate' => '2',
            ],
            [
                'club_id' => '3',
                'user_id' => '3',
                'rate' => '5',
            ],
            [
                'club_id' => '4',
                'user_id' => '6',
                'rate' => '1',
            ],
            [
                'club_id' => '4',
                'user_id' => '7',
                'rate' => '3',
            ],
            
           
        ]);
    }
}
