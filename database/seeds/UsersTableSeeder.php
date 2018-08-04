<?php

use App\User;
use Illuminate\Database\Seeder;

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
           'firstName' => 'Admin',
           'lastName'=> 'Admin',
           'birthDate' => '1995-12-02',
           'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'type' => 'admin'
        ]);

        User::create([
            'firstName' => 'Employee',
            'lastName'=> 'Employee',
            'birthDate' => '1995-12-02',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('12345'),
            'type' => 'employee'
        ]);

        User::create([
            'firstName' => 'Customer1',
            'lastName'=> 'Customer1',
            'birthDate' => '1996-12-02',
            'email' => 'customer1@gmail.com',
            'password' => bcrypt('12345'),
            'type' => 'customer'
        ]);

        User::create([
            'firstName' => 'Customer2',
            'lastName'=> 'Customer2',
            'birthDate' => '1995-11-02',
            'email' => 'customer2@gmail.com',
            'password' => bcrypt('12345'),
            'type' => 'customer'
        ]);

        User::create([
            'firstName' => 'Member1',
            'lastName'=> 'Member1',
            'birthDate' => '1995-12-12',
            'email' => 'member1@gmail.com',
            'password' => bcrypt('12345'),
            'type' => 'member',
            'membershipCardNumber' => '12345678'
        ]);

        User::create([
            'firstName' => 'Member2',
            'lastName'=> 'Member2',
            'birthDate' => '1993-12-02',
            'email' => 'member2@gmail.com',
            'password' => bcrypt('12345'),
            'type' => 'member',
            'membershipCardNumber' => '87654321'
        ]);
    }
}
