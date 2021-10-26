<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'country_id'    =>  'MY',
            'country'    =>  'Malaysia',
            'state'         =>  'Johor',

        ]);
        Location::create([
            'country_id'    =>  'MY',
            'country'    =>  'Malaysia',
            'state'         =>  'Kuala Lumpur',

        ]);
        Location::create([
            'country_id'    =>  'MY',
            'country'    =>  'Malaysia',
            'state'         =>  'Sabah',

        ]);
        Location::create([
            'country_id'    =>  'SG',
            'country'    =>  'Singapore',
            'state'         =>  'Singapore',

        ]);
        $this->call(LocationsTableSeeder::class);
    }
}
