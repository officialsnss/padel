<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
            'role' => 'admin',
            ],
            [
            'role' => 'super-admin',
            ],
            [ 
             'role' => 'player',
            ],
            [ 
            'role' => 'coach',
            ],
            [ 
            'role' => 'court-owner',
            ]
           
        ]);
    }
}
