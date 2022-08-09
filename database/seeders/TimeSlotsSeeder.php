<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class TimeSlotsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('time_slots')->insert([
            [
                'club_id' => '1',
                'date' => '2022-06-22',
                'start_time'=> '10:00:00',
                'end_time'=> '11:00:00'
            ],
            [
                'club_id' => '2',
                'date' => '2022-06-22',
                'start_time'=> '01:00:00',
                'end_time'=> '02:00:00'
            ],
            [
                'club_id' => '3',
                'date' => '2022-06-24',
                'start_time'=> '11:00:00',
                'end_time'=> '12:00:00'
            ],
            [
                'club_id' => '4',
                'date' => '2022-06-25',
                'start_time'=> '02:00:00',
                'end_time'=> '03:00:00'
            ],
            [
                'club_id' => '1',
                'date' => '2022-06-26',
                'start_time'=> '11:00:00',
                'end_time'=> '12:00:00'
            ],
            [
                'club_id' => '2',
                'date' => '2022-06-27',
                'start_time'=> '01:00:00',
                'end_time'=> '03:00:00'
            ],
            [
                'club_id' => '3',
                'date' => '2022-07-03',
                'start_time'=> '10:00:00',
                'end_time'=> '12:00:00'
            ],
            [
                'club_id' => '4',
                'date' => '2022-06-27',
                'start_time'=> '04:00:00',
                'end_time'=> '05:00:00'
            ],
        ]);
    }
}
