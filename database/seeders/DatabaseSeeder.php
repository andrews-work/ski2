<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CategoryListSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(PostCommentSeeder::class);
        $this->call(ListingCategorySeeder::class);


        // new code
        $this -> call (ContinentsTableSeeder::class);
        $this -> call (CountriesTableSeeder::class);
        $this -> call (ResortsSeeder::class);
        $this -> call (CategoriesTableSeeder::class);
    }
}
