<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
{
    $cat = \App\Models\Category::create(['name' => 'Electronic']);
    
    \App\Models\Product::create([
        'category_id' => $cat->id,
        'name' => 'Asus Vivobook',
        'price' => 8500000,
        'stock' => 10
    ]);
}
}