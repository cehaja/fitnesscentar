<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CountryTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(MembershipTypeTableSeeder::class);
        $this->call(MembershipsTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
