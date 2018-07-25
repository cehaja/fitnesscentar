<?php

use App\Membership;
use Illuminate\Database\Seeder;

class MembershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Membership::create([
            'userID' => '5',
            'typeID' => '1',
            'startDate' => '2018-07-25',
            'endDate' => '2018-08-25'
        ]);

        Membership::create([
            'userID' => '6',
            'typeID' => '2',
            'startDate' => '2018-07-10',
            'endDate' => '2018-08-10'
        ]);

        Membership::create([
            'userID' => '5',
            'typeID' => '1',
            'startDate' => '2018-06-24',
            'endDate' => '2018-07-24'
        ]);
    }
}
