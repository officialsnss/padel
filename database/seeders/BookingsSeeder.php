<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;

class BookingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $bookings = [
            [
               'user_id'=>'3',
               'club_id'=>'1',
               'bat_id' => '1',
               'slot_id' => '1',
               'currency_id'=> 129,
               'status'=> 1,
               'price'=> '200',
               'booking_date'=>'2022-07-22',
               'order_id' => 'ORDRER1',
               'quantity' => '2',
              
            ],
            [
                'user_id'=>'3',
                'club_id'=>'2', 
                'bat_id' => '1',
                'slot_id' => '2',
                'currency_id'=> 129,
                'status'=>1,
                'price'=> '100',
                'booking_date'=>'2022-07-21',
                'order_id' => 'ORDRER2',
                'quantity' => '1',
             ],
             [
                'user_id'=>'3',
                'club_id'=>'2', 
                'bat_id' => '1',
                'slot_id' => '6',
                'currency_id'=> 129,
                'status'=>1,
                'price'=> '100',
                'booking_date'=>'2022-07-21',
                'order_id' => 'ORDRER2',
                'quantity' => '1',
             ],
        ];
  
        foreach ($bookings as $key => $value) {
            Booking::create($value);
        }
    }
}
