<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Supaya kolom 'name' bisa diisi lewat Category::create()
    protected $fillable = ['name'];

    /**
     * Relasi ke Product (Poin 3)
     * Satu kategori memiliki banyak produk (One-to-Many)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}