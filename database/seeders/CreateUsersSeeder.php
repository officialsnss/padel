<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class CreateUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Admin',
               'email'=>'admin@gmail.com',
               'role'=>'2',
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'User',
               'email'=>'user@gmail.com',
               'role'=>'1',
               'password'=> bcrypt('123456'),
            ],
            [
                'name'=>'Player',
                'email'=>'player@gmail.com',
                 'role'=>'3',
                 'phone'=>'9999994999',
                 'password'=> bcrypt('1234567'),
             ],
            [
                'name'=>'coach',
                'email'=>'coach@gmail.com',
                'role'=>'4',
                'phone'=>'9999999999',
                'password'=> bcrypt('12345678'),
             ],
             [
                'name'=>'court_owner',
                'email'=>'court_owner@gmail.com',
                 'role'=>'5',
                'password'=> bcrypt('12345679'),
             ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
