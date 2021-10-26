<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'first_name'    =>  'John',
            'flast_name'    =>  'Wick',
            'email'         =>  'john@gmail.com',
            'password'      =>  Hash::make('password'),
            'remember_token'=>  str_random(10)
        ]);
    }
}
