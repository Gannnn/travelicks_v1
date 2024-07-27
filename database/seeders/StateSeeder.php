<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            ['name' => 'Johor', 'code' => 'JH'],
            ['name' => 'Kedah', 'code' => 'KD'],
            ['name' => 'Kelantan', 'code' => 'KN'],
            ['name' => 'Kuala Lumpur', 'code' => 'KL'],
            ['name' => 'Labuan', 'code' => 'LB'],
            ['name' => 'Melaka', 'code' => 'ML'],
            ['name' => 'Negeri Sembilan', 'code' => 'NS'],
            ['name' => 'Pahang', 'code' => 'PH'],
            ['name' => 'Penang', 'code' => 'PG'],
            ['name' => 'Perak', 'code' => 'PK'],
            ['name' => 'Perlis', 'code' => 'PL'],
            ['name' => 'Putrajaya', 'code' => 'PJ'],
            ['name' => 'Sabah', 'code' => 'SB'],
            ['name' => 'Sarawak', 'code' => 'SW'],
            ['name' => 'Selangor', 'code' => 'SG'],
            ['name' => 'Terengganu', 'code' => 'TR'],
        ];

        DB::table('states')->insert($states);
    }
}
