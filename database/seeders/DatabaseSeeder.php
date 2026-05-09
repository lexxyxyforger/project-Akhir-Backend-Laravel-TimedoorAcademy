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
    // Kategori Electronic
    $catElectronic = \App\Models\Category::create(['name' => 'Electronic']);
    
    \App\Models\Product::create([
        'category_id' => $catElectronic->id,
        'name' => 'Asus Vivobook',
        'price' => 8500000,
        'stock' => 10
    ]);

    // Kategori Makanan
    $catMakanan = \App\Models\Category::create(['name' => 'Makanan']);
    
    \App\Models\Product::create([
        'category_id' => $catMakanan->id,
        'name' => 'Nasi Goreng',
        'price' => 25000,
        'stock' => 50
    ]);

    \App\Models\Product::create([
        'category_id' => $catMakanan->id,
        'name' => 'Mie Instan Premium',
        'price' => 15000,
        'stock' => 100
    ]);

    \App\Models\Product::create([
        'category_id' => $catMakanan->id,
        'name' => 'Kue Lapis Legit',
        'price' => 50000,
        'stock' => 20
    ]);

    // Kategori Minuman
    $catMinuman = \App\Models\Category::create(['name' => 'Minuman']);
    
    \App\Models\Product::create([
        'category_id' => $catMinuman->id,
        'name' => 'Kopi Robusta Premium',
        'price' => 35000,
        'stock' => 40
    ]);

    \App\Models\Product::create([
        'category_id' => $catMinuman->id,
        'name' => 'Teh Celup Herbal',
        'price' => 20000,
        'stock' => 60
    ]);

    \App\Models\Product::create([
        'category_id' => $catMinuman->id,
        'name' => 'Jus Jeruk Segar',
        'price' => 18000,
        'stock' => 75
    ]);
}
}