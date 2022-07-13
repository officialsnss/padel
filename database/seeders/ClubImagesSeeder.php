<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ClubImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('club_images')->insert([
            [
                'club_id' => '1',
                'image' => 'image1',
            ],
            [
                'club_id' => '1',
                'image' => 'image2',
            ],
            [
                'club_id' => '1',
                'image' => 'image3',
            ],
            [
                'club_id' => '2',
                'image' => 'image1',
            ],
            [
                'club_id' => '2',
                'image' => 'image2',
            ],
            [
                'club_id' => '3',
                'image' => 'image1',
            ],
            [
                'club_id' => '3',
                'image' => 'image2',
            ],
            [
                'club_id' => '3',
                'image' => 'image3',
            ],
            [
                'club_id' => '3',
                'image' => 'image4',
            ],
            [
                'club_id' => '4',
                'image' => 'image1',
            ],
            
        ]);
    }
}
