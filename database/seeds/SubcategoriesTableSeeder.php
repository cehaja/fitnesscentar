<?php

use App\Subcategory;
use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subcategory::create([
            'categoryID' => '1',
            'name' => 'Protein'
        ]);

        Subcategory::create([
            'categoryID' => '1',
            'name' => 'Creatine'
        ]);

        Subcategory::create([
            'categoryID' => '2',
            'name' => 'Shirt'
        ]);

        Subcategory::create([
            'categoryID' => '2',
            'name' => 'Shorts'
        ]);

        Subcategory::create([
            'categoryID' => '2',
            'name' => 'Hat'
        ]);
    }
}
