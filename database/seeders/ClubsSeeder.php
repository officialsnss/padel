<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;
use App\Models\Club;
class ClubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

   
    public function run()
    {
       
     
        $clubs = [
            [
               'name'=>'Club1',
               'description'=>'Dummy text comes here.',
               'user_id' => '5',
               'service_charge'=>'20',
               'currency_id'=> 129,
               'address'=> '57 Street, Souk Sharq',
               'region_id'=> 1,
               'city_id'=> 1,
               'zipcode'=> '1392003',
               'country'=>120,
              
            ],
            [
                'name'=>'Club2',
                'description'=>'Lorem ipsum description comes here.',
                'user_id' => '5',
                'service_charge'=>'20',
                'currency_id'=> 129,
                'address'=> '51 Street, Souk Sharq',
                'region_id'=> 1,
                'city_id'=> 1,
                'zipcode'=> '1392003',
                'country'=>120,
               
             ],
        ];
  
        foreach ($clubs as $key => $value) {
            Club::create($value);
        }
    }
}
