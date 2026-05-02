<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductViewController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input termasuk image_file
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_url' => 'nullable|url',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();

        // Logic: Jika ada file yang diupload, simpan file tersebut
        // Jika tidak ada file, maka gunakan image_url yang diinput
        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('products', $filename, 'public');
            
            // Set image_url ke path storage yang baru saja disimpan (relative path)
            $data['image_url'] = '/storage/' . $path;
        }

        Product::create($data);

        return redirect('/')->with('success', 'Produk Berhasil Ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image_url' => 'nullable|url',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('image_file')) {
            // Hapus foto lama jika ada di storage
            if ($product->image_url && str_contains($product->image_url, 'storage/products')) {
                $oldPath = preg_replace('#^/storage/#', '', $product->image_url);
                Storage::disk('public')->delete($oldPath);
            }

            $file = $request->file('image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('products', $filename, 'public');
            $data['image_url'] = '/storage/' . $path;
        }

        $product->update($data);

        return redirect('/')->with('success', 'Produk Berhasil Diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        
        // Hapus file dari storage sebelum record database dihapus
        if ($product->image_url && str_contains($product->image_url, 'storage/products')) {
            $oldPath = preg_replace('#^/storage/#', '', $product->image_url);
            Storage::disk('public')->delete($oldPath);
        }

        $product->delete();

        return redirect('/')->with('success', 'Produk Berhasil Dihapus!');
    }
}