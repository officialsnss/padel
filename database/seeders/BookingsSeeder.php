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
               'court_id'=>'7',
               'bat_id' => '1',
               'slot_id' => '9',
               'currency_id'=> 129,
               'status'=> 1,
               'price'=> '200',
               
              
            ],
            [
                'user_id'=>'3',
                'court_id'=>'8', 
                'bat_id' => '1',
                'slot_id' => '10',
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
