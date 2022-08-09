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
            'booking_id' => '1',
            'invoice'=> 'INV1',
            'price' => 200,
            'payment_method' => '1',
            'advance_price' => '0.00',
            'isRefunded' => '0',
            'isCancellationRequest'=> '0',
            'transaction_id'=>'TRAC1',
            'payment_status' => '1',
            'total_amount' => '120',
            'currency_id'=> '129',
            
            ],
           
        ]); 
    }
}
