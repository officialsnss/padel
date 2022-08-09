<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class CouponssSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupons')->insert([
            [
            'name' => 'Coupon1',
            'code' => 'COUP1',
            'discount_percent'=> 10,
            
            ],
            [
                'name' => 'Coupon2',
                'code' => 'COUP2',
                'discount_percent'=> 20,
            ],
            
           
        ]);
    }
}
