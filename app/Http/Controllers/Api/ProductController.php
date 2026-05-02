<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $sortBy = $request->get('sort_by', 'id');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);
        return response()->json($query->paginate(5));
    }
    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
            $data['image_url'] = '/storage/products/' . $imageName;
        }

        $product = Product::create($data);
        return response()->json(['message' => 'Produk Berhasil Ditambahkan!', 'data' => $product], 201);
    }

    /**
     * Update method biar nggak error (Poin Fix lo, Alek)
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Not Found'], 404);

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) return response()->json($validator->errors(), 422);

        $data = $request->all();
        
        if ($request->hasFile('image_file')) {
            // Hapus gambar lama jika ada
            if ($product->image_url && str_contains($product->image_url, 'storage/products')) {
                $oldPath = preg_replace('#^/storage/#', '', $product->image_url);
                Storage::disk('public')->delete($oldPath);
            }
            
            $image = $request->file('image_file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('products', $imageName, 'public');
            $data['image_url'] = '/storage/products/' . $imageName;
        }

        $product->update($data);
        return response()->json(['message' => 'Produk Berhasil Diupdate!', 'data' => $product], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) return response()->json(['message' => 'Not Found'], 404);
        
        // Hapus file gambar jika ada
        if ($product->image_url && str_contains($product->image_url, 'storage/products')) {
            $path = str_replace(asset('storage/'), '', $product->image_url);
            Storage::disk('public')->delete($path);
        }
        
        $product->delete();
        return response()->json(['message' => 'Deleted!'], 200);
    }
}
