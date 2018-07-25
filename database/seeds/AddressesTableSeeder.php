<?php

use App\Address;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Address::create([
            'countryID' => '27',
            'userID' => '2',
            'address' => 'Street1',
            'city' => 'City1',
            'ZIPCode' => '12121'
        ]);

        Address::create([
            'countryID' => '27',
            'userID' => '3',
            'address' => 'Street2',
            'city' => 'City2',
            'ZIPCode' => '12121'
        ]);

    }
}
