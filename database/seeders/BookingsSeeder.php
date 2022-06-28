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

        Booking::truncate();
        $bookings = [
            [
               'user_id'=>'3',
               'court_id'=>'1',
               'bat_id' => '1',
               'slot_id' => '1',
               'currency_id'=> 129,
               'status'=> 1,
               'price'=> '200',
               
              
            ],
            [
                'user_id'=>'3',
                'court_id'=>'2', 
                'bat_id' => '1',
                'slot_id' => '2',
                'currency_id'=> 129,
                'status'=>1,
                'price'=> '100',
               
             ],
        ];
  
        foreach ($bookings as $key => $value) {
            Booking::create($value);
        }
    }
}
