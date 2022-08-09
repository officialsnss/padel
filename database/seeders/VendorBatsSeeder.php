<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class VendorBatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendor_bats')->insert([
            [
                'club_id' => 1,
                'bat_id' => 1,
                'price' => '10',
                'currency_id'=> 129,
            
            ],
            [
                'club_id' => 1,
                'bat_id' => 2,
                'price' => '15',
                'currency_id'=> 129,
            
            ],
            [
                'club_id' => 1,
                'bat_id' => 3,
                'price' => '12',
                'currency_id'=> 129,
            
            ],
            [
                'club_id' => 2,
                'bat_id' => 1,
                'price' => '11',
                'currency_id'=> 129,
            
            ],
            [
                'club_id' => 2,
                'bat_id' => 3,
                'price' => '10',
                'currency_id'=> 129,
            
            ],
            [
                'club_id' => 3,
                'bat_id' => 2,
                'price' => '13',
                'currency_id'=> 129,
            
            ],
            [
                'club_id' => 3,
                'bat_id' => 3,
                'price' => '15',
                'currency_id'=> 129,
            
            ],
            [
                'club_id' => 4,
                'bat_id' => 1,
                'price' => '10',
                'currency_id'=> 129,
            ]
        ]); 
    }
}
