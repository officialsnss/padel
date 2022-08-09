<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            [
                'name' => 'New comer',
            ],
            [
                'name' => 'Beginner',
            ],
            [
                'name' => 'Beginner Advanced',
            ],
            [
                'name' => 'Recreational player',
            ],
            [
                'name' => 'Average',
            ],
            [
                'name' => 'Average Advanced',
            ],
            [
                'name' => 'Experienced',
            ],
            [
                'name' => 'Skilled',
            ],
            [
                'name' => 'Expert',
            ],
            [
                'name' => 'Professional',
            ] 
        ]);
    }
}
