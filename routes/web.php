<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductViewController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Home: Search & Sorting logic terpusat di sini
Route::get('/', function (Request $request) {
    $query = Product::query();

    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    if ($request->sort == 'name_asc') {
        $query->orderBy('name', 'asc');
    } elseif ($request->sort == 'name_desc') {
        $query->orderBy('name', 'desc');
    } else {
        $query->latest();
    }

    $products = $query->get();
    return view('welcome', compact('products'));
})->name('home');

// Auth: Register & Login Manual
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected: CRUD & Logout
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/products/create', [ProductViewController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductViewController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductViewController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductViewController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductViewController::class, 'destroy'])->name('products.destroy');
});