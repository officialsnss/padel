<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class CourtsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courts')->insert([
            [
            'user_id' => '5',
            'club_id' => '1',
            'currency_id'=> 129,
            'game_type' => 1,
            'single_price'=>'100',
            'double_price'=>'0.00',
            'currency_id'=> 129,
            ],
            [
                'user_id' => '5',
                'club_id' => '2',
                'currency_id'=> 129,
                'game_type' => 2,
                'single_price'=>'0.00',
                'double_price'=>'200',
                'currency_id'=> 129,
            ],
            
           
        ]);
    }
}
