<?php

use App\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            [
                'id'    => '1',
                'name' => 'not important',
                'color' =>'green'
            ],
            [

                'id'    => '2',
                'name' => 'important',
                'color' =>'orange'
            ],
            [
                'id'    => '3',
                'name' => 'very important',
                'color' =>'red'
            ],
           ];
           Categories::insert($categories);
    }
}
