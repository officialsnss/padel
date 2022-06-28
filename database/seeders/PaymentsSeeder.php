<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class PaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
        DB::table('payments')->insert([
            [
            'user_id' => '3',
            'booking_id' => '6',
            'price' => 100,
            'payment_method' => '1',
            'advance_price' => '0.00',
            'transaction_id'=>'TRA23193',
            'payment_status' => '1',
            'coupons_id' => '1',
            'total_amount' => '120',
            'currency_id'=> '129',
            
            ],
            [
            'user_id' => '3',
            'booking_id' => '7',
            'price' => 100,
            'payment_method' => '2',
            'advance_price' => '12.00',
            'transaction_id'=>'TRA23193',
            'payment_status' => '2',
            'coupons_id' => '2',
            'total_amount' => '120',
            'currency_id'=> '129',
            ],
        ]); 
    }
}
