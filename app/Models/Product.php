<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi (Mass Assignment)
    // Penting supaya fungsi Product::create() di Controller tidak error
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}