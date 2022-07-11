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
            'start_time'=> '10:00:00',
            'end_time'=> '12:00:00'
            ],
            [
            'court_id' => '1',
            'start_time'=> '13:00:00',
            'end_time'=> '15:00:00'
            ],
            [
            'court_id' => '1',
            'start_time'=> '16:00:00',
            'end_time'=> '18:00:00'
            ],
            [
            'court_id' => '2',
            'start_time'=> '10:00:00',
            'end_time'=> '12:00:00'
            ],
            [
            'court_id' => '2',
            'start_time'=> '13:00:00',
            'end_time'=> '15:00:00'
            ],
            [
            'court_id' => '2',
            'start_time'=> '16:00:00',
            'end_time'=> '18:00:00'
            ],
            
           
        ]);
    }
}
