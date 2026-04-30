<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource (Poin 4 & 5).
     */
    public function index(Request $request)
    {
        // Ambil data produk beserta kategorinya (Eloquent Relationship - Poin 3)
        $query = Product::with('category');

        // Logic Searching: Cari berdasarkan nama (Poin 4)
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Logic Sorting: Urutkan data (Poin 4)
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        // Logic Pagination: Batasi 5 data per halaman (Poin 4)
        return response()->json($query->paginate(5));
    }
    
    public function store(Request $request)
    {
        // Logic Validasi (Poin 4)
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::create($request->all());

        return response()->json([
            'message' => 'Produk Berhasil Ditambahkan!',
            'data' => $product
        ], 201);
    }
}