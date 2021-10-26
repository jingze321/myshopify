<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use  App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'first_name'    =>  'John',
            'flast_name'    =>  'Wick',
            'email'         =>  'john@gmail.com',
            'password'      =>  Hash::make('password'),
            'remember_token'=>  str_random(10)
        ]);
    }
}
