<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class BatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bats')->insert([
            [
            'description' => 'bat description 1',
            'price' => '10',
            'currency_id'=> 129,
            
            ],
            [
            'description' => 'bat description 2',
            'price' => '15',
            'currency_id'=> 129,
            ],
            
           
        ]);
    }
}
