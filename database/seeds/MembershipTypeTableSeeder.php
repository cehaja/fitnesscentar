<?php

use App\MembershipType;
use Illuminate\Database\Seeder;

class MembershipTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MembershipType::create([
            'name' => 'Student',
            'price' => '30.00'
        ]);

        MembershipType::create([
            'name' => 'Regular',
            'price' => '50.00'
        ]);

        MembershipType::create([
            'name' => 'Half a month',
            'price' => '25.00'
        ]);

    }
}
