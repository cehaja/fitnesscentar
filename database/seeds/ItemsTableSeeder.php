<?php

use App\Item;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([
            'name' => 'Protein1',
            'price' => '120',
            'size' => '2 kg',
            'description' => 'description',
            'categoryID' => '1',
            'subcategoryID' => '1',
            'image' => 'item1.jpg',
        ]);

        Item::create([
            'name' => 'Protein2',
            'price' => '100',
            'size' => '1.8 kg',
            'description' => 'description',
            'categoryID' => '1',
            'subcategoryID' => '1',
            'image' => 'item2.jpg',
        ]);

        Item::create([
            'name' => 'Creatine1',
            'price' => '35',
            'size' => '300 g',
            'description' => 'description',
            'categoryID' => '1',
            'subcategoryID' => '2',
            'image' => 'item3.jpg',
        ]);

        Item::create([
            'name' => 'Shirt1',
            'price' => '30',
            'description' => 'description',
            'categoryID' => '2',
            'subcategoryID' => '3',
            'image' => 'item4.jpg',
        ]);

        Item::create([
            'name' => 'Shorts1',
            'price' => '20',
            'description' => 'description',
            'categoryID' => '2',
            'subcategoryID' => '4',
            'image' => 'item5.jpg',
        ]);
    }
}
