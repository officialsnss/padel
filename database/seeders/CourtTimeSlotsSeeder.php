<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CourtTimeSlotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('court_timeslots')->insert([
            [
            'court_id' => '1',
            'date' => '2022-06-22',
            'start_time'=> '10:00:00',
            'end_time'=> '12:00:00'
            ],
            [
            'court_id' => '1',
            'date' => '2022-06-22',
            'start_time'=> '01:00:00',
            'end_time'=> '02:00:00'
            ],
            
           
        ]);
    }
}
