<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CmsPagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cms_pages')->insert([
            [
                'title'=> 'Terms and Conditions',
                'content'=> 'Hello, This is Terms and Conditions page.'
            ],
            [
                'title'=> 'Privacy Policy',
                'content'=> 'Hello, This is Privacy Policy page.'
            ],
            [
                'title'=> 'Refund Policy',
                'content'=> 'Hello, This is Refund Policy page.'
            ],  
        ]);
    }
}
