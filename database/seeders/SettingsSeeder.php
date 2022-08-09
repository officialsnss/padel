<?php

namespace Database\Seeders;
use DB;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('settings')->insert([
           'label' => 'refund_amount',
            'value'=>'200'
            
        ]);
    }
}
