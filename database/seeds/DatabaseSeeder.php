<?php

use App\Categories;
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
         $this->call(TaskSeeder::class);
         $this->call(CategoriesSeeder::class);
    }
}
