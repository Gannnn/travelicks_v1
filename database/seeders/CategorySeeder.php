<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Houses', 'icon' => 'fa-solid fa-house']);
        Category::create(['name' => 'Attractions', 'icon' => 'fa-solid fa-fire']);
        Category::create(['name' => 'Free', 'icon' => 'fa-solid fa-umbrella-beach']);
        Category::create(['name' => 'Halal', 'icon' => 'fa-solid fa-umbrella-beach']);
        Category::create(['name' => 'Pet Friendly', 'icon' => 'fa-solid fa-umbrella-beach']);
    }
}
