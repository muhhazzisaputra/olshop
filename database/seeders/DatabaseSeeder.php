<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();

        Category::create([
            'name' => 'Tshirt',
            'slug' => 'tshirt'
        ]);

        Category::create([
            'name' => 'Crewneck',
            'slug' => 'crewneck'
        ]);

        Category::create([
            'name' => 'Hoodie',
            'slug' => 'hoodie'
        ]);

        Category::create([
            'name' => 'Jaket',
            'slug' => 'jaket'
        ]);

        Category::create([
            'name' => 'Long Pants',
            'slug' => 'long-pants'
        ]);

        Post::factory(30)->create();

        Product::factory(30)->create();
    }
}
